<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Pessoa, Partida, Semana, Categoria, Pagina, Clube, Semestre};
use App\Models\Pessoa\{Jogador, Telefone};
use App\Models\Torneio\Resultado;
use Illuminate\Pagination\{Paginator, LengthAwarePaginator};
use Illuminate\Support\Collection;
use App\Helpers\Helper;
use App\{User, Role};

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Jogador::count() == 0) {
            $this->importJogadores();
        }

        if(Partida::count() == 0) {
            //$this->importPartidas();
            //$this->importResultados();
        }

        if(Semana::count() == 0) {
            //$this->importSemanas();
        }

        if(Pagina::count() == 0) {
            $this->importPaginas();
        }

        $id = 1;

        $categoriaAtual = Categoria::find($id);

        if($request->has('category')) {
            $id = $request->get('category');

            $categoriaAtual = Categoria::find($id);
        }

        $sql = "

          select
           jg.id,
           jg.nome,
           count(p.id) as partidas,
           jg.uuid,
           jg.categoria_id categoria,
           '' link,
           '' url,
            sum(p.jogador1_pontos/
            (select count(p2.id) as i
            from partidas p2
            where p2.semana = p.semana AND (p2.jogador1_id = p.jogador1_id OR p2.jogador2_id = p.jogador2_id)) +

            p.jogador2_pontos/
            (
            select count(p2.id) as i
            from partidas p2
            where p2.semana = p.semana AND (p2.jogador1_id = p.jogador1_id OR p2.jogador2_id = p.jogador2_id)

            )) as pontos,
            jg.avatar avatar

          from jogadores jg
          left join partidas p ON(jg.id = p.jogador1_id OR jg.id = p.jogador2_id)
          where jg.ativo = 1
          and jg.categoria_id = ?
          group by jg.id, jg.nome, jg.uuid, jg.categoria_id, jg.avatar
          #having pontos > 0
          order by pontos desc
          limit 5;

        ";

        $resultado = \DB::select($sql, [$id]);

        $ranking = [];

        foreach ($resultado as $key => $item) {

          $nomeArray = explode(" ", $item->nome);

          $primeiroNome = $nomeArray[0] ?? "";
          $ultimoNome = $nomeArray[1] ?? "";

          $ranking[] = [
            "id" => $item->id,
            "uuid" => $item->uuid,
            "primeiro_nome" => $primeiroNome,
            "ultimo_nome" => $ultimoNome,
            "categoria" => $item->categoria,
            "pontos" => floor($item->pontos),
            "link" => $item->link,
            "url" => $item->url,
            "avatar" => $item->avatar
          ];
        }

        $categorias = Categoria::where('habilitar_menu', true)->get();
        $partidasPorCategoria = [];

        foreach ($categorias as $key => $categoria) {

          foreach ($categoria->jogadores as $key2 => $jogador) {

            foreach ($jogador->partidas as $key3 => $partida) {

              $partidas = $partida->where('fim', '>', now())->get();

              foreach ($partidas as $key4 => $item) {
                  $partidasPorCategoria[$categoria->nome] = [
                    $item->id => $item
                  ];
              }

            }

          }

        }

        return view('home', compact('ranking', 'partidasPorCategoria', 'categorias', 'categoriaAtual'));
    }

    public function classificacao(Request $request)
    {
        $data = $request->request->all();

        $page = $request->page;

        $id = 1;

        $jogadorNome = null;

        if($request->has('category') && !empty($request->get('category'))) {
            $id = $request->get('category');
        }

        if($request->has('jogador') && !empty($request->get('jogador'))) {
            $jogadorNome = $request->get('jogador');
        }

        $jogadores = Jogador::where('ativo', true);

        if($jogadorNome) {
          $jogadores->where('nome', 'LIKE', "%$jogadorNome%");
        } elseif ($id) {
          $jogadores->where('categoria_id', $id);
        }

        $jogadores = $jogadores->get();

        $jogadores = $jogadores->sortByDesc(function($jogador) {
          return $jogador->partidas->sum('jogador1_pontos')
                  + $jogador->partidas->sum('jogador1_bonus')
                  + $jogador->partidas2->sum('jogador2_pontos')
                  + $jogador->partidas2->sum('jogador2_bonus');
        });

        $ranking = [];
        $items = new Collection();

        $partidasCollection = new Collection();

        foreach ($jogadores as $keyJ => $jogador) {

            $nomeArray = explode(" ", $jogador->nome);

            $primeiroNome = $nomeArray[0] ?? "";
            $ultimoNome = $nomeArray[1] ?? "";

            $bonus = $jogador->partidas->sum('jogador1_bonus')
                    + $jogador->partidas2->sum('jogador2_bonus');

            $partidaslist=$partidaslistWeekEnd=[];

            $pts=0;

            $semestreVigente = Semestre::where('inicio', '<=', now()->format('Y-m-d'))
              ->where('fim', '>=', now()->format('Y-m-d'))
              ->get();

            $semestre = $semestreVigente->last();

            if(!$semestre) {
              notify()->flash('Classificação não carregada', 'error', [
                  'text' => 'Informe um semestre que esteja em vigencia.',
              ]);
              return back();
            }

            $partidas = $jogador->partidas->filter(function($partida) use ($semestre) {
                return $partida->semestre_id == $semestre->id;
            });

            $partidas2 = $jogador->partidas2->filter(function($partida) use ($semestre) {
                return $partida->semestre_id == $semestre->id;
            });

            foreach ($partidas as $key => $partida) {
                $partidaslistWeekEnd[$partida->semana][] = $partida->jogador1_pontos+$partida->jogador1_bonus;
            }

            foreach ($partidas2 as $key => $partida) {
                $partidaslistWeekEnd[$partida->semana][] = $partida->jogador2_pontos+$partida->jogador2_bonus;
            }

            $semanasPontos = [];

            foreach ($partidaslistWeekEnd as $key => $item) {
                $semanasPontos[] = array_sum($item) / count($item);
            }

            $pontos = array_sum(array_merge($semanasPontos, $partidaslist));

            $ranking[$keyJ] = [
              "id" => $jogador->id,
              "uuid" => $jogador->uuid,
              "nome" => $jogador->nome,
              "primeiro_nome" => $primeiroNome,
              "ultimo_nome" => $ultimoNome,
              "categoria" => $jogador->categoria->id,
              "categoria_nome" => $jogador->categoria->nome,
              "pontos" => round($pontos, 2) ?: "-",
              "pontuacao" => $pontos?:0,
              "bonus" => $bonus,
              "posicao" => $keyJ+1,
              "link" => $jogador->link,
              "url" => $jogador->url,
              "avatar" => $jogador->avatar,
            ];

            $items->push($ranking[$keyJ]);
        }

        uksort($ranking, function($a, $b) {
            return $a['pontuacao'] <=> $b['pontuacao'];
        });

        $perPage = 15;

        $ranking = new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, ['path'  => $request->url(),'query' => $request->query(),]);

        $categorias = Helper::categorias();

        return view('pages.classificacao', compact('ranking', 'categorias'));
    }

    public function contato()
    {
        return view('pages.contato');
    }

    public function importJogadores()
    {
        $file = file_get_contents(storage_path('app/data/jogadors.json'));

        //$file = \Storage::get('data/jogadors.json');

        $registros = json_decode($file, true);

        //abort(404);

        #dd($registros);

        foreach ($registros as $key => $data) {

            //echo $key . '<br/>';

            if(empty($data['ds_email'])){
              $data['ds_email'] = str_slug($data['nm_jogador']).'@bsports.com.br';
            }

            $jogador = new Jogador();
            $jogador->id = $data['id'];
            $jogador->nome = $data['nm_jogador'];
            $jogador->nascimento = $data['dt_nascimento'];
            $jogador->email = $data['ds_email'];
            $jogador->avatar = 'avatar.png';
            $jogador->telefone = $data['nr_telefone2'];
            $jogador->celular = $data['nr_telefone'];
            $jogador->lateralidade = $data['ds_lateralidade'];
            $jogador->categoria_id = $data['categoria_simples_id'];
            $jogador->observacao = $data['ds_observacao'] ?? '';
            $jogador->save();

            $hasUser = \DB::table('users')->where([
              'email' => $data['ds_email'],
            ])->get();

            if($hasUser->isEmpty()) {

              $user = User::create([
                  'name' => $data['nm_jogador'],
                  'email' => $data['ds_email'],
                  'password' => bcrypt($data['ds_senha'] ?? 123),
                  'jogador_id' => $jogador->id
              ]);

              \DB::table('role_user')->insert([
                'user_id' => $user->id,
                'role_id' => 3
              ]);

            }

        }

    }

    public function importPartidas()
    {
        $file = file_get_contents(storage_path('app/data/partidas.json'));

        //$file = \Storage::get('data/partidas.json');

        $registros = json_decode($file, true);

        foreach ($registros as $key => $data) {

            $datetime = \DateTime::createFromFormat('Y-m-d H:i', $data['dt_partida'].' '.$data['hr_partida']);

            $inicio = $fim = null;

            if($datetime) {
              $inicio = $datetime;
              $fim = (new \DateTime($datetime->format('Y-m-d H:i:s')))->modify('+1 hour +30 minutes');
            }

            $partida = new Partida();
            $partida->id = $data['id'];
            $partida->torneio_id = $data['torneio_id'];
            $partida->quadra_id = $data['campo_id'];
            $partida->inicio = $inicio;
            $partida->fim = $fim;
            $partida->tipo_jogo = $data['ds_tipo_jogo'];
            $partida->semana = $data['ds_semana'];
            $partida->save();

        }
    }

    public function importResultados()
    {
        //$file = \Storage::get('data/resultados.json');

        $file = file_get_contents(storage_path('app/data/resultados.json'));

        $registros = json_decode($file, true);

        $regs = [];

        foreach ($registros as $item) {
            $regs[$item['partida_id']][] = $item;
        }

        foreach ($regs as $key => $reg) {

            $partida = Partida::findOrfail($key);

            if(!$partida) {
              continue;
            }

            foreach ($reg as $key => $item) {

              $jogador = Jogador::findOrfail($item['jogador_id']);

              if(!$jogador) {
                continue;
              }

              $index = $key + 1;

              if($index == 1) {

                $partida->jogador1_id = $jogador->id;
                $partida->jogador1_resultado_final = $item['nr_resultado_final'] ?? 0;
                $partida->jogador1_set1 = $item['nr_set1'] ?? 0;
                $partida->jogador1_set2 = $item['nr_set2'] ?? 0;
                $partida->jogador1_set3 = $item['nr_set3'] ?? 0;
                $partida->jogador1_tiebreak = $item['nr_tiebreak'] ?? 0;
                $partida->jogador1_vitoria_wo = $item['ic_vitoria_wo'] ?? 0;
                $partida->jogador1_desistencia = $item['ic_desistencia'] ?? 0;
                $partida->jogador1_pontos = $item['nr_pontos'] ?? 0;
                $partida->jogador1_bonus = $item['nr_bonus'] ?? 0;
                $partida->jogador1_computado = $item['ic_computado'] ?? 1;
                $partida->save();

              } else {


                $partida->jogador2_id = $jogador->id;
                $partida->jogador2_resultado_final = $item['nr_resultado_final'] ?? 0;
                $partida->jogador2_set1 = $item['nr_set1'] ?? 0;
                $partida->jogador2_set2 = $item['nr_set2'] ?? 0;
                $partida->jogador2_set3 = $item['nr_set3'] ?? 0;
                $partida->jogador2_tiebreak = $item['nr_tiebreak'] ?? 0;
                $partida->jogador2_vitoria_wo = $item['ic_vitoria_wo'] ?? 0;
                $partida->jogador2_desistencia = $item['ic_desistencia'] ?? 0;
                $partida->jogador2_pontos = $item['nr_pontos'] ?? 0;
                $partida->jogador2_bonus = $item['nr_bonus'] ?? 0;
                $partida->jogador2_computado = $item['ic_computado'] ?? 1;
                $partida->save();

              }

            }

        }
    }

    public function importSemanas()
    {
        $file = file_get_contents(storage_path('app/data/semanas.json'));

        //$file = \Storage::get('data/semanas.json');

        $registros = json_decode($file, true);

        foreach ($registros as $key => $data) {

            $jogador = Jogador::find($data['jogador_id']);

            if(!$jogador) {
              continue;
            }

            $resultado = new Semana();
            $resultado->id = $data['id'];
            $resultado->jogador_id = $data['jogador_id'];
            $resultado->torneio_id = $data['torneio_id'];
            $resultado->semana = $data['ds_semana'] ?? 0;
            $resultado->pontos = $data['nr_pontos'] ?? 0;
            $resultado->bonus = $data['nr_bonus'] ?? 0;
            $resultado->save();

        }
    }

    public function importPaginas()
    {
        $file = file_get_contents(storage_path('app/data/paginas.json'));

        //$file = \Storage::get('data/paginas.json');

        $registros = json_decode($file, true);

        foreach ($registros as $key => $data) {
            $resultado = new Pagina();
            $resultado->id = $data['id'];
            $resultado->titulo = $data['ds_titulo'];
            $resultado->conteudo = $data['ds_pagina'];
            $resultado->save();
        }
    }

    public function dashboard()
    {
        $user = \Auth::user();

        $pessoa = Pessoa::where('email', $user->email)->get()->first();
        $jogador = [];

        if($pessoa) {
          $jogador = Jogador::where('pessoa_id', $pessoa->id)->get()->first();
        }

        return view('jogador.dashboard', compact('jogador'));
    }

    public function formularioClube()
    {
        return view('pages.clube-vantagem');
    }

    public function formularioClubeStore(Request $request)
    {
        $data = $request->request->all();

        Clube::create($data);

        flash('A sua solicitação foi enviada com sucesso.')->success()->important();

        return redirect()->back();
    }
}

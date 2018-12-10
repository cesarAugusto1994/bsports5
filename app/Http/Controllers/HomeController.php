<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Pessoa, Partida, Semana, Categoria, Pagina, Clube};
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
            $this->importPartidas();
            //$this->importResultados();
        }

        if(Semana::count() == 0) {
            $this->importSemanas();
        }

        if(Pagina::count() == 0) {
            $this->importPaginas();
        }

        $id = 1;

        if($request->has('category')) {
            $id = $request->get('category');
        }

        $sql = "select
                jg.id,
                jg.uuid,
                jg.nome,
                categoria_id categoria,
                sum(partida.jogador1_pontos) - SUM(partida.jogador1_bonus) as pontos,
                '' link,
                '' url
                from partidas partida
                inner join jogadores jg ON(jg.id = partida.jogador1_id)
                where jg.categoria_id = ?
                group by jg.id, jg.uuid, jg.nome, jg.categoria_id
                order by pontos DESC
                limit 5";

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
            "pontos" => $item->pontos,
            "link" => $item->link,
            "url" => $item->url
          ];
        }

        return view('home', compact('ranking'));
    }

    public function classificacao(Request $request)
    {
        $data = $request->request->all();

        $page = $request->page;

        $id = 1;

        $jogador = null;

        if($request->has('category') && !empty($request->get('category'))) {
            $id = $request->get('category');
        }

        if($request->has('jogador') && !empty($request->get('jogador'))) {
            $jogador = $request->get('jogador');
        }

        $sql = "select
                jg.id,
                jg.uuid,
                jg.nome,
                categoria_id categoria,
                ca.nome categoria_nome,
                sum(partida.jogador1_pontos) as pontos,
                '' link,
                '' url,
                jg.avatar avatar
                from partidas partida
                inner join jogadores jg ON(jg.id = partida.jogador1_id)
                inner join categorias ca ON(ca.id = jg.categoria_id)
                where jg.categoria_id = ?
                ";

        if($jogador) {
          $sql .= " AND jg.nome like '%$jogador%' ";
        }

        $sql .= "group by jg.id, jg.uuid, jg.nome, jg.categoria_id, ca.nome, jg.avatar
        order by pontos DESC";

        $resultado = \DB::select($sql, [$id]);

        $ranking = [];

        $items = new Collection();

        foreach ($resultado as $key => $item) {

          $nomeArray = explode(" ", $item->nome);

          $primeiroNome = $nomeArray[0] ?? "";
          $ultimoNome = $nomeArray[1] ?? "";

          $ranking[$key] = [
            "id" => $item->id,
            "uuid" => $item->uuid,
            "nome" => $item->nome,
            "primeiro_nome" => $primeiroNome,
            "ultimo_nome" => $ultimoNome,
            "categoria" => $item->categoria,
            "categoria_nome" => $item->categoria_nome,
            "pontos" => $item->pontos,
            "posicao" => $key+1,
            "link" => $item->link,
            "url" => $item->url,
            "avatar" => $item->avatar,
          ];

          $items->push($ranking[$key]);

        }

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

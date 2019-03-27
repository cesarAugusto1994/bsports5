<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Partida,SolicitacaoPartida};
use App\Models\Pessoa\Jogador;
use App\Models\Torneio\Resultado;
use App\Models\Quadras;
use App\Models\Categoria;
use Notification;
use App\Helpers\Helper;

use App\Notifications\CreatePartida;

class PartidasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->request->all();

        $partidas = Partida::orderByDesc('id');

        if ($request->filled('id')) {
            $partidas->where('id', $request->get('id'));
        }

        if ($request->filled('nome')) {

            $nome = $request->get('nome');

            $partidas->whereHas('jogador1', function($query) use($nome) {
                $query->where('nome', 'like', '%'.$nome.'%');
            })->orWhereHas('jogador2', function($query2) use($nome) {
                $query2->where('nome', 'like', '%'.$nome.'%');
            });
        }

        if ($request->filled('quadra')) {
            $partidas->where('quadra_id', $request->get('quadra'));
        }

        if ($request->filled('categoria')) {

            $categoria = $request->get('categoria');

            $partidas->whereHas('jogador1', function($query) use($categoria) {
                $query->where('categoria_id', $categoria);
            })->orWhereHas('jogador2', function($query2) use($categoria) {
                $query2->where('categoria_id', $categoria);
            });
        }

        if ($request->filled('inicio') && $request->filled('fim')) {

            $start = \DateTime::createFromFormat('d/m/Y', $data['inicio']);
            $end = \DateTime::createFromFormat('d/m/Y', $data['fim']);

            $partidas->where('inicio', '>=', $start->format('Y-m-d') . ' 00:00:00')
            ->where('fim', '<=', $end->format('Y-m-d') . ' 23:59:59');

        }

        $quantidade = $partidas->count();

        $partidas = $partidas->paginate();

        foreach ($data as $key => $value) {
            $partidas->appends($key, $value);
        }

        $quadras = Helper::quadras();
        $categorias = Helper::categorias();

        return view('admin.partidas.index', compact('partidas', 'quadras', 'categorias'));
    }

    public function placar($id)
    {
        $partida = Partida::findOrFail($id);

        return view('admin.partidas.placar', compact('partida'));
    }

    public function editarPlacar($id)
    {
        $partida = Partida::findOrFail($id);

        return view('admin.partidas.edit', compact('partida'));
    }

    public function placarUpdate(Request $request, $id)
    {
        $data = $request->request->all();

        $resultadoJ1 = $resultadoJ2 = 0;
        $jogador1_pontos = $jogador1_bonus = 0;
        $jogador2_pontos = $jogador2_bonus = 0;

        $jogador1_set1 = $data['jogador1_set1'];
        $jogador1_set2 = $data['jogador1_set2'];
        $jogador1_set3 = $data['jogador1_set3'];

        $jogador2_set1 = $data['jogador2_set1'];
        $jogador2_set2 = $data['jogador2_set2'];
        $jogador2_set3 = $data['jogador2_set3'];

        if($jogador1_set1 == 0 && $jogador2_set1 == 0) {
/*
          notify()->flash('Erro ao finalizar Partida', 'error', [
              'text' => 'O Primeiro set não pode estar zerado para ambos os jogadores.',
          ]);

          return back()->withInput();
*/
        }

        if($jogador1_set2 == 0 && $jogador2_set2 == 0) {
/*
          notify()->flash('Erro ao finalizar Partida', 'error', [
              'text' => 'O Segundo set não pode estar zerado para ambos os jogadores.',
          ]);

          return back()->withInput();
*/
        }

        if($jogador1_set1 > $jogador2_set1) {
            $resultadoJ1++;
        } else {
            $resultadoJ2++;
        }

        if($jogador1_set2 > $jogador2_set2) {
            $resultadoJ1++;
        } else {
            $resultadoJ2++;
        }

        if($jogador1_set3 == 0 && $jogador2_set3 == 0 && $resultadoJ1 == $resultadoJ2) {
/*
          notify()->flash('Erro ao finalizar Partida', 'error', [
              'text' => 'O Terceiro set não pode estar zerado para ambos os jogadores, já que estão empatados.',
          ]);

          return back()->withInput();
*/
        }

        if($resultadoJ1==2||$resultadoJ2==2) {
            //Partida Finalizada
        } else {
          if($jogador1_set3 > $jogador2_set3) {
              $resultadoJ1++;
          } else {
              $resultadoJ2++;
          }
        }

        $partida = Partida::findOrFail($id);

        if($request->has('atualizacao_manual')) {

          $data['jogador1_tiebreak'] = $request->get('jogador1_tiebreak');
          $data['jogador2_tiebreak'] = $request->get('jogador2_tiebreak');
          $data['jogador1_resultado_final'] = $request->get('jogador1_resultado_final');
          $data['jogador2_resultado_final'] = $request->get('jogador2_resultado_final');
          $data['jogador1_pontos'] = $request->get('jogador1_pontos');
          $data['jogador2_pontos'] = $request->get('jogador2_pontos');
          $data['jogador1_bonus'] = $request->get('jogador1_bonus');
          $data['jogador2_bonus'] = $request->get('jogador2_bonus');

        }

        $partida->update($data);

        if(!$request->has('atualizacao_manual')) {

        $jogadorId = null;

        if($partida->jogador1_resultado_final > $partida->jogador2_resultado_final) {
          $jogadorId = $partida->jogador1_id;
        } else {
          $jogadorId = $partida->jogador2_id;
        }

        $posicao = Helper::jogadorPosicao($jogadorId);

        $bonus = Helper::pontosPorPosicao($posicao['posicao']);
        $bonusJg1 = $bonusJg2 = 0;

        $jogador1CategoriaNivel = Helper::categoriasHierarquia($partida->jogador1->categoria->id);
        $jogador2CategoriaNivel = Helper::categoriasHierarquia($partida->jogador2->categoria->id);

        if($jogador1CategoriaNivel > $jogador2CategoriaNivel) {
            $bonusJg2 = 11;
        } elseif($jogador2CategoriaNivel > $jogador1CategoriaNivel) {
            $bonusJg1 = 11;
        }

        if($resultadoJ1 > $resultadoJ2) {

          $jogador1_pontos = 1000;
          $jogador1_bonus = $bonus + $bonusJg1;
          $jogador2_pontos = 0;
          $jogador2_bonus = 0;

        } else {

          $jogador2_pontos = 1000;
          $jogador2_bonus = $bonus + $bonusJg2;
          $jogador1_pontos = 0;
          $jogador1_bonus = 0;

        }

        $partida->jogador1_resultado_final = $resultadoJ1;
        $partida->jogador2_resultado_final = $resultadoJ2;

        $partida->jogador1_pontos = $jogador1_pontos;
        $partida->jogador1_bonus = $jogador1_bonus;

        $partida->jogador2_pontos = $jogador2_pontos;
        $partida->jogador2_bonus = $jogador2_bonus;

        $partida->status = 'Finalizada';
        $partida->usuario_finalizacao_id = \Auth::user()->id;

        $partida->save();

        }

        notify()->flash('Partida Finalizada', 'success', [
            'text' => 'Partida Finalizada com Sucesso.',
        ]);

        return view('admin.partidas.placar', compact('partida'));
    }

    public function agendamento(Request $request)
    {
        $partidas = [];

        if($request->has('date')) {
          $partidas = Partida::where('inicio', '>=', (\DateTime::createFromFormat('d/m/Y', $request->get('date')))->setTime(00, 00, 00))
          ->where('fim', '<=', (\DateTime::createFromFormat('d/m/Y', $request->get('date')))->setTime(23, 59, 59))
          ->where('tipo_jogo', 'Simples')->get();
        }

       return view('pages.agendamento', compact('partidas'));
    }

    public function agendar(Request $request, $id)
    {
        $partida = Partida::findOrFail($id);
/*
        if($partida->inicio < now()) {

          notify()->flash('Atenção', 'error', [
              'text' => 'A data para a realização desta partida já passou, não é possivel adicionar jogadores!',
          ]);

          return back();

        }
*/
        $jogador = null;

        $isAdmin = (boolean)$request->has('partida_admin');

        if($request->has('jogador')) {
          $jogador = Jogador::find($jogador);
        }

        return view('pages.agendar', compact('jogador', 'partida', 'isAdmin'));
    }

    public function agendarStore(Request $request, $id)
    {
        $partida = Partida::findOrFail($id);

        $data = $request->request->all();

        if($request->has('jogador1') && !empty($request->get('jogador1'))) {
            $partida->jogador1_id = $request->get('jogador1');
        }

        if($request->has('jogador2') && !empty($request->get('jogador2'))) {
            $partida->jogador2_id = $request->get('jogador2');
        }

        $partida->save();

        if((boolean)\App\Helpers\Helper::getConfig('notificacao-nova-partida') == true) {

          if($partida->jogador1) {
            if($partida->jogador1->usuario) {
              $user = $partida->jogador1->usuario;
              Notification::send($user, new CreatePartida($partida));
            }
          }

          if($partida->jogador2) {
            if($partida->jogador2->usuario) {
              $user = $partida->jogador2->usuario;
              Notification::send($user, new CreatePartida($partida));
            }
          }

        }

        flash('Partida marcada com sucesso!')->success()->important();

        return redirect()->route('agendar_partida');
    }

    public function partidasAjax(Request $request)
    {
        $data = $request->request->all();

        $user = \Auth::user();

        $inicio = new \DateTime($data['start']);
        $fim = new \DateTime($data['end']);

        $partidas = Partida::where('inicio', '>=', $inicio)->where('fim', '<=', $fim)->where('tipo_jogo', 'Simples')->get();

        $cardCollor = "#1ab394";
        $editable = false;

        $con = $partidas->map(function($partida) use($cardCollor, $editable) {

            switch($partida->quadra_id) {
              case 1:
              break;
              case 2:
                $cardCollor = "#6C3483";
              break;
              case 3:
                $cardCollor = "#2874A6";
              break;
              case 4:
                $cardCollor = "#ed5565";
              break;
              case 5:
                $cardCollor = "#B03A2E";
              break;
              case 6:
                $cardCollor = "#CB4335";
              break;
            }
            $jogador1 = $jogador2 = '';

            if($partida->jogador1) {
              $jogador1 = $partida->jogador1->nome;
            }

            if($partida->jogador2) {
              $jogador2 = $partida->jogador2->nome;
            }

            $title = $jogador1 . ' x ' . $jogador2;

            return [
                'id' => $partida->id,
                'torneio' => $partida->torneio->nome,
                'quadra' => $partida->quadra->nome,
                'title' => $title,
                'start' => $partida->inicio->format('Y-m-d H:i'),
                'end' => $partida->fim->format('Y-m-d H:i'),
                'color' => $cardCollor,
                'rendering' => 'background',
                'backgroundColor' => '#00aeef',
                /*'colorText' => '#3498DB',*/
                'editable' => $editable,
                'allDay' => true
            ];
        });

        echo json_encode($con);
        exit;
    }

    public function listaPartidasAjax(Request $request)
    {
        $data = $request->request->all();

        $user = \Auth::user();

        $inicio = new \DateTime($data['start']);
        $fim = new \DateTime($data['end']);

        $partidas = Partida::where('inicio', '>=', $inicio)->where('fim', '<=', $fim)->where('tipo_jogo', 'Simples')->get();

        $cardCollor = "#1ab394";
        $editable = false;

        $con = $partidas->map(function($partida) use($cardCollor, $editable) {

            switch($partida->quadra_id) {
              case 1:
              break;
              case 2:
                $cardCollor = "#6C3483";
              break;
              case 3:
                $cardCollor = "#2874A6";
              break;
              case 4:
                $cardCollor = "#ed5565";
              break;
              case 5:
                $cardCollor = "#B03A2E";
              break;
              case 6:
                $cardCollor = "#CB4335";
              break;
            }
            $jogador1 = $jogador2 = '';

            if($partida->jogador1) {
              $jogador1 = $partida->jogador1->nome;
            }

            if($partida->jogador2) {
              $jogador2 = $partida->jogador2->nome;
            }

            $title = $jogador1 . ' x ' . $jogador2 . ' ' . $partida->quadra->nome;

            return [
                'id' => $partida->id,
                'torneio' => $partida->torneio->nome,
                'quadra' => $partida->quadra->nome,
                'title' => $title,
                'start' => $partida->inicio->format('Y-m-d H:i'),
                'end' => ($partida->fim->format('Y-m-d H:i')),
                'color' =>  $partida->quadra->cor,
                /*'colorText' => '#3498DB',*/
                'editable' => $editable,
                'allDay' => false
            ];
        });

        echo json_encode($con);
        exit;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $quadras = Helper::quadras();
        $torneios = Helper::torneios();
        $semestres = Helper::semestres();
        return view('admin.partidas.create',compact('quadras', 'torneios', 'semestres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->request->all();

        $inicio = \DateTime::createFromFormat('d/m/Y H:i', $data['inicio']);
        $fim = \DateTime::createFromFormat('d/m/Y H:i', $data['fim']);

        $hora = $fim->diff($inicio)->h;
        $minuto = $fim->diff($inicio)->i;

        $time = ($hora*60) + $minuto;

        $tempoPartida = 90;

        $quantidade = intval($time/$tempoPartida);

        //dd($quantidade);
        //exit;

        if(!$request->filled('quadra')) {
          flash('Nenhuma quadra informada.')->warning()->important();
          return redirect()->back();
        }

        if(!$request->filled('semestre_id')) {
          flash('Nenhum semestre informado.')->warning()->important();
          return redirect()->back();
        }

        $quadras = $data['quadra'];

        foreach ($quadras as $key => $quadra) {

          $horario = \DateTime::createFromFormat('d/m/Y H:i', $data['inicio']);

          foreach (range(1, $quantidade) as $item) {

            $partida = new Partida();
            $partida->torneio_id = $data['torneio'];
            $partida->quadra_id = $quadra;
            $partida->inicio = $horario;
            $partida->fim = $horario->modify('+90 minutes');
            $partida->semestre_id = $data['semestre_id'];
            $partida->tipo_jogo = 'Simples';
            $partida->semana = $inicio->format('WY');

            if($request->has('jogador')) {

                $jogadores = $data['jogador'];

                foreach ($jogadores as $key => $item) {
                  if($key == 0) {
                      $partida->jogador1_id = $item;
                  } else {
                      $partida->jogador2_id = $item;
                  }
                }
            }

            $partida->save();

          }

        }

        flash('Partida marcada com sucesso!')->success()->important();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          try {
              $partida = Partida::findOrFail($id);

              $resultados = $partida->resultado;

              foreach ($resultados as $key => $resultado) {
                  $resultado->delete();
              }

              $partida->delete();

              return response()->json([
                'code' => 201,
                'message' => 'registro removido com sucesso!'
              ]);

          } catch(Exception $e) {
              return response()->json([
                'code' => 501,
                'message' => $e->getMessage()
              ]);
          }
    }

    public function removerJogador($id, $jogador)
    {
        $partida = Partida::findOrFail($id);

        if($partida->jogador1_id == $jogador) {
            $partida->jogador1_id = null;
        }

        if($partida->jogador2_id == $jogador) {
            $partida->jogador2_id = null;
        }

        $partida->save();

        flash('Jogador removido da partida com sucesso!')->success()->important();
        return redirect()->back();
    }

    public function trocarJogador($id, $jogador, Request $request)
    {
        $partida = Partida::findOrFail($id);

        if($partida->jogador1_id == $jogador) {
            $partida->jogador1_id = null;
        }

        if($partida->jogador2_id == $jogador) {
            $partida->jogador2_id = null;
        }

        $partida->save();

        $isAdmin = (boolean)$request->has('partida_admin');

        flash('Jogador removido da partida com sucesso!')->success()->important();

        return view('admin.partidas.trocar', compact('isAdmin', 'partida'));
    }

    public function trocarJogadorStore(Request $request, $id)
    {
        $partida = Partida::findOrFail($id);

        $data = $request->request->all();

        if($request->has('jogador1') && !empty($request->get('jogador1'))) {
            $partida->jogador1_id = $request->get('jogador1');
        }

        if($request->has('jogador2') && !empty($request->get('jogador2'))) {
            $partida->jogador2_id = $request->get('jogador2');
        }

        $partida->save();

        return redirect()->route('partida.index');
    }

    public function formularioAgenda()
    {
        return view('pages.formulario');
    }

    public function formularioAgendaStore(Request $request)
    {
        $data = $request->request->all();

        if($request->has('data')) {
            $data['data'] = \DateTime::createFromFormat('Y-m-d', $data['data']);
        }

        SolicitacaoPartida::create($data);

        flash('A sua solicitação foi enviada com sucesso!')->success()->important();
        return redirect()->back();
    }

    public function wo($id, $jogadorId)
    {
        $partida = Partida::findOrFail($id);

        $posicao = Helper::jogadorPosicao($jogadorId);
        $bonus = Helper::pontosPorPosicao($posicao);

        $jogadorVencedor = $jogadorPerdedor = null;
        $j1pontos = $j1bonus = $j2pontos = $j2bonus = 0;

        if($jogadorId == $partida->jogador1->id) {

          $jogadorVencedor = $partida->jogador1;
          $jogadorPerdedor = $partida->jogador2;

          $j1pontos = 1000;
          $j1bonus = $bonus;

          $j2pontos = -1000;
          $j2bonus = -10;

        } elseif($jogadorId == $partida->jogador2->id) {

          $jogadorVencedor = $partida->jogador2;
          $jogadorPerdedor = $partida->jogador1;

          $j2pontos = 1000;
          $j2bonus = $bonus;

          $j1pontos = -1000;
          $j1bonus = -10;
        }

        return view('admin.partidas.wo', compact('partida', 'j1pontos', 'j1bonus', 'j2pontos', 'j2bonus', 'jogadorVencedor', 'jogadorPerdedor'));
    }

    public function desistencia($id, $jogadorId)
    {
        $partida = Partida::findOrFail($id);

        $jogadorVencedor = $jogadorPerdedor = null;
        $j1pontos = $j1bonus = $j2pontos = $j2bonus = 0;

        $posicao = Helper::jogadorPosicao($jogadorId);
        $bonus = Helper::pontosPorPosicao($posicao);

        if($jogadorId == $partida->jogador1->id) {
          $jogadorVencedor = $partida->jogador1;
          $jogadorPerdedor = $partida->jogador2;

          $j1pontos = 1000;
          $j1bonus = $bonus;

          $j2pontos = -1000;
          $j2bonus = -10;

        } elseif($jogadorId == $partida->jogador2->id) {
          $jogadorVencedor = $partida->jogador2;
          $jogadorPerdedor = $partida->jogador1;

          $j2pontos = 1000;
          $j2bonus = $bonus;

          $j1pontos = -1000;
          $j1bonus = -10;
        }

        return view('admin.partidas.desistencia', compact('partida', 'j1pontos', 'j1bonus', 'j2pontos', 'j2bonus', 'jogadorVencedor', 'jogadorPerdedor'));
    }

    public function woStore($id, Request $request)
    {
        $data = $request->request->all();

        $partida = Partida::findOrFail($id);

        $jogadorVencedor = Jogador::findOrFail($data['vencedor']);
        $jogadorPerdedor = Jogador::findOrFail($data['perdedor']);

        if($partida->jogador1->id == $jogadorVencedor->id) {

          $partida->jogador1_pontos = 1000;
          $partida->jogador1_bonus = 0;
          $partida->jogador1_vitoria_wo = true;

          $partida->jogador2_pontos = -1000;
          $partida->jogador2_bonus = -10;

        } else {

          $partida->jogador2_pontos = 1000;
          $partida->jogador2_bonus = 0;
          $partida->jogador2_vitoria_wo = true;

          $partida->jogador1_pontos = -1000;
          $partida->jogador1_bonus = -10;

        }

        $partida->status = 'Finalizada';
        $partida->usuario_finalizacao_id = \Auth::user()->id;
        $partida->save();

        notify()->flash('Partida Finalizada', 'success', [
            'timer' => 3000,
            'text' => 'Esta partida foi finalizada como Vitória por W.O',
        ]);

        return redirect()->route('partida_placar', $partida->id);
    }

    public function desistenciaStore($id, Request $request)
    {
        $data = $request->request->all();

        $partida = Partida::findOrFail($id);

        $jogadorVencedor = Jogador::findOrFail($data['vencedor']);
        $jogadorPerdedor = Jogador::findOrFail($data['perdedor']);

        if($partida->jogador1->id == $jogadorVencedor->id) {

          $partida->jogador1_pontos = 1000;
          $partida->jogador1_bonus = 0;
          $partida->jogador1_vitoria_wo = true;

          $partida->jogador2_pontos = -1000;
          $partida->jogador2_bonus = -10;

        } else {

          $partida->jogador2_pontos = 1000;
          $partida->jogador2_bonus = 0;
          $partida->jogador2_vitoria_wo = true;

          $partida->jogador1_pontos = -1000;
          $partida->jogador1_bonus = -10;

        }

        $partida->status = 'Finalizada';
        $partida->usuario_finalizacao_id = \Auth::user()->id;
        $partida->save();

        notify()->flash('Partida Finalizada', 'success', [
            'timer' => 3000,
            'text' => 'Esta partida foi finalizada como Vitória por Desistência',
        ]);

        return redirect()->route('partida_placar', $partida->id);
    }

}

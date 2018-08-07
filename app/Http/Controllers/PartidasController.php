<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partida;
use App\Models\Pessoa\Jogador;
use App\Models\Torneio\Resultado;

class PartidasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function agendamento(Request $request)
    {
        $partidas = [];

        if($request->has('date')) {
          $partidas = Partida::where('data', '>=', (\DateTime::createFromFormat('d/m/Y', $request->get('date')))->setTime(00, 00, 00))
          ->where('data', '<=', (\DateTime::createFromFormat('d/m/Y', $request->get('date')))->setTime(23, 59, 59))
          ->where('tipo_jogo', 'Simples')->get();
        }

       return view('pages.agendamento', compact('partidas'));
    }

    public function agendar(Request $request, $id)
    {
        $partida = Partida::findOrFail($id);

        $jogador = null;

        if($request->has('jogador')) {
          $jogador = Jogador::find($jogador);
        }

        return view('pages.agendar', compact('jogador', 'partida'));
    }

    public function agendarStore(Request $request, $id)
    {
        $partida = Partida::findOrFail($id);

        $data = $request->request->all();

        $jogadores = $data['jogador'];

        foreach ($jogadores as $key => $item) {
          $jogador = Jogador::findOrFail($item);
          $resultado = new Resultado();
          $resultado->jogador_id = $jogador->id;
          $resultado->partida_id = $partida->id;
          $resultado->resultado_final = 0;
          $resultado->save();
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

        $partidas = Partida::where('data', '>=', $inicio)->where('data', '<=', $fim)->where('tipo_jogo', 'Simples')->get();

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

            $horario = \DateTime::createFromFormat('H:i:s', $partida->horario);

            $dataHora = $partida->data->setTime($horario->format('H'), $horario->format('i'));

            $dataFim = (new \DateTime($dataHora->format('Y-m-d H:i')))->modify('+ 1 hour');

            $jogador1 = $jogador2 = 'A definir';

            if($partida->resultado->isNotEmpty()) {
              $jogador1 = $partida->resultado->first()->jogador->pessoa->nome;

              if($partida->resultado->count() > 1) {
                $jogador2 = $partida->resultado->last()->jogador->pessoa->nome;
              }
            }

            $title = $jogador1 . ' x ' . $jogador2;

            return [
                'id' => $partida->id,
                'torneio' => $partida->torneio->nome,
                'quadra' => $partida->quadra->nome,
                'title' => $title,
                'start' => $dataHora->format('Y-m-d H:i'),
                'end' => ($dataFim->format('Y-m-d H:i')),
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

        $partidas = Partida::where('data', '>=', $inicio)->where('data', '<=', $fim)->where('tipo_jogo', 'Simples')->get();

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

            $horario = \DateTime::createFromFormat('H:i:s', $partida->horario);

            $dataHora = $partida->data->setTime($horario->format('H'), $horario->format('i'));

            $dataFim = (new \DateTime($dataHora->format('Y-m-d H:i')))->modify('+ 1 hour');

            $jogador1 = $jogador2 = 'A definir';

            if($partida->resultado->isNotEmpty()) {
              $jogador1 = $partida->resultado->first()->jogador->pessoa->nome;

              if($partida->resultado->count() > 1) {
                $jogador2 = $partida->resultado->last()->jogador->pessoa->nome;
              }
            }

            $title = $jogador1 . ' x ' . $jogador2;

            return [
                'id' => $partida->id,
                'torneio' => $partida->torneio->nome,
                'quadra' => $partida->quadra->nome,
                'title' => $title,
                'start' => $dataHora->format('Y-m-d H:i'),
                'end' => ($dataFim->format('Y-m-d H:i')),
                'color' => $cardCollor,
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
        return view('pages.novo-agendamento', compact('partidas'));
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

        $datapartida = \DateTime::createFromFormat('d/m/Y H:i', $data['inicio']);

        $partida = new Partida();
        $partida->torneio_id = $data['torneio'];
        $partida->quadra_id = $data['quadra'];
        $partida->horario = $datapartida;
        $partida->data = $datapartida;
        $partida->tipo_jogo = 'Simples';
        $partida->semana = $datapartida->format('wY');
        $partida->save();

        if($request->has('jogador')) {

            $jogadores = $data['jogador'];

            foreach ($jogadores as $key => $item) {
              $jogador = Jogador::findOrFail($item);
              $resultado = new Resultado();
              $resultado->jogador_id = $jogador->id;
              $resultado->partida_id = $partida->id;
              $resultado->resultado_final = 0;
              $resultado->save();
            }

        }

        flash('Partida marcada com sucesso!')->success()->important();

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

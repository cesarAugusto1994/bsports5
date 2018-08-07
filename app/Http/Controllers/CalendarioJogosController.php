<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partida;

class CalendarioJogosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$date = new \DateTime('2018-07-08');

        $resultado = [];

        if($request->has('date')) {

          $date = (\DateTime::createFromFormat('d/m/Y', $request->get('date')))->setTime(0,0,0);

          $partidas = Partida::where('data', $date)
          ->orderBy('horario')
          ->get();

        } else {

          $partidas = Partida::where('data', now()->setTime(0,0,0))
          ->orderBy('horario')
          ->get();

        }

        #dd($partidas);

        foreach ($partidas as $key => $partida) {
          $resultado[$partida->horario]['quadra-'.$partida->quadra->id] = [

              'id' => $partida->id,
              'quadra_id' => $partida->quadra->id,
              'quadra' => $partida->quadra->nome,
              'horario' => $partida->horario,
              'jogador1' => $partida->resultado->first()->jogador->pessoa->nome ?? '',
              'jogador2' => $partida->resultado->count() == 2 ? $partida->resultado->last()->jogador->pessoa->nome : '',
              'jogador1-pontos' => $partida->resultado->first()->resultado_final ?? 0,
              'jogador2-pontos' => $partida->resultado->count() == 2 ? $partida->resultado->last()->resultado_final : 0,
          ];
        }

        $partidas = $resultado;

        return view('pages.calendario', compact('partidas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

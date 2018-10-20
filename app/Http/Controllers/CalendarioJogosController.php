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
        $resultado = [];

        if($request->has('date')) {

          $inicio = (\DateTime::createFromFormat('d/m/Y', $request->get('date')))->setTime(0,0,0);
          $fim = (\DateTime::createFromFormat('d/m/Y', $request->get('date')))->setTime(23,59,59);

          $partidas = Partida::where('inicio', '>=', $inicio)->where('fim', '<=', $fim)
          ->orderBy('inicio')
          ->get();

        } else {

          $partidas = Partida::where('inicio', '>=', now()->setTime(0,0,0))->where('fim', '<=', now()->setTime(23,59,59))
          ->orderBy('inicio')
          ->get();

        }

        foreach ($partidas as $key => $partida) {
          $resultado[$partida->inicio->format('d/m/Y H:i') .' - '.$partida->fim->format('H:i')]['quadra-'.$partida->quadra->id] = [

              'id' => $partida->id,
              'quadra_id' => $partida->quadra->id,
              'quadra' => $partida->quadra->nome,
              'horario' => $partida->inicio->format('H:i'),
              'jogador1' => $partida->jogador1->nome ?? '',
              'jogador2' => $partida->jogador2->nome ?? '',
              'jogador1-pontos' => $partida->jogador1_resultado_final ?? 0,
              'jogador2-pontos' => $partida->jogador2_resultado_final ?? 0,
          ];
        }

        $partidas = $resultado;

        return view('pages.calendario', compact('partidas'));
    }
}

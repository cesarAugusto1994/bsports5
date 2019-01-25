<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Torneio\Resultado;
use App\Models\Partida;
use App\Helpers\Helper;

class ResultadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $partidas = Partida::orderByDesc('id')->paginate(10);
        $categorias = Helper::categorias();

        if($request->has('date')) {
          $partidas = Partida::where('inicio', '>=', (\DateTime::createFromFormat('d/m/Y', $request->get('date')))->setTime(00, 00, 00))
          ->where('fim', '<=', (\DateTime::createFromFormat('d/m/Y', $request->get('date')))->setTime(23, 59, 59))
          ->where('tipo_jogo', 'Simples')->get();
        }

        return view('pages.resultados', compact('partidas', 'categorias'));
    }
}

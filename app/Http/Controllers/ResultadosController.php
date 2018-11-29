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
        return view('pages.resultados', compact('partidas', 'categorias'));
    }
}

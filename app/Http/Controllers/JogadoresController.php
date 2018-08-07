<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoa\Jogador;
use App\Models\Jogador\Mensalidade;
use Auth;

class JogadoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $jogadores = \App\Models\Pessoa\Jogador::orderByDesc('id')->paginate();

      return view('admin.jogadores', compact('jogadores'));
    }

    public function create()
    {
        return view('admin.jogadores.create');
    }

    public function show($slug, $id)
    {
        $jogador = Jogador::findOrFail($id);

        return view('pages.jogador', compact('jogador'));
    }

    public function toAjax(Request $request)
    {
        $data = $request->request->all();

        $search = $data['search'];

        $user = \Auth::user();

        $jogadores = \App\Models\Pessoa::where('nome', 'like', "%$search%")->get();

        $resultatos = [];

        $resultatos = $jogadores->map(function($jogador) {
            return [
              'nome' => $jogador->nome,
              'email' => $jogador->email,
              'id' => $jogador->id,
              'categoria' => $jogador->jogador->categoria ? $jogador->jogador->categoria->nome : null,
            ];
        });

        return json_encode($resultatos);
    }

    public function mensalidade()
    {
      $jogadores = Mensalidade::all();

      return view('admin.jogadores.index', compact('jogadores'));
    }
}

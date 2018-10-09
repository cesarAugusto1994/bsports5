<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Pessoa, Partida, Semana, Categoria, Pagina};
use App\Models\Pessoa\{Jogador, Telefone};

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();

        $pessoa = Pessoa::where('email', $user->email)->get()->first();
        $jogador = [];

        if($pessoa) {
          $jogador = Jogador::where('pessoa_id', $pessoa->id)->get()->first();
        }

        return view('jogador.dashboard', compact('jogador'));
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
    public function show()
    {
        $user = \Auth::user();

        $pessoa = Pessoa::where('email', $user->email)->get()->first();
        $jogador = [];

        if($pessoa) {
          $jogador = Jogador::where('pessoa_id', $pessoa->id)->get()->first();
        }

        return view('jogador.perfil', compact('jogador'));
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
        $data = $request->request->all();

        $user = \Auth::user();
        $user->name = $data['nome'];
        $user->email = $data['email'];

        if($request->has('password')) {
            $user->password = bcrypt($data['password']);
        }

        $user->save();

        $pessoa = Pessoa::findOrFail($id);
        $pessoa->nome = $data['nome'];
        $pessoa->email = $data['email'];

        if($request->has('telefone')) {
           $pessoa->telefone = $data['telefone'];
        }

        if($request->has('celular')) {
           $pessoa->celular = $data['celular'];
        }

        if($request->has('cpf')) {
           $pessoa->cpf = $data['cpf'];
        }

        if($request->has('nascimento')) {
           $pessoa->nascimento = \DateTime::createFromFormat('d/m/Y', $data['nascimento']);
        }

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $pessoa->avatar = $request->avatar->store('avatar');
        }

        $pessoa->save();

        $jogador = $pessoa->jogador;
        $jogador->lateralidade = $data['lateralidade'];
        $jogador->save();

        flash('Perfil Atualizado com sucesso.')->success()->important();

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
        //
    }
}

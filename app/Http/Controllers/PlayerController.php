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

        $jogador = Jogador::where('email', $user->email)->get()->first();

        return view('jogador.dashboard', compact('jogador'));
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

        $jogador = Jogador::where('email', $user->email)->get()->first();

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

        $hasEmail = Jogador::where('email', $data['email'])->whereNotIn('id', [$id])->get();

        if($hasEmail->isNotEmpty()){
          flash('Email já existente.')->warning()->important();
          return redirect()->back();
        }

        $jogador = Jogador::findOrFail($id);
        $jogador->nome = $data['nome'];
        $jogador->email = $data['email'];

        if($request->has('telefone')) {
           $jogador->telefone = $data['telefone'];
        }

        if($request->has('celular')) {
           $jogador->celular = $data['celular'];
        }

        if($request->has('cpf')) {
           $jogador->cpf = $data['cpf'];
        }

        if($request->has('nascimento')) {
           $jogador->nascimento = \DateTime::createFromFormat('d/m/Y', $data['nascimento']);
        }

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $jogador->avatar = $request->avatar->store('avatar');
        }

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

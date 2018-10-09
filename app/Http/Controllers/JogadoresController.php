<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoa\Jogador;
use App\Models\Pessoa;
use App\Models\Jogador\Mensalidade;
use Auth;
use jeremykenedy\LaravelRoles\Models\Role;

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

      return view('admin.jogadores.index', compact('jogadores'));
    }

    public function create()
    {
        return view('admin.jogadores.create');
    }

    public function show($id)
    {
        $jogador = Jogador::uuid($id);

        return view('pages.jogador', compact('jogador'));
    }

    public function view($id)
    {
        $jogador = Jogador::uuid($id);
        return view('admin.jogadores.perfil', compact('jogador'));
    }

    public function toAjax(Request $request)
    {
        $data = $request->request->all();

        $search = $data['search'];

        $user = \Auth::user();

        $jogadores = \App\Models\Pessoa::where('nome', 'like', "%$search%")
        ->orWhere('email', 'like', "%$search%")
        ->get();

        $resultatos = [];

        $resultatos = $jogadores->map(function($jogador) {

            $categoria = null;

            if($jogador->jogador && $jogador->jogador->categoria) {
                $categoria = $jogador->jogador->categoria->nome;
            }

            return [
              'nome' => $jogador->nome,
              'email' => $jogador->email,
              'id' => $jogador->id,
              'categoria' => $categoria,
            ];
        });

        return json_encode($resultatos);
    }

    public function mensalidade()
    {
      $jogadores = Mensalidade::all();

      return view('admin.jogadores.index', compact('jogadores'));
    }

    public function store(Request $request)
    {
        $data = $request->request->all();

        $hasEmail = Pessoa::where('email', $data['email'])->get();

        if($hasEmail->isNotEmpty()){
          flash('Email já existente.')->warning()->important();
          return redirect()->back();
        }

        $userRole = Role::where('name', '=', 'User')->first();

        $user = new \App\User();
        $user->name = $data['nome'];
        $user->email = $data['email'];

        if($request->has('password')) {
            $user->password = bcrypt($data['password']);
        }

        $user->save();
        $user->attachRole($userRole);

        $data['ativo'] = $request->has('ativo') ? true : false;

        $pessoa = new Pessoa();
        $pessoa->nome = $data['nome'];
        $pessoa->email = $data['email'];
        $pessoa->ativo = $data['ativo'];

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

        $jogador = new Jogador();
        $jogador->pessoa_id = $pessoa->id;
        $jogador->categoria_simples_id = $data['categoria'];
        $jogador->lateralidade = $data['lateralidade'];
        $jogador->ativo = $data['ativo'];
        $jogador->save();

        flash('Perfil Adicionado com sucesso.')->success()->important();
        return redirect()->route('player_profile', $jogador->uuid);
    }

    public function update(Request $request, $id)
    {
        $data = $request->request->all();

        $user = \Auth::user();
        $user->name = $data['nome'];

        if($request->has('password')) {
            $user->password = bcrypt($data['password']);
        }

        $user->save();

        $data['ativo'] = $request->has('ativo') ? true : false;

        $pessoa = Pessoa::findOrFail($id);
        $pessoa->nome = $data['nome'];
        $pessoa->email = $data['email'];
        $pessoa->ativo = $data['ativo'];

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
        $jogador->ativo = $data['ativo'];
        $jogador->save();

        flash('Perfil Atualizado com sucesso.')->success()->important();

        return redirect()->back();
    }
}

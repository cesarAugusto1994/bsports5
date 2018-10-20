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

        $jogadores = \App\Models\Pessoa\Jogador::where('nome', 'like', "%$search%")
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

        $hasEmail = Jogador::where('email', $data['email'])->get();

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

        $jogador = new Jogador();
        $jogador->nome = $data['nome'];
        $jogador->email = $data['email'];
        $jogador->ativo = $data['ativo'];

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

        $jogador->categoria_id = $data['categoria'];
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

        $jogador = Jogador::findOrFail($id);
        $jogador->nome = $data['nome'];
        $jogador->email = $data['email'];
        $jogador->ativo = $data['ativo'];

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
        $jogador->ativo = $data['ativo'];
        $jogador->save();

        flash('Perfil Atualizado com sucesso.')->success()->important();

        return redirect()->back();
    }
}

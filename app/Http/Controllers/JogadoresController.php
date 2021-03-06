<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoa\Jogador;
use App\Models\{Pessoa,Semestre};
use App\Models\Jogador\Mensalidade;
use Auth;
use App\Helpers\Helper;
use jeremykenedy\LaravelRoles\Models\Role;

class JogadoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->request->all();

        $jogadores = Jogador::orderByDesc('id');

        if ($request->filled('id')) {
            $jogadores->where('id', $request->get('id'));
        }

        if ($request->filled('nome')) {
            $jogadores->where('nome', 'like', '%'.$request->get('nome').'%');
        }

        if ($request->filled('email')) {
            $jogadores->where('email', 'like', '%'.$request->get('email').'%');
        }

        if ($request->filled('categoria')) {
            $jogadores->where('categoria_id', $request->get('categoria'));
        }

        if ($request->filled('status')) {
            $jogadores->where('ativo', $request->get('status'));
        }

        if (!$request->filled('status')) {
            $jogadores->where('ativo', true);
        }

        $quantidade = $jogadores->count();

        $jogadores = $jogadores->paginate();

        foreach ($data as $key => $value) {
            $jogadores->appends($key, $value);
        }

        $categorias = Helper::categorias();

        return view('admin.jogadores.index', compact('jogadores', 'quantidade', 'categorias'));
    }

    public function semPartida(Request $request)
    {
        $data = $request->request->all();

        $jogadores = Jogador::where('ativo',true)->orderByDesc('id');

        $start = now()->modify('monday this week');
        $end = now()->modify('sunday this week');

        #dd([$start,$end]);

        if($request->has('start') && $request->has('end')) {
          $start = \DateTime::createFromFormat('d/m/Y', $data['start']);
          $end = \DateTime::createFromFormat('d/m/Y', $data['end']);
        }

        $jogadores->whereDoesntHave('partidas', function($query) use($start, $end) {
              $query->where('inicio', '>', $start);
              $query->where('fim', '<', $end);
        });

        $quantidade = $jogadores->count();

        $jogadores = $jogadores->paginate();

        foreach ($data as $key => $value) {
            $jogadores->appends($key, $value);
        }

        return view('admin.jogadores.sem_partidas', compact('jogadores', 'quantidade', 'start', 'end'));
    }

    public function create()
    {
        $categorias = Helper::categorias();
        return view('admin.jogadores.create',compact('categorias'));
    }

    public function show($id)
    {
        $jogador = Jogador::uuid($id);
        $categorias = Helper::categorias();

        $partidaslist=$partidaslistWeekEnd=[];

        $semestreVigente = Semestre::where('inicio', '<=', now()->format('Y-m-d'))
          ->where('fim', '>=', now()->format('Y-m-d'))
          ->get();

        $semestre = $semestreVigente->last();

        if(!$semestre) {
          notify()->flash('Classificação não carregada', 'error', [
              'text' => 'Informe um semestre que esteja em vigencia.',
          ]);
          return back();
        }

        $partidas = $jogador->partidas->filter(function($partida) use ($semestre) {
            return $partida->semestre_id == $semestre->id;
        });

        $partidas2 = $jogador->partidas2->filter(function($partida) use ($semestre) {
            return $partida->semestre_id == $semestre->id;
        });

        foreach ($partidas as $key => $partida) {
            $partidaslistWeekEnd[$partida->semana][] = $partida->jogador1_pontos+$partida->jogador1_bonus;
        }

        foreach ($partidas2 as $key => $partida) {
            $partidaslistWeekEnd[$partida->semana][] = $partida->jogador2_pontos+$partida->jogador2_bonus;
        }

        //dd($partidaslistWeekEnd);

        $semanasPontos = [];

        foreach ($partidaslistWeekEnd as $key => $item) {
            $semanasPontos[] = array_sum($item) / count($item);
        }

        //dd($semanasPontos);

        $pontos = array_sum(array_merge($semanasPontos, $partidaslist));

        $pontos = round($pontos,2);

        return view('pages.jogador', compact('jogador', 'categorias', 'pontos'));
    }

    public function view($id)
    {
        $jogador = Jogador::uuid($id);
        $categorias = Helper::categorias();
        return view('admin.jogadores.perfil', compact('jogador', 'categorias'));
    }

    public function toAjax(Request $request)
    {
        $data = $request->request->all();

        $search = $data['search'];

        $user = \Auth::user();

        $jogadores = \App\Models\Pessoa\Jogador::where('nome', 'like', "%$search%")
        ->orWhere('email', 'like', "%$search%")
        ->where('ativo', true)
        ->get();

        $jogadores = $jogadores->filter(function($jogador) {
            return $jogador->ativo;
        });

        $resultatos = [];

        $resultatos = $jogadores->map(function($jogador) {

            $categoria = null;

            if($jogador->categoria) {
                $categoria = $jogador->categoria->nome;
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

        if($request->has('cep')) {
           $jogador->cep = $data['cep'];
        }

        if($request->has('endereco')) {
           $jogador->endereco = $data['endereco'];
        }

        if($request->has('numero')) {
           $jogador->numero = $data['numero'];
        }

        if($request->has('bairro')) {
           $jogador->bairro = $data['bairro'];
        }

        if($request->has('cidade')) {
           $jogador->cidade = $data['cidade'];
        }

        if($request->has('estado')) {
           $jogador->estado = $data['estado'];
        }

        $jogador->categoria_id = $data['categoria'];
        $jogador->lateralidade = $data['lateralidade'];
        $jogador->ativo = $data['ativo'];
        $jogador->aluno = $request->has('aluno');
        $jogador->save();

        $user = new \App\User();
        $user->jogador_id = $jogador->id;
        $user->name = $data['nome'];
        $user->email = $data['email'];
        if($request->has('password')) {
            $user->password = bcrypt($data['password']);
        }
        $user->save();
        $user->attachRole($userRole);

        flash('Perfil Adicionado com sucesso.')->success()->important();
        return redirect()->route('player_profile', $jogador->uuid);
    }

    public function update(Request $request, $id)
    {
        $data = $request->request->all();

        $data['ativo'] = $request->has('ativo');

        $jogador = Jogador::findOrFail($id);
        $jogador->nome = $data['nome'];

        if($request->has('email')) {
            $jogador->email = $data['email'];
            $usuario = $jogador->usuario;
            if($usuario) {
                $usuario->email = $data['email'];
                $usuario->save();
            }
        }

        $jogador->ativo = $data['ativo'];
        $jogador->categoria_id = $data['categoria'];

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

        if($request->has('cep')) {
           $jogador->cep = $data['cep'];
        }

        if($request->has('endereco')) {
           $jogador->endereco = $data['endereco'];
        }

        if($request->has('numero')) {
           $jogador->numero = $data['numero'];
        }

        if($request->has('bairro')) {
           $jogador->bairro = $data['bairro'];
        }

        if($request->has('cidade')) {
           $jogador->cidade = $data['cidade'];
        }

        if($request->has('estado')) {
           $jogador->estado = $data['estado'];
        }

        $jogador->lateralidade = $data['lateralidade'];
        $jogador->ativo = $data['ativo'];
        $jogador->aluno = $request->has('aluno');
        $jogador->save();

        if($request->filled('password')) {
          if($jogador->usuario) {
             $user = $jogador->usuario;
             $user->password = bcrypt($data['password']);
             $user->name = $data['nome'];
             $user->save();
          }
        }

        flash('Perfil Atualizado com sucesso.')->success()->important();

        return redirect()->back();
    }

    public function inativarEmMassa(Request $request)
    {
        if(!$request->has('selecao_jogadores')) {
          flash('Nenhum jogador selecionado.')->warning()->important();
          return redirect()->back();
        }

        foreach ($request->get('selecao_jogadores') as $key => $item) {
            $jogador = Jogador::findOrFail($item);
            $jogador->ativo = false;
            $jogador->save();
        }

        flash('Jogadores inativados com sucesso.')->success()->important();
        return redirect()->back();
    }

    public function cep(Request $request)
    {
        $cep = $request->get('cep');

        $cepresult = app('Cep')->find($cep);

        $cepInfo = $cepresult->toJson();

        $resultado = json_decode($cepInfo->result(), 1);

        if(!empty($resultado)) {
            return json_encode([
              'success' => true,
              'message' => 'Cep encontrado',
              'data' => $resultado
            ]);
        }

        return json_encode([
          'success' => false,
          'message' => 'Cep não encontrado'
        ]);
    }

    public function destroy($id)
    {
        try {

            $jogador = Jogador::findOrFail($id);

            if($jogador->partidas->isNotEmpty() || $jogador->partidas2->isNotEmpty()) {
              return response()->json([
                'code' => 501,
                'message' => 'Este jogador possuí partidas vinculadas a ele.'
              ]);
            }

            $jogador->semanas->map(function($semana) {
                $semana->delete();
            });

            $jogador->delete();

            return response()->json([
              'code' => 201,
              'message' => 'registro removido com sucesso!'
            ]);

        } catch(Exception $e) {
            return response()->json([
              'code' => 501,
              'message' => $e->getMessage()
            ]);
        }
    }
}

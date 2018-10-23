@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Jogadores</h1>
@stop

@section('content')

<div class="row">

  <div class="col-md-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Filtros</h3>
        </div>
        <div class="box-body">


          <form action="#">
              <div class="box-body">
                <div class="row">

                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="codigo">Codigo</label>
                      <input type="text" class="form-control" id="codigo" name="id">
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="codigo">Nome</label>
                      <input type="text" class="form-control" id="nome" name="nome">
                    </div>
                  </div>

                </div>
              </div>
          </form>

        </div>
      </div>
  </div>

  <div class="col-md-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Jogadores</h3>
      </div>
      <div class="box-body">
        <div class="table-responsive">
          <table class="table no-margin">
            <thead>
            <tr>
              <th><input type="checkbox" name="selecao_jogadores_all" value="1"/></th>
              <th>ID</th>
              <th>Nome</th>
              <th>Email</th>
              <th>Pontos</th>
              <th>Ativo</th>
              <th>Opções</th>
            </tr>
            </thead>
            <tbody>
              @foreach($jogadores as $jogador)
                <tr>
                  <td><input type="checkbox" name="selecao_jogadores[]" value="{{ $jogador->id }}"/></td>
                  <td><a href="#">{{ $jogador->id }}</a></td>
                  <td><a href="{{ route('player_profile', $jogador->uuid) }}">{{ $jogador->nome }}</a></td>
                  <td>{{ $jogador->email }}</td>
                  <td>{{ $jogador->partidas->sum('jogador1_pontos') - $jogador->partidas->sum('jogador1_bonus') +
                    $jogador->partidas2->sum('jogador2_pontos') - $jogador->partidas2->sum('jogador2_bonus') }}</td>
                  <td>
                    {{ $jogador->ativo ? 'Ativo' : 'Inativo' }}
                  </td>
                  <td>
                    <a href="{{ route('player_profile', $jogador->uuid) }}" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Editar</a>
                  </td>
                </tr>
              @endforeach

            </tbody>
          </table>
        </div>
      </div>
      <div class="box-footer clearfix">
        <a href="{{ route('players.create') }}" class="btn btn-sm btn-info btn-flat pull-left">Novo Jogador</a>
        <span class="pull-right">{{ $jogadores->links() }}</span>
      </div>
    </div>
  </div>
</div>

@stop

@section('css')
@stop

@section('js')
@stop

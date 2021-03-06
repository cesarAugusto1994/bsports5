@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Jogadores</h1>
@stop

@section('content')

<div class="row">

  <div class="col-md-12">
  </div>

  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Jogadores</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="table-responsive">
          <table class="table no-margin">
            <thead>
            <tr>
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
                  <td><a href="#">{{ $jogador->id }}</a></td>
                  <td><a href="{{ route('player_profile', $jogador->uuid) }}">{{ $jogador->pessoa->nome }}</a></td>
                  <td>{{ $jogador->pessoa->email }}</td>
                  <td>{{ $jogador->resultados->sum('pontos') - $jogador->resultados->sum('bonus') }}</td>
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
        <!-- /.table-responsive -->
      </div>
      <!-- /.box-body -->
      <div class="box-footer clearfix">
        <a href="{{ route('players.create') }}" class="btn btn-sm btn-info btn-flat pull-left">Novo Jogador</a>
        <span class="pull-right">{{ $jogadores->links() }}</span>
      </div>
      <!-- /.box-footer -->
    </div>
  </div>
</div>


@stop

@section('css')
@stop

@section('js')
@stop

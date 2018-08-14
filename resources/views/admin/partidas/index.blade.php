@extends('adminlte::page')

@section('title', 'Partidas')

@section('content_header')
    <h1>Partidas</h1>
@stop

@section('content')

<div class="row">

  <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Opções</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

          <a href="{{ route('matches.create') }}" class="btn btn-sm btn-info btn-flat pull-left">Nova Partida</a>

        </div>
      </div>
  </div>

  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Partidas</h3>

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
              <th>Horário</th>
              <th>Jogadores</th>
              <th>Resultado</th>
              <th>Opções</th>
            </tr>
            </thead>
            <tbody>
              @foreach($partidas as $partida)
                <tr>
                  <td># {{ $partida->id }}</td>
                  <td>{{ $partida->data->format('d/m/Y') }} : {{ $partida->horario }}</td>

                  @php

                    $jogador1 = 'A definir';
                    $jogador2 = 'A definir';
                    $jogador1Pontos = 0;
                    $jogador2Pontos = 0;
                    $jogador1Uuid = '';
                    $jogador2Uuid = '';

                    if($partida->resultado->isNotEmpty()) {
                        $jogador1 = $partida->resultado->first()->jogador->pessoa->nome;
                        $jogador1Pontos = $partida->resultado->first()->resultado_final;
                        $jogador1Uuid = $partida->resultado->first()->jogador->uuid;
                    }

                    if($partida->resultado->isNotEmpty() && $partida->resultado->count() == 2) {
                        $jogador2 = $partida->resultado->last()->jogador->pessoa->nome;
                        $jogador2Pontos = $partida->resultado->last()->resultado_final;
                        $jogador2Uuid = $partida->resultado->last()->jogador->uuid;
                    }

                  @endphp

                  <td>
                    @if($jogador1Uuid)
                    <a href="{{ route('player_profile', $jogador1Uuid) }}">{{ $jogador1 }}</a>
                    @else
                    {{ $jogador1 }}
                    @endif
                    x
                    @if($jogador2Uuid)
                    <a href="{{ route('player_profile', $jogador2Uuid) }}">{{ $jogador2 }}</a></td>
                    @else
                    {{ $jogador2 }}
                    @endif
                  <td>
                    {{ $jogador1Pontos }} x {{ $jogador2Pontos }}
                  </td>
                  <td></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.table-responsive -->
      </div>
      <!-- /.box-body -->
      <div class="box-footer clearfix">
        <a href="{{ route('matches.create') }}" class="btn btn-sm btn-info btn-flat pull-left">Nova Partida</a>
        <span class="pull-right">{{ $partidas->links() }}</span>
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

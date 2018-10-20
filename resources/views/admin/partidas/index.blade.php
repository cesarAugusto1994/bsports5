@extends('adminlte::page')

@section('title', 'Partidas')

@section('content_header')
    <h1>Partidas</h1>
@stop

@section('content')

<div class="row">

  <div class="col-md-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Opções</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

          <a href="{{ route('matches.create') }}" class="btn btn-sm btn-info btn-flat pull-left">Nova Partida</a>

        </div>
      </div>
  </div>

  <div class="col-md-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Partidas</h3>
      </div>
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
                  <td>{{ $partida->inicio->format('d/m/Y') }} <b>{{ $partida->inicio->format('H:i') }} : {{ $partida->fim->format('H:i') }}</b></td>

                  @php

                    $jogador1 = 'A definir';
                    $jogador2 = 'A definir';
                    $jogador1Pontos = 0;
                    $jogador2Pontos = 0;
                    $jogador1Uuid = '';
                    $jogador2Uuid = '';

                    $showPlacar = $podeRemover = false;

                    if($partida->jogador1) {
                        $jogador1 = $partida->jogador1->nome;
                        $jogador1Pontos = $partida->jogador1_resultado_final;
                        $jogador1Uuid = $partida->jogador1->uuid;
                    }

                    if($partida->jogador2) {
                        $jogador2 = $partida->jogador2->nome;
                        $jogador2Pontos = $partida->jogador2_resultado_final;
                        $jogador2Uuid = $partida->jogador2->uuid;
                    }

                    if($partida->inicio > now()) {
                      $podeRemover = true;
                    } else {
                      $showPlacar = true;
                    }

                  @endphp

                  <td>
                    @if($jogador1Uuid)
                      @if($podeRemover)
                        <a class="btn btn-danger btn-xs" href="{{ route('remover_jogador_partida', [$partida->id, $partida->jogador1->id]) }}"><i class="fa fa-trash"></i></a>
                      @endif
                        <a href="{{ route('player_profile', $jogador1Uuid) }}">{{ $jogador1 }}</a>
                      @if($showPlacar)
                        {{ $jogador1Pontos }}
                      @endif
                    @else
                        {{ $jogador1 }}
                    @endif
                    x
                    @if($jogador2Uuid)
                        @if($showPlacar)
                            {{ $jogador2Pontos }}
                        @endif
                        <a href="{{ route('player_profile', $jogador2Uuid) }}">{{ $jogador2 }}</a>
                        @if($podeRemover)
                            <a class="btn btn-danger btn-xs" href="{{ route('remover_jogador_partida', [$partida->id, $partida->jogador2->id]) }}"><i class="fa fa-trash"></i></a>
                        @endif
                    @else
                        {{ $jogador2 }}
                    @endif
                  </td>
                  <td>
                    {{ $jogador1Pontos }} x {{ $jogador2Pontos }}
                  </td>
                  <td>
                    <button data-route="{{ route('partida.destroy', ['id' => $partida->id]) }}" class="btn btn-sm btn-danger btnRemoveItem"><i class="fa fa-trash"></i> </button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="box-footer clearfix">
        <a href="{{ route('matches.create') }}" class="btn btn-sm btn-info btn-flat pull-left">Nova Partida</a>
        <span class="pull-right">{{ $partidas->links() }}</span>
      </div>
    </div>
  </div>
</div>

@stop

@section('css')
@stop

@section('js')
@stop

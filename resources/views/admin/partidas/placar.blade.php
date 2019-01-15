@extends('adminlte::page')

@section('title', 'Partidas')

@section('content_header')
    <h1>Placar Partida</h1>
@stop

@section('content')

<div class="row">

  <div class="col-md-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Partida #{{$partida->id}}</h3>
      </div>
      <div class="box-body">
        <div class="table-responsive">

          <p class="lead">Quadra: {{$partida->quadra->nome}}</p>

          @if(!$partida->finalizado)

              @if(!$partida->jogador1 || !$partida->jogador2)

              <div class="alert alert-info" role="alert">
                  <h2>Observação</h2>
                  <p class="lead">Só é permitida a manipulação dos pontos, se os dois jogadores forem escalados para a partida.</p>
              </div>

              @else
                  <a href="{{ route('editar_partida_placar', $partida->id) }}" class="btn btn-dropbox btn-lg">Atualizar Placar</a>
              @endif

          @else

            <div class="alert alert-success" role="alert">
                <p class="lead">Esta partida foi finalizada.</p>
            </div>

          @endif

        </div>
      </div>
    </div>
  </div>

@if($partida->jogador1)
  <div class="col-md-6">
    <div class="box box-widget widget-user-2">

      <div class="widget-user-header bg-aqua-active">
        <div class="widget-user-image">
          <img class="img-circle" src="{{ route('image', ['link'=>$partida->jogador1->avatar]) }}" alt="">
        </div>
        <!-- /.widget-user-image -->
        <h3 class="widget-user-username">{{ $partida->jogador1->nome ?? '-' }}</h3>
        <h5 class="widget-user-desc">{{ $partida->jogador1->categoria->nome ?? '-' }}</h5>
        <h5 class="widget-user-desc"></h5>
      </div>

      <div class="box-footer">
        <div class="row">
          <div class="col-sm-4 border-right">
            <div class="description-block">
              <h5 class="description-header">{{ $partida->jogador1_set1 }}</h5>
              <span class="description-text">1º SET</span>
            </div>
          </div>
          <div class="col-sm-4 border-right">
            <div class="description-block">
              <h5 class="description-header">{{ $partida->jogador1_set2 }}</h5>
              <span class="description-text">2º SET</span>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="description-block">
              <h5 class="description-header">{{ $partida->jogador1_set3 }}</h5>
              <span class="description-text">3º SET</span>
            </div>
          </div>

          <div class="col-sm-3 border-right">
            <div class="description-block">
              <h5 class="description-header">{{ $partida->jogador1_resultado_final }}</h5>
              <span class="description-text">Resultado</span>
            </div>
          </div>
          <div class="col-sm-3 border-right">
            <div class="description-block">
              <h5 class="description-header">{{ $partida->jogador1_tiebreak }}</h5>
              <span class="description-text">Tiebreak</span>
            </div>
          </div>
          <div class="col-sm-3 border-right">
            <div class="description-block">
              <h5 class="description-header">{{ $partida->jogador1_pontos }}</h5>
              <span class="description-text">Pontos</span>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="description-block">
              <h5 class="description-header">{{ $partida->jogador1_bonus }}</h5>
              <span class="description-text">Bonus</span>
            </div>
          </div>

          @if(!$partida->finalizado)

              @if($partida->jogador1 && $partida->jogador2)

              <div class="col-sm-6">
                <div class="description-block">
                  <span class="description-text"><a class="btn btn-default btn-block btn-lg" href="{{ route('wo', [$partida->id, $partida->jogador1_id]) }}">Vitória por WO</a></span>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="description-block">
                  <span class="description-text"><a class="btn btn-default btn-block btn-lg" href="{{ route('desistencia', [$partida->id, $partida->jogador1_id]) }}">Desistência</a></span>
                </div>
              </div>

              @endif

          @else

              <div class="col-sm-12">
                <div class="description-block">
                  <h1>{{ $partida->jogador1_pontos > $partida->jogador2_pontos ? 'Venceu' : 'Perdeu' }} </h1>
                </div>
              </div>

          @endif

        </div>
      </div>
    </div>
  </div>
@endif
@if($partida->jogador2)
  <div class="col-md-6">
    <div class="box box-widget widget-user-2">

      <div class="widget-user-header bg-green-active">
        <div class="widget-user-image">
          <img class="img-circle" src="{{ route('image', ['link'=>$partida->jogador2->avatar]) }}" alt="">
        </div>
        <!-- /.widget-user-image -->
        <h3 class="widget-user-username">{{ $partida->jogador2->nome ?? '-' }}</h3>
        <h5 class="widget-user-desc">{{ $partida->jogador2->categoria->nome ?? '-' }}</h5>
        <h5 class="widget-user-desc"></h5>
      </div>


      <div class="box-footer">
        <div class="row">
          <div class="col-sm-4 border-right">
            <div class="description-block">
              <h5 class="description-header">{{ $partida->jogador2_set1 }}</h5>
              <span class="description-text">1º SET</span>
            </div>
          </div>
          <div class="col-sm-4 border-right">
            <div class="description-block">
              <h5 class="description-header">{{ $partida->jogador2_set2 }}</h5>
              <span class="description-text">2º SET</span>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="description-block">
              <h5 class="description-header">{{ $partida->jogador2_set3 }}</h5>
              <span class="description-text">3º SET</span>
            </div>
          </div>

          <div class="col-sm-3 border-right">
            <div class="description-block">
              <h5 class="description-header">{{ $partida->jogador2_resultado_final }}</h5>
              <span class="description-text">Resultado</span>
            </div>
          </div>
          <div class="col-sm-3 border-right">
            <div class="description-block">
              <h5 class="description-header">{{ $partida->jogador2_tiebreak }}</h5>
              <span class="description-text">Tiebreak</span>
            </div>
          </div>
          <div class="col-sm-3 border-right">
            <div class="description-block">
              <h5 class="description-header">{{ $partida->jogador2_pontos }}</h5>
              <span class="description-text">Pontos</span>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="description-block">
              <h5 class="description-header">{{ $partida->jogador2_bonus }}</h5>
              <span class="description-text">Bonus</span>
            </div>
          </div>

          @if(!$partida->finalizado)

              @if($partida->jogador1 && $partida->jogador2)

              <div class="col-sm-6">
                <div class="description-block">
                  <span class="description-text"><a class="btn btn-default btn-block btn-lg" href="{{ route('wo', [$partida->id, $partida->jogador2_id]) }}">Vitória por WO</a></span>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="description-block">
                  <span class="description-text"><a class="btn btn-default btn-block btn-lg" href="{{ route('desistencia', [$partida->id, $partida->jogador2_id]) }}">Desistência</a></span>
                </div>
              </div>

              @endif

          @else

              <div class="col-sm-12">
                <div class="description-block">
                  <h1>{{ $partida->jogador2_pontos > $partida->jogador1_pontos ? 'Venceu' : 'Perdeu' }} </h1>
                </div>
              </div>

          @endif

        </div>
      </div>
    </div>
  </div>
@endif
</div>

@stop

@section('css')
@stop

@section('js')
@stop

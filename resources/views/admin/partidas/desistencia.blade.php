@extends('adminlte::page')

@section('title', 'Desistencia')

@section('content_header')
    <h1> Desistencia</h1>
@stop

@section('content')

<div class="row">

  <form method="post" action="{{ route('wo_store', [$partida->id]) }}">
    {{csrf_field()}}

    <input type="hidden" name="vencedor" value="{{ $jogadorVencedor->id }}"/>
    <input type="hidden" name="perdedor" value="{{ $jogadorPerdedor->id }}"/>

    <div class="col-md-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Partida #{{$partida->id}}</h3>
        </div>
        <div class="box-body">
            <p class="lead">Deseja finalizar esta partida como Desistencia?</p>
        </div>
      </div>
    </div>

    @if($partida->jogador1)
      <div class="col-md-6">
        <div class="box box-widget widget-user">
          <div class="widget-user-header bg-aqua-active">
            <h3 class="widget-user-username">Jogador 1: {{ $partida->jogador1->nome ?? '-' }}</h3>
            <h5 class="widget-user-desc">{{ $partida->jogador1->categoria->nome ?? '-' }}</h5>
          </div>
          <div class="widget-user-image">
            <img class="img-circle" src="{{ route('image', ['link'=>$partida->jogador1->avatar]) }}" alt="">
          </div>
          <div class="box-footer">
            <div class="row">

              <div class="col-sm-6 border-right">
                <div class="description-block">
                  <h1>{{ $j1pontos }}</h1>
                  <span class="description-text">Pontos</span>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="description-block">
                  <h1>{{ $j1bonus }}</h1>
                  <span class="description-text">Bonus</span>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    @endif
    @if($partida->jogador2)
      <div class="col-md-6">
        <div class="box box-widget widget-user">
          <div class="widget-user-header bg-green-active">
            <h3 class="widget-user-username">Jogador 2: {{ $partida->jogador2->nome ?? '-' }}</h3>
            <h5 class="widget-user-desc">{{ $partida->jogador2->categoria->nome ?? '-' }}</h5>
          </div>
          <div class="widget-user-image">
            <img class="img-circle" src="{{ route('image', ['link'=>$partida->jogador2->avatar]) }}" alt="">
          </div>
          <div class="box-footer">
            <div class="row">

              <div class="col-sm-6 border-right">
                <div class="description-block">
                  <h1>{{ $j2pontos }}</h1>
                  <span class="description-text">Pontos</span>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="description-block">
                  <h1>{{ $j2bonus }}</h1>
                  <span class="description-text">Bonus</span>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    @endif

    <div class="col-md-12">
      <div class="box box-solid">
        <div class="box-body text-center">
            <button class="btn btn-twitter btn-lg" type="submit">Salvar</button>
        </div>
      </div>
    </div>

  </form>

</div>

@stop

@section('css')
@stop

@section('js')
@stop

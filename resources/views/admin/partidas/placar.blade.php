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

          <a href="{{ route('editar_partida_placar', $partida->id) }}" class="btn btn-primary">Editar</a>

        </div>
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
        <img class="img-circle" src="{{ route('image', ['link'=>$partida->jogador1->avatar]) }}" alt="User Avatar">
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
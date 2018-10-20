@extends('layouts.layout')

@section('css')
    <style>

      .event-txt-wrap .event-txt {
        width: 100%;
      }

      .team-box {
          background-color: #f4f4f4;
      }

    </style>
@stop

@section('content')

<!--Inner Banner Start-->
<div class="inner-banner">
    <h1>{{ $jogador->nome }}</h1>
</div>
<div class="fl-breadcrumps">
    <div class="container">
        <ul class="pull-left">
            <li> <a href="{{ route('home') }}">Início</a> </li>
            <li> <a>{{ $jogador->nome }}</a> </li>
        </ul>
        <a class="pull-right" href="{{ route('home') }}">Voltar ao início <i class="fa fa-caret-right"></i></a>
    </div>
</div>

<div class="page-wrapper">

  <div class="team-page">
      <div class="container">
          <div class="row">
              <div class="team-small-details">
                  <div class="col-md-3 col-sm-5"> <img width="222" src="{{ route('image', ['link'=>$jogador->avatar]) }}" alt=""> </div>
                  <div class="col-md-9 col-sm-7">
                      <h2>{{ $jogador->nome }}</h2>
                      <ul>
                          <li class="role">Categoria {{ $jogador->categoria->nome }}</li>
                          <li class="role">{{ $jogador->partidas->count() + $jogador->partidas2->count() }} jogos</li>
                          <li class="role">{{ $jogador->partidas->sum('jogador1_pontos') - $jogador->resultados->sum('jogador1_bonus')
                            + $jogador->partidas->sum('jogador2_pontos') - $jogador->resultados->sum('jogador2_bonus')
                           }} pontos</li>
                          <li><strong>Lateralidade:</strong> {{ $jogador->lateralidade }}</li>
                          <li><strong>Nascimento:</strong> {{ $jogador->nascimento ? $jogador->nascimento->format('d/m/Y') : '' }} </li>
                      </ul>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                  <div class="small-txt">
                      <h2>Partidas</h2>

                      @php

                        $partidas = \App\Models\Partida::where('jogador1_id', $jogador->id)->orWhere('jogador2_id', $jogador->id)->orderByDesc('inicio')->get();

                      @endphp

                      <div class="events-posts">
                        @foreach($partidas as $partida)

                          <div class="event-post">
                              <div class="event-date">
                                  <h5><span>{{ $partida->inicio->format('M') }}</span> {{ $partida->inicio->format('d, Y') }}</h5>
                                  <strong>{{ $partida->horario }}</strong> </div>
                              <div class="event-content">
                                  <div class="event-txt-wrap">
                                      <div class="event-txt">
                                          <h4><a>{{ $partida->jogador1->nome ?? '' }} vs
                                                  {{ $partida->jogador2->nome ?? '' }}</a></h4>
                                          <p class="loc"><i class="fa fa-map-marker"></i> {{ $partida->quadra->nome }}</p>
                                          <div class="event-box-footer">
                                            <div class="widget">
                                              <div class="social-counter">
                                                  <ul>
                                                      <li>
                                                          <a class="item twitter">
                                                            <span class="count">{{$partida->jogador1_set1}} x {{$partida->jogador2_set1}}</span>
                                                            <em>1º SET</em> </a>
                                                      </li>
                                                      <li>
                                                          <a class="item ">
                                                            <span class="count">{{$partida->jogador1_set2}} x {{$partida->jogador2_set2}}</span>
                                                            <em>2º SET</em> </a>
                                                      </li>
                                                      <li>
                                                          <a class="item twitter">
                                                            <span class="count">{{$partida->jogador1_set3}} x {{$partida->jogador2_set3}}</span>
                                                            <em>3º SET</em> </a>
                                                      </li>
                                                      <li>
                                                          <a class="item ">
                                                            <span class="count">{{$partida->jogador1_resultado_final}} x {{$partida->jogador2_resultado_final}}</span>
                                                            <em>SETS</em> </a>
                                                      </li>
                                                      <li>
                                                          <a class="item twitter">
                                                            <span class="count">{{$partida->jogador1_pontos}} x {{$partida->jogador2_pontos}}</span><em>Pontos</em> </a>
                                                      </li>
                                                      <li>
                                                          <a class="item">
                                                            <span class="count">{{$partida->jogador1_bonus}} x {{$partida->jogador2_bonus}}</span><em>Bonus</em> </a>
                                                      </li>
                                                      <li></li>
                                                  </ul>
                                              </div>
                                          </div>

                                          </div>

                                      </div>
                                  </div>


                              </div>
                          </div>
                        @endforeach
                      </div>

                      <div class="techlinqs-pagination text-center">

                      </div>

                  </div>
              </div>
          </div>

      </div>
  </div>

</div>

@endsection

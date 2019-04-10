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
                      <h2>{{ $jogador->nomes }}</h2>
                      <ul>

                          @php

                            $vitorias = $jogador->partidas->filter(function($partida) use ($jogador) {

                                if($partida->jogador1_id == $jogador->id) {
                                  return $partida->jogador1_resultado_final >= 2;
                                } elseif ($partida->jogador2_id == $jogador->id) {
                                  return $partida->jogador2_resultado_final >= 2;
                                }

                            })->count();

                            $vitorias2 = $jogador->partidas2->filter(function($partida) use ($jogador) {

                                if($partida->jogador1_id == $jogador->id) {
                                  return $partida->jogador1_resultado_final >= 2;
                                } elseif ($partida->jogador2_id == $jogador->id) {
                                  return $partida->jogador2_resultado_final >= 2;
                                }

                            })->count();

                            $vitorias = $vitorias+$vitorias2;

                            $totalPartidas = $jogador->partidas->count() + $jogador->partidas2->count();
                            $bonus = $jogador->partidas->sum('jogador1_bonus') + $jogador->partidas2->sum('jogador2_bonus');

                          @endphp

                          <li class="role">Categoria {{ $jogador->categoria->nome }}</li>
                          <li class="role">{{ $totalPartidas }} jogos</li>
                          <li class="role">{{ $pontos }} pontos</li>
                          <li class="role">{{ $bonus }} bonus</li>
                          <li class="role">{{ $vitorias }} vitória(s)</li>
                          <li class="role">{{ $totalPartidas - $vitorias }} derrota(s)</li>
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

                        $partidas = \App\Models\Partida::where('jogador1_id', $jogador->id)
                        ->orWhere('jogador2_id', $jogador->id)->orderByDesc('inicio')->get();

                      @endphp

                      <table class="table table-hover table-bordered">
                          <thead>
                              <tr>
                                <th>Partida</th>
                                <th>Quadra</th>
                                <th>Horário</th>
                                <th>Jogador</th>
                                <th>Resultado</th>
                                <th>1º SET</th>
                                <th>2º SET</th>
                                <th>3º SET</th>
                                <th>SETS</th>
                                <th>Pontos</th>
                                <th>Bonus</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach($partidas as $partida)
                              <tr>
                                <td style="text-align: center; vertical-align: middle;" rowspan="2">{{$partida->id}}</td>
                                <td style="text-align: center; vertical-align: middle;" rowspan="2">{{$partida->quadra->nome}}</td>
                                <td style="text-align: center; vertical-align: middle;" rowspan="2"><b>{{$partida->inicio->format('d/m/Y')}}</b></td>
                                <th><a {{ $jogador->id == $partida->jogador1_id ? "style=color:green" : "" }} href="{{ route('jogador', $partida->jogador1->uuid) }}">{{$partida->jogador1->nome}}</a></th>
                                <td><b>{{$partida->jogador1_resultado_final}}</b></td>
                                <td>{{$partida->jogador1_set1}}</td>
                                <td>{{$partida->jogador1_set2}}</td>
                                <td>{{$partida->jogador1_set3}}</td>
                                <td>{{$partida->jogador1_resultado_final}}</td>
                                <td>{{$partida->jogador1_pontos}}</td>
                                <td>{{$partida->jogador1_bonus}}</td>
                              </tr>
                              <tr>
                                <th><a {{ $jogador->id == $partida->jogador2_id ? "style=color:green" : "" }} href="{{ route('jogador', $partida->jogador2->uuid) }}">{{$partida->jogador2->nome}}</a></th>
                                <td><b>{{$partida->jogador2_resultado_final}}</b></td>
                                <td>{{$partida->jogador2_set1}}</td>
                                <td>{{$partida->jogador2_set2}}</td>
                                <td>{{$partida->jogador2_set3}}</td>
                                <td>{{$partida->jogador2_resultado_final}}</td>
                                <td>{{$partida->jogador2_pontos}}</td>
                                <td>{{$partida->jogador2_bonus}}</td>
                              </tr>
                            @endforeach
                          </tbody>
                      </table>

                      <div class="techlinqs-pagination text-center">

                      </div>

                  </div>
              </div>
          </div>

      </div>
  </div>

</div>

@endsection

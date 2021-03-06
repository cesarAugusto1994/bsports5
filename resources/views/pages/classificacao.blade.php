@extends('layouts.layout')

@section('css')
    <style>

      .event-txt-wrap .event-txt {
        width: 100%;
      }

      .team-box .player-name {
        padding: 35px 0 0 35px;
      }

      .inner-banner {
        background: url('images/banners/BANNER-3.png') no-repeat center center;
      }

      .team-box {
        background: url('images/img/Banner-top-2.png') no-repeat left top #f4f4f4
      }

      .team-box div.player-number {
        font-family: 'Fira Sans Condensed', serif;
        font-size: 38px;
        color: #e9e9e9;
        position: absolute;
        left: 37px;
        bottom: 5px;
        line-height: 90px;
      }

      .team-box div.player-info {
        font-family: 'Fira Sans Condensed', serif;
        font-size: 18px;
        position: absolute;
        color: #e9e9e9;
        right: 5px;
        bottom: 5px;
      }

    </style>
@stop

@section('content')

<!--Inner Banner Start-->
<div class="inner-banner">
</div>
<div class="fl-breadcrumps">
    <div class="container">
        <ul class="pull-left">
            <li> <a href="{{ route('home') }}">Início</a> </li>
            <li> <a>Calendário Partidas</a> </li>
        </ul>
        <a class="pull-right" href="{{ route('home') }}">Voltar ao início <i class="fa fa-caret-right"></i></a>
    </div>
</div>

<div class="page-wrapper">

    <!--Ticket Listing Page Start-->
    <div class="ticket-listing">
        <div class="container">
            <div class="row">
              <div class="col-md-3">
                  <div class="sidebar-search-widget">

                      <div class="side-title">
                          <h3>Pesquisa</h3>
                          <p>Informe a Categoria</p>
                      </div>
                      <form method="get" action="?">
                      <ul class="search-form">
                          <li>
                              <div class="input-group">
                                <select name="category">
                                    <option value="">Selecione</option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                                    @endforeach
                                </select>
                                <i class="fa fa-angle-down"></i> </div>
                          </li>

                          <li>
                              <div class="input-group">
                                <input class="form-control" name="jogador" type="text" placeholder="Jogador"/>
                                <i class="fa fa-angle-down"></i>
                              </div>
                          </li>

                          <li>
                              <input type="submit" class="submit" value="Pesquisar">
                          </li>
                      </ul>
                      <form>
                  </div>
              </div>
                <div class="col-md-9">

                  <div class="team-page">
                      <div class="row">
                        @foreach($ranking as $k => $posicao)
                          <a style="color:#D5E904" href="{{route('jogador', $posicao['uuid'])}}">
                          <div class="col-md-4">
                              <div class="team-box">
                                <div class="player-number">{{ !request()->filled('jogador') ? '#' . $loop->iteration : '' }}</div>
                                <img width="128" height="128" src="{{ route('image', ['link'=>$posicao['avatar']]) }}" alt="" />
                                <div class="player-info">
                                  <p style="float:right">{{ $posicao['categoria_nome'] }}</p>
                                  <p>
                                    <a style="color:#D5E904" href="{{route('jogador', $posicao['uuid'])}}">{{ substr($posicao['nome'], 0, 15) }}</a>
                                  </p>
                                  <p style="float:right"> {{ $posicao['pontos'] }} ({{ $posicao['bonus'] }}) Bonus</p>
                                </div>
                              </div>
                          </div></a>
                        @endforeach
                      </div>
                      <div class="row">
                          <div class="techlinqs-pagination text-center">{{ $ranking->appends($_GET)->links() }}</div>
                      </div>
                  </div>

                </div>

            </div>
        </div>
    </div>
    <!--Ticket Listing Page End-->

</div>

@endsection

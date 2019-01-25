@extends('layouts.layout')

@section('css')
    <style>

      .event-txt-wrap .event-txt {
        width: 100%;
      }

      .inner-banner {
        background: url('images/banners/BANNER-2.png') no-repeat center center;
      }

      .grid-players {
        min-height: 90px;
        background: url('images/img/box-participante.png') no-repeat left top #f4f4f4
      }

      .jogador1 {
        margin-left: 15px;
        font-size: 24px;
        left: 5px;
        color: white;
        float: left;
        word-wrap: break-word;
        width: 5em;
      }

      .jogador2 {
        margin-right: 15px;
        font-size: 24px;
        right: 5px;
        color: white;
        float: right;
        word-wrap: break-word;
        width: 5em;
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
            <li> <a>Resultado Partidas</a> </li>
        </ul>
        <a class="pull-right" href="{{ route('home') }}">Voltar ao início <i class="fa fa-caret-right"></i></a>
    </div>
</div>

<div class="page-wrapper">

    <div class="blog-list">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="events-posts">
                      @foreach($partidas as $partida)

                        <div class="event-post">
                            <div class="event-date">
                                <h5><span>{{ $partida->inicio->format('M') }}</span> {{ $partida->inicio->format('d, Y') }}</h5>
                                <strong>{{ $partida->inicio->format('H:i') }} - {{ $partida->fim->format('H:i') }}</strong> </div>
                            <div class="event-content">
                                <div class="event-txt-wrap">
                                    <div class="event-txt">
                                      <div class="grid-players">
                                        <div class="row">
                                          <div class="col-md-6">
                                            @if($partida->jogador1)
                                                <a class="jogador1" href="{{route('jogador', $partida->jogador1->uuid)}}"><p>{{ substr($partida->jogador1->nome, 0, 15) }}</p></a>
                                            @endif
                                          </div>
                                          <div class="col-md-6">
                                            @if($partida->jogador2)
                                                <a class="jogador2" href="{{route('jogador', $partida->jogador2->uuid)}}">{{ substr($partida->jogador2->nome, 0, 15) }}</a>
                                            @endif
                                          </div>
                                        </div>
                                      </div>
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
                        {{ $partidas->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
    <script>
        $('.date').mask("00/00/0000", {placeholder: "__/__/____"});
    </script>
@stop

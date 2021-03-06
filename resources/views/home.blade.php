@extends('layouts.layout')

@section('categorias')
@include('layouts.includes.categorias')
@endsection

@section('content')

<!--Featured News Area Start-->
<section class="news-section-wrapper" style="padding-bottom: 0px;">
    <div class="featured-news-block">
        <div class="container">
            <div class="row">
                <div class="col-md-12 d-flex">
                        <div class="mb-2" style="width: 83%; border-bottom: 2px solid #ccc; position:absolute; top:26px; left:15%;"></div>
                        <h4 style="width: 30%; color:#1D90ED;">
                            {{ $categoriaAtual->nome }}
                        </h4>

                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">

                <div class="col-md-9 p3r">
                    <div id="featured-slider" class="owl-carousel owl-theme" style="min-height:500px;max-height:500px;">
                        @foreach($ranking as $key => $item)

                        <div class="item" style="border-radius:15px; box-shadow: 8px 13px 14px -7px rgba(235,232,235,1);">

                            <div class="module-header">
                                <h2 id="singlesRankingTitle" class="module-title landscape-logo">

                                </h2>
                                <h2 id="doublesRankingTitle" class="module-title landscape-logo hide">

                                </h2>
                                <div class="module-tabs">

                                </div>
                            </div>

                            <div class="player-ranking-panel" style="border-radius:15px">
                                <div class="player-ranking-top">
                                    <div class="item-overflow">
                                        <div class="item-container">
                                            <div class="previous-item">
                                                <div class="player-ranking-details">
                                                    <div class="player-ranking-name">
                                                        <a href="{{ route('jogador', $item['uuid']) }}"><span class="first-name">{{
                                                                $item['primeiro_nome'] }}</span> <span class="last-name">{{
                                                                $item['ultimo_nome'] }}</span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="player-ranking-links">
                                        <a href="{{route('classificacao')}}">Rankings</a>
                                        <a href="{{ route('jogador', $item['uuid']) }}">Informações</a>
                                    </div>
                                </div>
                                <div class="player-ranking-bottom">
                                    <div class="player-ranking-data">
                                        <div class="item-overflow">
                                            <div class="item-container">
                                                <div class="previous-item">
                                                    <div class="player-ranking-position">
                                                        <div class="data-label">
                                                            <div class="data-label-text">Rank</div>
                                                        </div>
                                                        <div class="data-number">{{ $loop->iteration }}</div>
                                                    </div>
                                                    <div class="player-ranking-move">
                                                        <div class="data-label">
                                                            <div class="data-label-text">Posição</div>
                                                        </div>
                                                        <div class="data-number">
                                                            <span class="move-none"></span>
                                                            <span class="number-text"></span>
                                                        </div>
                                                    </div>
                                                    <div class="player-ranking-points">
                                                        <div class="data-label">
                                                            <div class="data-label-text">Pontos</div>
                                                        </div>
                                                        <div class="data-number">{{ $item['pontos'] }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="player-ranking-bottom-links">
                                        <!--<a>View All</a>
                                    <a>Learn More</a>
                                    <a>Rankings Home</a>-->
                                    </div>
                                </div>

                                @php

                                $url =
                                'https://www.atpworldtour.com/-/media/tennis/players/gladiator/2018/nadal_full_ao18.png';

                                if(!empty($item['avatar'])) {
                                $url = route('image', ['link'=>$item['avatar']]);
                                }

                                @endphp

                                <div class="player-ranking-image">
                                    <div class="item-overflow">
                                        <div class="item-container">
                                            <div class="previous-item">
                                                <div class="image-wrap" style="background: url({{$url}}) no-repeat center center;background-size: 60% 60%;margin-left:18%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        @endforeach

                    </div>
                </div>

                <div class="col-md-3 col-sm-6 p3l">
                    <a href="{{ route('formulario_agendar') }}">
                        <div class="fnews-thumb">
                            <div class="fnews-txt"> <span class="gtag c5"></span>
                            </div>
                            <!--
                            <img src="{{ \App\Helpers\Helper::getConfig('empresa-banner-principal-imagem') }}" alt="" />
                            -->
                            <img src="{{ asset('images/banner-bsports.jpeg') }}" alt="" />
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Featured News Area End-->

<!--Tab post Grid Start-->
<div class="news-section-wrapper" style="padding-top: 0px;">
    <div class="tab-news">
        <div class="container">

            @php

            $categorias = \App\Helpers\Helper::categorias();

            $categorias = $categorias->filter(function($categoria) {
            return $categoria->habilitar_menu == true;
            });

            @endphp

            <div class="row proximas-partidas">
                <div class="col-md-12">
                    <h2 class="section-title"> PRÓXIMAS PARTIDAS </h2>
                </div>
                <div class="col-md-12">
                    <ul class="nav" role="tablist">
                        @foreach($categorias as $key => $categoria)
                        <li style="float:left;" role="presentation" class="{{ $loop->index == 0 ? 'active' : '' }}">
                            <a class="tab-proximas-partidas" href="#news-tab-{{ $loop->index }}" aria-controls="news-tab-{{ $loop->index }}"
                                role="tab" data-toggle="tab">{{ $categoria->nome }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="tab-content gallery">
                    @foreach($categorias as $key => $categoria)
                    <div role="tabpanel" class="tab-pane {{ $loop->index == 0 ? 'active' : '' }}" id="news-tab-{{ $loop->index }}">

                        <div class="col-md-12">

                                <div id="ls-slider" class="owl-carousel owl-theme">

                                    @php

                                    $sql = '
                                    select p.id
                                    from partidas p
                                    left join jogadores j1 on (j1.id = p.jogador1_id)
                                    left join jogadores j2 on (j1.id = p.jogador2_id)
                                    where p.inicio > now()
                                    and (j1.categoria_id = '.$categoria->id.'
                                    or j2.categoria_id = '.$categoria->id.')
                                    ;
                                    ';

                                    $resultado = \DB::select($sql);

                                    $partidas = collect();

                                    foreach($resultado as $result) {
                                        $partida = \App\Models\Partida::findOrFail($result->id);
                                        $partidas->push($partida);
                                    }
                                    $partidas = [1,2,3,4,5,6];
                                    @endphp

                                    @foreach($partidas as $partida)

                                    <div class="item">
                                        {{-- <div class="match-box">
                                            <ul class="match-fixture-inner">

                                                @php

                                                $j1_avatar = $j2_avatar = 'avatar.png';
                                                $j1_nome = $j2_nome = 'A definir';
                                                $j1_link = $j2_link = '#';

                                                if($partida->jogador1) {
                                                $j1_nome = $partida->jogador1->nome;
                                                $j1_link = route('jogador', $partida->jogador1->uuid);
                                                }

                                                if($partida->jogador2) {
                                                $j2_nome = $partida->jogador2->nome;
                                                $j2_link = route('jogador', $partida->jogador2->uuid);
                                                }

                                                @endphp

                                                <li class="team"> <img src="{{ route('image', ['link'=>$j1_avatar]) }}"
                                                        alt="" />
                                                    <strong><a href="{{ $j1_link }}">
                                                            {{ substr($j1_nome, 0, 12) }}</a></strong>
                                                </li>
                                                <li class="time-batch"><strong class="m-date">{{
                                                        $partida->inicio->format('d.m.Y') }}</strong>
                                                    <strong class="m-time">{{ $partida->inicio->format('H:i') }}</strong>
                                                    <strong class="m-vs">VS</strong></li>
                                                <li class="team"><img src="{{ route('image', ['link'=>$j2_avatar]) }}"
                                                        alt="" />
                                                    <strong>
                                                        <a href="{{ $j2_link }}">
                                                            {{ substr($j2_nome, 0, 12) }}</a>
                                                    </strong>
                                                </li>
                                            </ul>
                                            <div class="mb-footer"> {{ $partida->quadra->nome }}</div>
                                        </div> --}}

                                            <div class="card">
                                                <div class="card-header" style="background-color: #51CFFF;">
                                                    <div class="data pull-left">
                                                        20/12/19
                                                    </div>
                                                    <div class="horas pull-right">
                                                        15:00 Horas
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="player-one pull-left">
                                                        Renata Lima
                                                    </div>
                                                    <div class="divisao"></div>
                                                    <div class="player-two pull-left">
                                                        Paula Ferreira
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                        </div>




                                    @endforeach

                                </div>

                        </div>

                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!--Tab post Grid End-->

@include('partials.news')

@endsection

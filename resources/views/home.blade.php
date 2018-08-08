@extends('layouts.layout')

@section('categorias')
  @include('layouts.includes.categorias')
@endsection

@section('content')

    <!--Featured News Area Start-->
    <section class="news-section-wrapper">
        <div class="featured-news-block">
            <div class="container">
                <div class="row">

                    <!--
                    <div class="banner-ad m30"> <img src="{{ \App\Helpers\Helper::getConfig('empresa-banner-topo-vertical') ?? 'holder.js/944x67' }}" alt=""> </div>
                  -->
                    <div class="col-md-9 p3r">
                        <div id="featured-slider" class="owl-carousel owl-theme" style="min-height:500px;max-height:500px;">
                          @foreach($ranking as $key => $item)
                            <div class="item">

                                <div class="module-header">
                                    <h2 id="singlesRankingTitle" class="module-title landscape-logo">

                                    </h2>
                                    <h2 id="doublesRankingTitle" class="module-title landscape-logo hide">

                                    </h2>
                                    <div class="module-tabs">

                                    </div>
                                </div>

                                <div class="player-ranking-panel">
                                  <div class="player-ranking-top">
                                  <div class="item-overflow">
                                    <div class="item-container">
                                      <div class="previous-item">
                                        <div class="player-ranking-details">
                                          <div class="player-ranking-name">
                                            <a href="{{route('players.show', $item['uuid'])}}" ><span class="first-name">{{ $item['primeiro_nome'] }}</span> <span class="last-name">{{ $item['ultimo_nome'] }}</span></a>
                                          </div>
                                        </div>
                                      </div>
                                    </div> <!---->
                                  </div>
                                  <div class="player-ranking-links">
                                    <a href="{{route('classificacao')}}">Rankings</a>
                                    <a href="{{route('players.show', $item['uuid'])}}">Informações</a>
                                    <!--<a>Video</a>-->
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
                                              </div> <div class="data-number">{{ $key+1 }}</div>
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
                                  <div class="player-ranking-image">
                                    <div class="item-overflow">
                                      <div class="item-container">
                                        <div class="previous-item">
                                          <div class="image-wrap">
                                            <img src="https://www.atpworldtour.com/-/media/tennis/players/gladiator/2018/nadal_full_ao18.png" class="">
                                          </div>
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
                        <div class="fnews-thumb">
                            <div class="fnews-txt"> <span class="gtag c5"></span>
                                <h3> <a href="{{ \App\Helpers\Helper::getConfig('empresa-banner-principal-link') }}">{{ \App\Helpers\Helper::getConfig('empresa-banner-principal-texto') }}</a> </h3>
                            </div>
                            <!--
                            <img src="{{ \App\Helpers\Helper::getConfig('empresa-banner-principal-imagem') }}" alt="" />
                            -->
                            <img src="{{ asset('images/banner-bsports.jpeg') }}" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Featured News Area End-->

    <!--Tab post Grid Start-->
    <div class="news-section-wrapper">
        <div class="tab-news">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h2 class="section-title"> Próximas Partidas </h2>
                    </div>
                    <div class="col-md-8">
                        <ul class="nav" role="tablist">
                          @foreach(\App\Models\MenuCategorias::all() as $key => $item)
                            <li role="presentation" class="{{ $loop->index == 0 ? 'active' : '' }}"><a href="#news-tab-{{ $item->categoria->id }}" aria-controls="news-tab1" role="tab" data-toggle="tab">{{ $item->categoria->nome }}</a></li>
                          @endforeach
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="tab-content gallery">
                      @foreach(\App\Models\MenuCategorias::all() as $key => $item)
                        <div role="tabpanel" class="tab-pane {{ $loop->index == 0 ? 'active' : '' }}" id="news-tab-{{ $item->categoria->id }}">

                          <div class="col-md-12">
                              <div id="ls-slider" class="owl-carousel owl-theme">


                                  <!--LS Box Start-->
                                  <div class="item">
                                      <div class="schedule-box">
                                          <div class="sdate"> <strong>24</strong> Mar </div>
                                          <div class="steams">
                                              <div class="matches"> <strong class="count">1-7</strong> <strong class="win">Win</strong> </div>
                                              <div class="teams-vs"> <strong class="t1"><img src="./images/tlogos/tl1.png" alt="" /> Blu</strong> <strong class="vs">vs</strong> <strong class="t2">Eag <img src="./images/tlogos/tl2.png" alt="" /></strong> </div>
                                          </div>
                                      </div>
                                  </div>

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

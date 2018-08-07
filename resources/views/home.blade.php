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
                                            <a ><span class="first-name">{{ $item['primeiro_nome'] }}</span> <span class="last-name">{{ $item['ultimo_nome'] }}</span></a>
                                          </div>
                                        </div>
                                      </div>
                                    </div> <!---->
                                  </div>
                                  <div class="player-ranking-links">
                                    <a href="{{route('classificacao')}}">Rankings</a>
                                    <a href="{{route('jogador', ['slug'=> str_slug($item['primeiro_nome']), 'id' => $item['id']])}}">Informações</a>
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

                            <!--New Box Start-->
                            <div class="col-md-3 col-sm-6">
                                <div class="news-block">
                                    <div class="news-thumb"> <a href="http://vimeo.com/7874398&width=700" data-rel="prettyPhoto" title="Vimeo video"><i class="fa fa-play"></i></a> <span class="vtime"><i class="fa fa-clock-o"></i> 1:05</span> <img src="./images/vtimg1.jpg" alt="" /> </div>
                                    <div class="news-txt">
                                        <ul class="meta-info">
                                            <li>By <a href="#">Dylan Carter</a></li>
                                            <li>Mar. 15, 2017</li>
                                        </ul>
                                        <h6> <a href="#">Minnesota United may have come out as the winners</a> </h6>
                                    </div>
                                </div>
                            </div>
                            <!--New Box End-->

                            <!--New Box Start-->
                            <div class="col-md-3 col-sm-6">
                                <div class="news-block ">
                                    <div class="news-thumb"> <a href="https://www.youtube.com/watch?v=DfZIv2FKWj4" data-rel="prettyPhoto"><i class="fa fa-play"></i></a> <span class="vtime"><i class="fa fa-clock-o"></i> 1:05</span> <img src="./images/vtimg2.jpg" alt="" /> </div>
                                    <div class="news-txt">
                                        <ul class="meta-info">
                                            <li>By <a href="#">Dylan Carter</a></li>
                                            <li>Mar. 15, 2017</li>
                                        </ul>
                                        <h6> <a href="#">Jeff Hardy denies he and Broken Matt are on their</a> </h6>
                                    </div>
                                </div>
                            </div>
                            <!--New Box End-->

                            <!--New Box Start-->
                            <div class="col-md-3 col-sm-6">
                                <div class="news-block ">
                                    <div class="news-thumb"> <a href="https://www.youtube.com/watch?v=DfZIv2FKWj4" data-rel="prettyPhoto[gallery1]"><i class="fa fa-play"></i></a> <span class="vtime"><i class="fa fa-clock-o"></i> 1:05</span> <img src="./images/vtimg3.jpg" alt="" /> </div>
                                    <div class="news-txt">
                                        <ul class="meta-info">
                                            <li>By <a href="#">Dylan Carter</a></li>
                                            <li>Mar. 15, 2017</li>
                                        </ul>
                                        <h6> <a href="#">Joe Gibbs Racing dry spell could come to an end at Martinsville</a> </h6>
                                    </div>
                                </div>
                            </div>
                            <!--New Box End-->

                            <!--New Box Start-->
                            <div class="col-md-3 col-sm-6">
                                <div class="news-block ">
                                    <div class="news-thumb"> <a href="https://www.youtube.com/watch?v=DfZIv2FKWj4" data-rel="prettyPhoto[gallery1]"><i class="fa fa-play"></i></a> <span class="vtime"><i class="fa fa-clock-o"></i> 1:05</span> <img src="./images/vtimg4.jpg" alt="" /> </div>
                                    <div class="news-txt">
                                        <ul class="meta-info">
                                            <li>By <a href="#">Dylan Carter</a></li>
                                            <li>Mar. 15, 2017</li>
                                        </ul>
                                        <h6> <a href="#">Oscar Robertson is rooting for Russell Westbrook</a> </h6>
                                    </div>
                                </div>
                            </div>
                            <!--New Box End-->

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

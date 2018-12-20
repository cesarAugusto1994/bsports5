<!--League Schedule Slider Start-->
<div class="news-section-wrapper gallery">
    <div class="container">
        <div class="row">
          <div class="col-md-12">
              <h2 class="section-title">Eventos</h2>
          </div>
          <div class="col-md-12">
              <div class="newsblock-grid1">

                  <div class="row">
                    @foreach(\App\Models\Evento::all() as $evento)
                      <div class="col-md-4 col-sm-4">
                          <div class="news-block ">
                              <div class="news-thumb"> <img src="{{ route('image', ['link'=>$evento->banner]) }}" alt="" /> </div>
                              <div class="news-txt">
                                  <h4> <a href="{{ route('evento', ['id'=>$evento->id,'titulo'=>str_slug($evento->titulo)]) }}">{{ substr($evento->titulo, 0, 250) }}</a> </h4>
                                  <p> {{ substr($evento->conteudo, 0, 150) }} ... </p>
                                  <a class="rm" href="{{ route('evento', ['id'=>$evento->id,'titulo'=>str_slug($evento->titulo)]) }}"> Saber mais </a> </div>
                          </div>
                      </div>
                    @endforeach

                  </div>
              </div>
          </div>
        </div>
        <br/>
        <br/>
        <div class="row">
            <div class="col-md-8">
                <div class="banner-ad m30"> <a href="{{ route('formulario_clube') }}"><img src="./images/banner-ad.jpg" alt="" /></a> </div>
                <div class="newsblock-grid1">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="section-title">Noticias</h2>
                        </div>
                        @foreach(\App\Models\Noticia::all() as $noticia)
                        <div class="col-md-6 col-sm-6">
                            <div class="news-block ">
                                <div class="news-thumb"> <img src="{{ route('image', ['link'=>$noticia->banner]) }}" alt="" /> </div>
                                <div class="news-txt">
                                    <h4> <a href="{{ route('noticia', ['id'=>$noticia->id,'titulo'=>str_slug($noticia->titulo)]) }}">{{ $noticia->titulo }}</a> </h4>
                                    <p> {{ substr($noticia->conteudo, 0, 150) }} </p>
                                    <a class="rm" href="{{ route('noticia', ['id'=>$noticia->id,'titulo'=>str_slug($noticia->titulo)]) }}"> Saiba Mais </a> </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="side-news-widget">
                    <h4 class="section-title">Galeria de Campeões</h4>
                    <ul class="small-grid">

                      @php

                        $campeoes = \App\Helpers\Helper::campeoes();

                      @endphp

                      @foreach($campeoes as $campeao)
                        <!--Row Start-->
                        <li class="news">
                            <div class="small-thumb"> <img width="64" src="{{ route('image', ['link'=>$campeao->imagem]) }}" alt="" /> </div>
                            <div class="news-txt">
                                <h6> <a href="#">{{ $campeao->titulo }}</a> </h6>
                            </div>
                        </li>
                        <!--Row End-->
                      @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--League Schedule Slider Start-->

<!--Tab post Grid Start-->
<div class="news-section-wrapper">
    <div class="tab-news">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h2 class="section-title"> Videos </h2>
                </div>
                <div class="col-md-8">
                    <ul class="nav" role="tablist">
                        <li role="presentation" class="active"><a href="#news-tab1" aria-controls="news-tab1" role="tab" data-toggle="tab"></a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="tab-content gallery">
                    <div role="tabpanel" class="tab-pane active " id="news-tab1">

                      @php

                        $videos = \App\Helpers\Helper::videos();

                      @endphp

                        @foreach($videos as $video)
                        <div class="col-md-3 col-sm-6">
                            <div class="news-block">
                                <div class="news-thumb"> <a href="{{ $video->links->first()->link }}" data-rel="prettyPhoto" title="Vimeo video"><i class="fa fa-play"></i></a>
                                  <span class="vtime"><i class="fa fa-clock-o"></i></span>
                                  <img src="./images/vtimg1.jpg" alt="" /> </div>
                                <div class="news-txt">
                                    <ul class="meta-info">
                                        <li> <a href="#">{{ $video->titulo }}</a></li>
                                        <li>{{ $video->created_at->diffForHumans() }}</li>
                                    </ul>
                                    <h6> <a href="#">{{ $video->descricao }}</a> </h6>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Tab post Grid End-->

<!--News Gallery Start-->
<div class="news-section-wrapper news-gallery no-margin">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="section-title">Galeria de Imagens</h2>
            </div>
        </div>
        <div class="row">

          @php

            $imagens = \App\Helpers\Helper::imagens();

            $route = '';

          @endphp

            @foreach($imagens as $imagem)

            @php

            if($imagem->links->isNotEmpty()) {
                $route = route('image', ['link'=>$imagem->links->first()->link]);
            }

            @endphp

            <div class="col-md-3 col-sm-6">
                <div class="news-block ">
                    <div class="news-thumb"> <a href="{{ route('galeria', $imagem->id) }}"><i class="fa fa-link"></i></a> <img src="{{ $route }}" alt="" /> </div>
                    <div class="news-txt">
                        <h5> <a href="{{ route('galeria', $imagem->id) }}">{{ $imagem->titulo }} </a> </h5>
                        <p>{{ $imagem->descricao }}</p>
                    </div>
                </div>
            </div>

            @endforeach

        </div>
    </div>
</div>
<!--News Gallery End-->

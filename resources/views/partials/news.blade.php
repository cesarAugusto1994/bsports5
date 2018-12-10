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
                    <h4 class="section-title">Latest News</h4>
                    <ul class="small-grid">
                        <!--Row Start-->
                        <li class="news">
                            <div class="small-thumb"> <img src="./images/lng1.jpg" alt="" /> </div>
                            <div class="news-txt">
                                <ul class="meta-info">
                                    <li>By <a href="#">Dylan Carter</a></li>
                                    <li>Mar. 15, 2017</li>
                                </ul>
                                <h6> <a href="#">NHRA Drag Racing - DENSO Spark Plugs Nationals</a> </h6>
                            </div>
                        </li>
                        <!--Row End-->

                        <!--Row Start-->
                        <li class="news">
                            <div class="small-thumb"> <img src="./images/lng2.jpg" alt="" /> </div>
                            <div class="news-txt">
                                <ul class="meta-info">
                                    <li>By <a href="#">Dylan Carter</a></li>
                                    <li>Mar. 15, 2017</li>
                                </ul>
                                <h6> <a href="#">Sed posuere justo non malesuada aliquam</a> </h6>
                            </div>
                        </li>
                        <!--Row End-->

                        <!--Row Start-->
                        <li class="news">
                            <div class="small-thumb"> <img src="./images/lng3.jpg" alt="" /> </div>
                            <div class="news-txt">
                                <ul class="meta-info">
                                    <li>By <a href="#">Dylan Carter</a></li>
                                    <li>Mar. 15, 2017</li>
                                </ul>
                                <h6> <a href="#">Duis sollicitudin nisl id nibh tempus interdum</a> </h6>
                            </div>
                        </li>
                        <!--Row End-->

                        <!--Row Start-->
                        <li class="news">
                            <div class="small-thumb"> <img src="./images/lng4.jpg" alt="" /> </div>
                            <div class="news-txt">
                                <ul class="meta-info">
                                    <li>By <a href="#">Dylan Carter</a></li>
                                    <li>Mar. 15, 2017</li>
                                </ul>
                                <h6> <a href="#">Sed facilisis urna a mi vulputate porttitor</a> </h6>
                            </div>
                        </li>
                        <!--Row End-->

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
                    <h2 class="section-title"> Featured Video </h2>
                </div>
                <div class="col-md-8">
                    <ul class="nav" role="tablist">
                        <li role="presentation" class="active"><a href="#news-tab1" aria-controls="news-tab1" role="tab" data-toggle="tab">Badminton</a></li>
                        <li role="presentation"><a href="#news-tab2" aria-controls="news-tab2" role="tab" data-toggle="tab">Wrestling</a></li>
                        <li role="presentation"><a href="#news-tab3" aria-controls="news-tab3" role="tab" data-toggle="tab">Hockey</a></li>
                        <li role="presentation"><a href="#news-tab4" aria-controls="news-tab4" role="tab" data-toggle="tab">Tennis</a></li>
                        <li role="presentation"><a href="#news-tab5" aria-controls="news-tab5" role="tab" data-toggle="tab">Rugby Football</a></li>
                        <li role="presentation"><a href="#news-tab6" aria-controls="news-tab6" role="tab" data-toggle="tab">Basketball</a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="tab-content gallery">
                    <div role="tabpanel" class="tab-pane active " id="news-tab1">

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
                    <div role="tabpanel" class="tab-pane" id="news-tab2">

                        <!--New Box Start-->
                        <div class="col-md-3 col-sm-6">
                            <div class="news-block ">
                                <div class="news-thumb"> <a href="https://www.youtube.com/watch?v=DfZIv2FKWj4" data-rel="prettyPhoto[gallery1]"><i class="fa fa-play"></i></a> <span class="vtime"><i class="fa fa-clock-o"></i> 1:05</span> <img src="./images/vtimg4.jpg" alt="" /> </div>
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
                                <div class="news-thumb"> <a href="https://www.youtube.com/watch?v=DfZIv2FKWj4" data-rel="prettyPhoto[gallery1]"><i class="fa fa-play"></i></a> <span class="vtime"><i class="fa fa-clock-o"></i> 1:05</span> <img src="./images/vtimg3.jpg" alt="" /> </div>
                                <div class="news-txt">
                                    <ul class="meta-info">
                                        <li>By <a href="#">Dylan Carter</a></li>
                                        <li>Mar. 15, 2017</li>
                                    </ul>
                                    <h6> <a href="#">Jeff Hardy denies he and Broken Matt are on their way to WWE any</a> </h6>
                                </div>
                            </div>
                        </div>
                        <!--New Box End-->

                        <!--New Box Start-->
                        <div class="col-md-3 col-sm-6">
                            <div class="news-block ">
                                <div class="news-thumb"> <a href="https://www.youtube.com/watch?v=DfZIv2FKWj4" data-rel="prettyPhoto[gallery1]"><i class="fa fa-play"></i></a> <span class="vtime"><i class="fa fa-clock-o"></i> 1:05</span> <img src="./images/vtimg2.jpg" alt="" /> </div>
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
                                <div class="news-thumb"> <a href="https://www.youtube.com/watch?v=DfZIv2FKWj4" data-rel="prettyPhoto[gallery1]"><i class="fa fa-play"></i></a> <span class="vtime"><i class="fa fa-clock-o"></i> 1:05</span> <img src="./images/vtimg1.jpg" alt="" /> </div>
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
                    <div role="tabpanel" class="tab-pane" id="news-tab3">

                        <!--New Box Start-->
                        <div class="col-md-3 col-sm-6">
                            <div class="news-block ">
                                <div class="news-thumb"> <a href="https://www.youtube.com/watch?v=DfZIv2FKWj4" data-rel="prettyPhoto[gallery1]"><i class="fa fa-play"></i></a> <span class="vtime"><i class="fa fa-clock-o"></i> 1:05</span> <img src="./images/vtimg1.jpg" alt="" /> </div>
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
                                <div class="news-thumb"> <a href="https://www.youtube.com/watch?v=DfZIv2FKWj4" data-rel="prettyPhoto[gallery1]"><i class="fa fa-play"></i></a> <span class="vtime"><i class="fa fa-clock-o"></i> 1:05</span> <img src="./images/vtimg2.jpg" alt="" /> </div>
                                <div class="news-txt">
                                    <ul class="meta-info">
                                        <li>By <a href="#">Dylan Carter</a></li>
                                        <li>Mar. 15, 2017</li>
                                    </ul>
                                    <h6> <a href="#">Jeff Hardy denies he and Broken Matt are on their way to WWE any</a> </h6>
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
                    <div role="tabpanel" class="tab-pane" id="news-tab4">

                        <!--New Box Start-->
                        <div class="col-md-3 col-sm-6">
                            <div class="news-block ">
                                <div class="news-thumb"> <a href="https://www.youtube.com/watch?v=DfZIv2FKWj4" data-rel="prettyPhoto[gallery1]"><i class="fa fa-play"></i></a> <span class="vtime"><i class="fa fa-clock-o"></i> 1:05</span> <img src="./images/vtimg4.jpg" alt="" /> </div>
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
                                <div class="news-thumb"> <a href="https://www.youtube.com/watch?v=DfZIv2FKWj4" data-rel="prettyPhoto[gallery1]"><i class="fa fa-play"></i></a> <span class="vtime"><i class="fa fa-clock-o"></i> 1:05</span> <img src="./images/vtimg3.jpg" alt="" /> </div>
                                <div class="news-txt">
                                    <ul class="meta-info">
                                        <li>By <a href="#">Dylan Carter</a></li>
                                        <li>Mar. 15, 2017</li>
                                    </ul>
                                    <h6> <a href="#">Jeff Hardy denies he and Broken Matt are on their way to WWE any</a> </h6>
                                </div>
                            </div>
                        </div>
                        <!--New Box End-->

                        <!--New Box Start-->
                        <div class="col-md-3 col-sm-6">
                            <div class="news-block ">
                                <div class="news-thumb"> <a href="https://www.youtube.com/watch?v=DfZIv2FKWj4" data-rel="prettyPhoto[gallery1]"><i class="fa fa-play"></i></a> <span class="vtime"><i class="fa fa-clock-o"></i> 1:05</span> <img src="./images/vtimg2.jpg" alt="" /> </div>
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
                                <div class="news-thumb"> <a href="https://www.youtube.com/watch?v=DfZIv2FKWj4" data-rel="prettyPhoto[gallery1]"><i class="fa fa-play"></i></a> <span class="vtime"><i class="fa fa-clock-o"></i> 1:05</span> <img src="./images/vtimg1.jpg" alt="" /> </div>
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
                    <div role="tabpanel" class="tab-pane" id="news-tab5">

                        <!--New Box Start-->
                        <div class="col-md-3 col-sm-6">
                            <div class="news-block ">
                                <div class="news-thumb"> <a href="https://www.youtube.com/watch?v=DfZIv2FKWj4" data-rel="prettyPhoto[gallery1]"><i class="fa fa-play"></i></a> <span class="vtime"><i class="fa fa-clock-o"></i> 1:05</span> <img src="./images/vtimg1.jpg" alt="" /> </div>
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
                                <div class="news-thumb"> <a href="https://www.youtube.com/watch?v=DfZIv2FKWj4" data-rel="prettyPhoto[gallery1]"><i class="fa fa-play"></i></a> <span class="vtime"><i class="fa fa-clock-o"></i> 1:05</span> <img src="./images/vtimg2.jpg" alt="" /> </div>
                                <div class="news-txt">
                                    <ul class="meta-info">
                                        <li>By <a href="#">Dylan Carter</a></li>
                                        <li>Mar. 15, 2017</li>
                                    </ul>
                                    <h6> <a href="#">Jeff Hardy denies he and Broken Matt are on their way to WWE any</a> </h6>
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
                    <div role="tabpanel" class="tab-pane" id="news-tab6">

                        <!--New Box Start-->
                        <div class="col-md-3 col-sm-6">
                            <div class="news-block ">
                                <div class="news-thumb"> <a href="https://www.youtube.com/watch?v=DfZIv2FKWj4" data-rel="prettyPhoto[gallery1]"><i class="fa fa-play"></i></a> <span class="vtime"><i class="fa fa-clock-o"></i> 1:05</span> <img src="./images/vtimg4.jpg" alt="" /> </div>
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
                                <div class="news-thumb"> <a href="https://www.youtube.com/watch?v=DfZIv2FKWj4" data-rel="prettyPhoto[gallery1]"><i class="fa fa-play"></i></a> <span class="vtime"><i class="fa fa-clock-o"></i> 1:05</span> <img src="./images/vtimg3.jpg" alt="" /> </div>
                                <div class="news-txt">
                                    <ul class="meta-info">
                                        <li>By <a href="#">Dylan Carter</a></li>
                                        <li>Mar. 15, 2017</li>
                                    </ul>
                                    <h6> <a href="#">Jeff Hardy denies he and Broken Matt are on their way to WWE any</a> </h6>
                                </div>
                            </div>
                        </div>
                        <!--New Box End-->

                        <!--New Box Start-->
                        <div class="col-md-3 col-sm-6">
                            <div class="news-block ">
                                <div class="news-thumb"> <a href="https://www.youtube.com/watch?v=DfZIv2FKWj4" data-rel="prettyPhoto[gallery1]"><i class="fa fa-play"></i></a> <span class="vtime"><i class="fa fa-clock-o"></i> 1:05</span> <img src="./images/vtimg2.jpg" alt="" /> </div>
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
                                <div class="news-thumb"> <a href="https://www.youtube.com/watch?v=DfZIv2FKWj4" data-rel="prettyPhoto[gallery1]"><i class="fa fa-play"></i></a> <span class="vtime"><i class="fa fa-clock-o"></i> 1:05</span> <img src="./images/vtimg1.jpg" alt="" /> </div>
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
                </div>
            </div>
        </div>
    </div>
</div>
<!--Tab post Grid End-->

<!--Tab post Grid Start-->
<div class="news-section-wrapper newslist-block">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2 class="section-title"> Popular News </h2>

                <!-- News List Start -->
                <div class="row">
                    <div class="news-block ">
                        <div class="col-md-5 col-sm-5">
                            <div class="news-thumb"> <a href="#"><i class="fa fa-link"></i></a> <img src="./images/nlist-img1.jpg" alt="" /> </div>
                        </div>
                        <div class="col-md-7 col-sm-7">
                            <div class="news-txt">
                                <ul class="meta-info">
                                    <li>By <a href="#" class="author">Dylan Carter</a></li>
                                    <li>Mar. 15, 2017</li>
                                </ul>
                                <h4> <a href="#" class="title-news"> Duis pulvinar dolor consectetur orci congue, id fermentum metus facilisis</a></h4>
                                <p>BMC Racing Team will be targeting stage wins at the demanding six-day Vuelta Ciclista al Pais Vasco, the next UCI WorldTour stage race of the season.to go. Sport teams, athletes., </p>
                                <a class="rm" href="#" class="btn-news"> Saber mais </a> </div>
                        </div>
                    </div>
                </div>
                <!-- News List End -->

                <!-- News List Start -->
                <div class="row">
                    <div class="news-block ">
                        <div class="col-md-5 col-sm-5">
                            <div class="news-thumb"> <a href="#"><i class="fa fa-link"></i></a> <img src="./images/nlist-img2.jpg" alt="" /> </div>
                        </div>
                        <div class="col-md-7 col-sm-7">
                            <div class="news-txt">
                                <ul class="meta-info">
                                    <li>By <a href="#">Dylan Carter</a></li>
                                    <li>Mar. 15, 2017</li>
                                </ul>
                                <h4> <a href="#"> TOP Head LIaVettel beats Hamilton into second for opening </a></h4>
                                <p>BMC Racing Team will be targeting stage wins at the demanding six-day Vuelta Ciclista al Pais Vasco, the next UCI WorldTour stage race of the season.to go. Sport teams, athletes., </p>
                                <a class="rm" href="#"> Read more </a> </div>
                        </div>
                    </div>
                </div>
                <!-- News List End -->

                <!-- News List Start -->
                <div class="row">
                    <div class="news-block ">
                        <div class="col-md-5 col-sm-5">
                            <div class="news-thumb"> <a href="#"><i class="fa fa-link"></i></a> <img src="./images/nlist-img3.jpg" alt="" /> </div>
                        </div>
                        <div class="col-md-7 col-sm-7">
                            <div class="news-txt">
                                <ul class="meta-info">
                                    <li>By <a href="#">Dylan Carter</a></li>
                                    <li>Mar. 15, 2017</li>
                                </ul>
                                <h4> <a href="#"> Final Four expert picks: SI writers make predictions for Gonzaga </a></h4>
                                <p>BMC Racing Team will be targeting stage wins at the demanding six-day Vuelta Ciclista al Pais Vasco, the next UCI WorldTour stage race of the season.to go. Sport teams, athletes., </p>
                                <a class="rm" href="#"> Read more </a> </div>
                        </div>
                    </div>
                </div>
                <!-- News List End -->

                <!-- News List Start -->
                <div class="row">
                    <div class="news-block ">
                        <div class="col-md-5 col-sm-5">
                            <div class="news-thumb"> <a href="#"><i class="fa fa-link"></i></a> <img src="./images/nlist-img4.jpg" alt="" /> </div>
                        </div>
                        <div class="col-md-7 col-sm-7">
                            <div class="news-txt">
                                <ul class="meta-info">
                                    <li>By <a href="#">Dylan Carter</a></li>
                                    <li>Mar. 15, 2017</li>
                                </ul>
                                <h4> <a href="#"> Watch this Irish league player score a dazzler from inside his own half </a></h4>
                                <p>BMC Racing Team will be targeting stage wins at the demanding six-day Vuelta Ciclista al Pais Vasco, the next UCI WorldTour stage race of the season.to go. Sport teams, athletes., </p>
                                <a class="rm" href="#"> Read more </a> </div>
                        </div>
                    </div>
                </div>
                <!-- News List End -->

                <div class="fl-pagination">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li>
                                <a class="pagi" href="#" aria-label="Previous"> <span aria-hidden="true">&laquo; Previous</span> </a>
                            </li>
                            <li><a href="#">1</a></li>
                            <li class="active"><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li>
                                <a class="pagi" href="#" aria-label="Next"> <span aria-hidden="true">Next &raquo;</span> </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-md-4">
                <div class="match-fixture-widget">
                    <h4>Match Fixture</h4>
                    <p>Saturday, 25 Match Fixture Games</p>

                    <!--Match Box Start-->
                    <div class="match-box">
                        <ul class="match-fixture-inner">
                            <li class="team"> <img src="./images/tlogos/tl-1.png" alt="" /> <strong>Portugal</strong></li>
                            <li class="time-batch"><strong class="m-date">20 May 2017</strong> <strong class="m-time">4:30 pm</strong> <strong class="m-vs">VS</strong></li>
                            <li class="team"><img src="./images/tlogos/tl-2.png" alt="" /> <strong>Germany</strong></li>
                        </ul>
                        <div class="mb-footer"> 123 6th St. Melbourne, FL 32904</div>
                    </div>
                    <!--Match Box End-->

                    <!--Match Box Start-->
                    <div class="match-box">
                        <ul class="match-fixture-inner">
                            <li class="team"> <img src="./images/tlogos/tl-2.png" alt="" /> <strong>Portugal</strong></li>
                            <li class="time-batch"><strong class="m-date">20 May 2017</strong> <strong class="m-time">4:30 pm</strong> <strong class="m-vs">VS</strong></li>
                            <li class="team"><img src="./images/tlogos/tl-3.png" alt="" /> <strong>Germany</strong></li>
                        </ul>
                        <div class="mb-footer"> 123 6th St. Melbourne, FL 32904</div>
                    </div>
                    <!--Match Box End-->

                    <div class="text-center"> <a class="load-more" href="#">More Fixtures</a> </div>
                </div>
                <div class="sidead-widget"> <img src="./images/sidead.jpg" alt="" /> </div>
                <div class="side-news-widget">
                    <h4 class="section-title">Sports Related Shop</h4>
                    <ul class="small-grid">
                        <!--Row Start-->
                        <li class="news">
                            <div class="small-thumb"> <img src="./images/lng1.jpg" alt="" /> </div>
                            <div class="news-txt">
                                <ul class="meta-info">
                                    <li>By <a href="#">Dylan Carter</a></li>
                                    <li>Mar. 15, 2017</li>
                                </ul>
                                <h6> <a href="#">NHRA Drag Racing - DENSO Spark Plugs Nationals</a> </h6>
                            </div>
                        </li>
                        <!--Row End-->

                        <!--Row Start-->
                        <li class="news">
                            <div class="small-thumb"> <img src="./images/lng2.jpg" alt="" /> </div>
                            <div class="news-txt">
                                <ul class="meta-info">
                                    <li>By <a href="#">Dylan Carter</a></li>
                                    <li>Mar. 15, 2017</li>
                                </ul>
                                <h6> <a href="#">NHRA Drag Racing - DENSO Spark Plugs Nationals</a> </h6>
                            </div>
                        </li>
                        <!--Row End-->

                        <!--Row Start-->
                        <li class="news">
                            <div class="small-thumb"> <img src="./images/lng3.jpg" alt="" /> </div>
                            <div class="news-txt">
                                <ul class="meta-info">
                                    <li>By <a href="#">Dylan Carter</a></li>
                                    <li>Mar. 15, 2017</li>
                                </ul>
                                <h6> <a href="#">NHRA Drag Racing - DENSO Spark Plugs Nationals</a> </h6>
                            </div>
                        </li>
                        <!--Row End-->

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Tab post Grid Start-->

<!--News Gallery Start-->
<div class="news-section-wrapper news-gallery no-margin">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="section-title">News Gallery</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="news-block ">
                    <div class="news-thumb"> <a href="#"><i class="fa fa-link"></i></a> <img src="./images/ngp-1.jpg" alt="" /> </div>
                    <div class="news-txt">
                        <ul class="meta-info">
                            <li><a href="#">Racing</a></li>
                        </ul>
                        <h5> <a href="#">Tiger Woods announces he </a> </h5>
                        <p>Golden State's help behind those plays wasn't as airtight...</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="news-block ">
                    <div class="news-thumb"> <a href="#"><i class="fa fa-link"></i></a> <img src="./images/ngp-2.jpg" alt="" /> </div>
                    <div class="news-txt">
                        <ul class="meta-info">
                            <li><a href="#">Racing</a></li>
                        </ul>
                        <h5> <a href="#">Tiger Woods announces he </a> </h5>
                        <p>Golden State's help behind those plays wasn't as airtight...</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="news-block ">
                    <div class="news-thumb"> <a href="#"><i class="fa fa-link"></i></a> <img src="./images/ngp-3.jpg" alt="" /> </div>
                    <div class="news-txt">
                        <ul class="meta-info">
                            <li><a href="#">Racing</a></li>
                        </ul>
                        <h5> <a href="#">Tiger Woods announces he </a> </h5>
                        <p>Golden State's help behind those plays wasn't as airtight...</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="news-block ">
                    <div class="news-thumb"> <a href="#"><i class="fa fa-link"></i></a> <img src="./images/ngp-4.jpg" alt="" /> </div>
                    <div class="news-txt">
                        <ul class="meta-info">
                            <li><a href="#">Racing</a></li>
                        </ul>
                        <h5> <a href="#">Tiger Woods announces he </a> </h5>
                        <p>Golden State's help behind those plays wasn't as airtight...</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="news-block ">
                    <div class="news-thumb"> <a href="#"><i class="fa fa-link"></i></a> <img src="./images/ngp-5.jpg" alt="" /> </div>
                    <div class="news-txt">
                        <ul class="meta-info">
                            <li><a href="#">Racing</a></li>
                        </ul>
                        <h5> <a href="#">Tiger Woods announces he </a> </h5>
                        <p>Golden State's help behind those plays wasn't as airtight...</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="news-block ">
                    <div class="news-thumb"> <a href="#"><i class="fa fa-link"></i></a> <img src="./images/ngp-6.jpg" alt="" /> </div>
                    <div class="news-txt">
                        <ul class="meta-info">
                            <li><a href="#">Racing</a></li>
                        </ul>
                        <h5> <a href="#">Tiger Woods announces he </a> </h5>
                        <p>Golden State's help behind those plays wasn't as airtight...</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="news-block ">
                    <div class="news-thumb"> <a href="#"><i class="fa fa-link"></i></a> <img src="./images/ngp-7.jpg" alt="" /> </div>
                    <div class="news-txt">
                        <ul class="meta-info">
                            <li><a href="#">Racing</a></li>
                        </ul>
                        <h5> <a href="#">Tiger Woods announces he </a> </h5>
                        <p>Golden State's help behind those plays wasn't as airtight...</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="news-block ">
                    <div class="news-thumb"> <a href="#"><i class="fa fa-link"></i></a> <img src="./images/ngp-8.jpg" alt="" /> </div>
                    <div class="news-txt">
                        <ul class="meta-info">
                            <li><a href="#">Racing</a></li>
                        </ul>
                        <h5> <a href="#">Tiger Woods announces he </a> </h5>
                        <p>Golden State's help behind those plays wasn't as airtight...</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row text-center"> <a class="load-more" href="#">Load More</a> </div>
    </div>
</div>
<!--News Gallery End-->

<header class="header color-1" id="header">
    <div class="logo-nav">
        <div class="container">
            <div class="row" style="background-color:#06365C">
                <!--Logo Start-->
                <div class="col-md-3 nop">
                  <div class="header-navbar">
                      <nav>
                          <div class="navbar-header">
                              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                          </div>

                          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                              <ul class="acbar-right" style="text-align:left">
                                  <li class="social">
                                    @if(\App\Helpers\Helper::getConfig('empresa-facebook'))
                                        <a href="{{ \App\Helpers\Helper::getConfig('empresa-facebook') }}" class="fb-icon"><i class="fa fa-facebook fa-lg"></i></a>
                                    @endif
                                    @if(\App\Helpers\Helper::getConfig('empresa-twitter'))
                                        <a href="{{ \App\Helpers\Helper::getConfig('empresa-twitter') }}" class="tw-icon"><i class="fa fa-twitter fa-lg"></i></a>
                                    @endif
                                    @if(\App\Helpers\Helper::getConfig('empresa-google'))
                                        <a href="{{ \App\Helpers\Helper::getConfig('empresa-google') }}" class="lin-icon"><i class="fa fa-google-plus fa-lg"></i></a>
                                    @endif
                                    @if(\App\Helpers\Helper::getConfig('empresa-vimeo'))
                                        <a href="{{ \App\Helpers\Helper::getConfig('empresa-vimeo') }}" class="lin-icon"><i class="fa fa-vimeo fa-lg"></i></a>
                                    @endif
                                    @if(\App\Helpers\Helper::getConfig('empresa-linkedin'))
                                        <a href="{{ \App\Helpers\Helper::getConfig('empresa-linkedin') }}" class="lin-icon"><i class="fa fa-linkedin fa-lg"></i></a>
                                    @endif
                                    @if(\App\Helpers\Helper::getConfig('empresa-youtube'))
                                        <a href="{{ \App\Helpers\Helper::getConfig('empresa-youtube') }}" class="yt-icon"><i class="fa fa-youtube fa-lg"></i></a>
                                    @endif
                                  </li>

                              </ul>


                          </div>
                      </nav>
                  </div>
                </div>
                <!--Logo End-->

                <!--Nav Start-->
                <div class="col-md-9">

                    <div class="header-navbar">
                        <nav>
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                            </div>

                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                                <ul class="acbar-right">

                                    @php

                                      $route = route('player_agendar_partida');

                                      if(\Auth::check() && \Auth::user()->isAdmin()) {
                                          $route = route('agendar_partida');
                                      }

                                    @endphp

                                    <li>
                                        <a style="color:white" href="{{ $route }}" class="login-btn"> <i class="fa fa-calendar-o"></i> &nbsp;&nbsp;Agendamento</a>
                                    </li>
                                    <li>
                                        @php

                                          $defaultRoute = '/admin';

                                          if(\Auth::check() && !\Auth::user()->isAdmin()) {
                                            $defaultRoute = '/player';
                                          }

                                        @endphp

                                        <a style="color:white" target="_blank" href="{{ url($defaultRoute) }}" class="login-btn"> <i class="fa fa-user"></i>  &nbsp;&nbsp;Área do Jogador</a>
                                    </li>
                                </ul>


                            </div>
                        </nav>
                    </div>

                </div>

            </div>
        </div>
        <div class="container">
            <div class="row">
                <!--Logo Start-->
                <div class="col-md-3" style="background-color:white;">
                    <div class="logo">
                        <a href="{{ route('home') }}">
                        <h2>{{\App\Helpers\Helper::getConfig('empresa-nome')}}</h2></a>
                    </div>
                </div>
                <!--Logo End-->

                <!--Nav Start-->
                <div class="col-md-9" style="background-color:white;height:81px">

                    <div class="header-navbar">
                        <nav>
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                            </div>

                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="text-align:center;margin-top: 15px;">
                                <ul class="nav navbar-nav">
                                    <li> <a href="{{ route('home') }}">HOME</a></li>
                                    <li> <a href="#">JOGOS <span class="caret"></span></a>
                                        <ul class="sub-menu">
                                          <li><a href="{{ route('calendario') }}">CALENDÁRIO</a></li>
                                          <li><a href="{{ route('resultados') }}">RESULTADOS</a></li>
                                          <li><a href="{{ route('classificacao') }}">CLASSIFICAÇÃO</a></li>

                                          @if(\App\Helpers\Helper::getConfig('pagina-regulamento'))

                                            <li>
                                                <a href="{{ \App\Helpers\Helper::getConfig('pagina-regulamento') }}">Regulamento</a>
                                            </li>

                                          @endif

                                        </ul>
                                    </li>

                                    <li><a href="{{ route('contato') }}">GALERIA</a></li>
                                    <li><a href="{{ route('contato') }}">NOTÍCIAS</a></li>
                                    <li><a href="{{ route('contato') }}">CONTATO</a></li>
                                </ul>
                                <ul class="acbar-right">
                                    <li class="social">
                                      @if(\App\Helpers\Helper::getConfig('empresa-facebook'))
                                          <a href="{{ \App\Helpers\Helper::getConfig('empresa-facebook') }}" class="fb-icon"><i class="fa fa-facebook"></i></a>
                                      @endif
                                      @if(\App\Helpers\Helper::getConfig('empresa-twitter'))
                                          <a href="{{ \App\Helpers\Helper::getConfig('empresa-twitter') }}" class="tw-icon"><i class="fa fa-twitter"></i></a>
                                      @endif
                                      @if(\App\Helpers\Helper::getConfig('empresa-google'))
                                          <a href="{{ \App\Helpers\Helper::getConfig('empresa-google') }}" class="lin-icon"><i class="fa fa-google-plus"></i></a>
                                      @endif
                                      @if(\App\Helpers\Helper::getConfig('empresa-vimeo'))
                                          <a href="{{ \App\Helpers\Helper::getConfig('empresa-vimeo') }}" class="lin-icon"><i class="fa fa-vimeo"></i></a>
                                      @endif
                                      @if(\App\Helpers\Helper::getConfig('empresa-linkedin'))
                                          <a href="{{ \App\Helpers\Helper::getConfig('empresa-linkedin') }}" class="lin-icon"><i class="fa fa-linkedin"></i></a>
                                      @endif
                                      @if(\App\Helpers\Helper::getConfig('empresa-youtube'))
                                          <a href="{{ \App\Helpers\Helper::getConfig('empresa-youtube') }}" class="yt-icon"><i class="fa fa-youtube"></i></a>
                                      @endif
                                    </li>

                                </ul>


                            </div>
                        </nav>
                    </div>

                </div>

                <div class="col-md-12 containercategorias" style="padding-right:0;padding-left:0;">

                  <div class="header-navbar">

                      <nav>

                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="background-color: #1D90ED;text-align:center">
                          <ul class="nav navbar-nav" style="width:100%;text-align: center;">

                            @php
                              $categorias = \App\Helpers\Helper::categorias();

                              $categorias = $categorias->filter(function($categoria) {
                                  return $categoria->habilitar_menu;
                              });
                            @endphp

                            @foreach($categorias as $categoria)
                                <li class="" style="height:100%;">
                                  <a class="link-categorias" style="text-align: center;padding-left:30px;" href="?category={{ $categoria->id }}">{{ $categoria->nome }}</a>
                                </li>
                            @endforeach

                          </ul>
                        </div>

                      </nav>

                  </div>

                </div>
            </div>
        </div>
    </div>
</header>

<header class="header color-2" id="header">
    <div class="logo-nav">
        <div class="container containermenu">
            <div class="row">
                <!--Logo Start-->
                <div class="col-md-3 nop">
                    <div class="logo">
                        <a href="{{ route('home') }}"> <!--<img src="./images/logo.png" alt="" />--> <h2>{{\App\Helpers\Helper::getConfig('empresa-nome')}}</h2></a>
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
                                <ul class="nav navbar-nav">
                                    <li> <a href="{{ route('home') }}">Home</a></li>
                                    <li> <a href="#">Jogos <span class="caret"></span></a>
                                        <ul class="sub-menu">
                                          <li><a href="{{ route('calendario') }}">Calendário de jogos</a></li>
                                          <li><a href="{{ route('resultados') }}">Resultados de Jogos</a></li>
                                          <li><a href="{{ route('classificacao') }}">Classificação</a></li>

                                          @if(\App\Helpers\Helper::getConfig('pagina-regulamento'))

                                            <li>
                                                <a href="{{ \App\Helpers\Helper::getConfig('pagina-regulamento') }}">Regulamento</a>
                                            </li>

                                          @endif

                                        </ul>
                                    </li>

                                    <li><a href="{{ route('contato') }}">Contato</a></li>
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



                                    @php

                                      $route = route('player_agendar_partida');

                                      if(\Auth::check() && \Auth::user()->isAdmin()) {
                                          $route = route('agendar_partida');
                                      }

                                    @endphp

                                    <li>
                                        <a href="{{ $route }}" class="login-btn"> <i class="fa fa-calendar-o"></i> Agendamento</a>
                                    </li>
                                    <li>
                                        @php

                                          $defaultRoute = '/admin';

                                          if(\Auth::check() && !\Auth::user()->isAdmin()) {
                                            $defaultRoute = '/player';
                                          }

                                        @endphp

                                        <a target="_blank" href="{{ url($defaultRoute) }}" class="login-btn"> <i class="fa fa-user"></i> Área do Jogador</a>
                                    </li>
                                </ul>


                            </div>
                        </nav>
                    </div>

                </div>

                <div class="col-md-12 containercategorias" style="padding-right:0;padding-left:0;">

                  <div class="header-navbar">

                      <nav>

                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding-right:0;padding-left:0;background-color: #1b4465;">
                          <ul class="nav navbar-nav">

                            @php
                              $categorias = \App\Helpers\Helper::categorias();

                              $categorias = $categorias->filter(function($categoria) {
                                  return $categoria->habilitar_menu;
                              });
                            @endphp

                            @foreach($categorias as $categoria)
                                <li class="" style="background-color:#1b4465;height:100%"><a class="link-categorias" href="?category={{ $categoria->id }}">{{ $categoria->nome }}</a></li>
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

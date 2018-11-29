<footer class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-4">
                    <div class="footer-widget">
                        <img src="{{ route('image',['link'=>'logo.png']) }}" alt="" />
                    </div>
                </div>
                <div class="col-md-3 col-sm-4">
                    <div class="footer-widget">
                        <h4>Menu</h4>
                        <ul class="footer-nav">
                          <li> <a href="{{ route('home') }}">Home</a></li>
                          <li><a href="{{ route('calendario') }}">Calendário de jogos</a></li>
                          <li><a href="{{ route('resultados') }}">Resultados de Jogos</a></li>
                          <li><a href="{{ route('classificacao') }}">Classificação</a></li>
                          <li><a href="{{ route('contato') }}">Contato</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-sm-4">
                    <div class="footer-widget">
                        <h4>Perdizes</h4>
                        <ul class="footer-nav">
                            <li>Rua Ana Pimentel, 272</li>
                            <li>(11) 3871-9555</li>
                            <li>(11) 95070-7660</li>
                            <li>bsportsbrasil</li>
                            <li>BSportsBR</li>
                            <li></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4">
                    <div class="footer-widget">
                        <h4>Santana</h4>
                        <ul class="footer-nav">
                            <li><a href="#">Rua Bento de Alvarena, 15</a></li>
                            <li>(11) 2950-6871</li>
                            <li>(11) 94019-5238</li>
                            <li><a href="#">bsportssantana</a></li>
                            <li><a href="#">BSportsSantana</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="col-md-6 col-sm-6">
                <p>{{\App\Helpers\Helper::getConfig('empresa-nome-secundario')}} © {{ now()->format('Y') }} Direitos Reservados. Desenvolvido por <a href="www.linkedin.com/in/césar-augusto-sousa-902b5356" target="_blank">César Augusto</a></p>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="footer-social text-right">
                  <!--<a href="#" class="fb"><i class="fa fa-facebook"></i></a>
                  <a href="#" class="tw"><i class="fa fa-twitter"></i></a>
                  <a href="#" class="ytp"><i class="fa fa-youtube-play"></i></a>
                  <a href="#" class="vim"><i class="fa fa-vimeo"></i></a>
                  <a href="#" class="gp"><i class="fa fa-google-plus"></i></a>
                -->

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

                </div>
            </div>
        </div>
    </div>
</footer>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name') }}</title>
    <link rel="icon" type="image/x-icon" href="./images/fav.png" />
    <!-- Css Files -->
    <link href="{{ asset('css/custom-new.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/color.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/prettyPhoto.css') }}" rel="stylesheet" />

    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css"/>

    <style>

		html body {
			background: none;
		}

    .owl-prev, .owl-next {
      background-color: #00aeef;
			height: 25%
    }

    .footer {
      background: #003d57;
    }

    .footer-widget h4 {
      color: #d7eb22;
    }

    .footer-widget ul.footer-nav li{
      color:white;
    }

    .footer-bottom{
      border-top: 1px solid #d7eb22;
    }

		div#featured-slider.owl-theme .owl-nav [class*=owl-] {
			color: #FFF;
			font-size: 0;
			margin: 0;
			padding: 0;
			background: #00aeef;
			display: inline-block;
			cursor: pointer;
			border-radius: 0;
			width: 35px;
			height: 50px;
			text-align: center;
			line-height: 50px;
			position: relative;
		}

		div#featured-slider.owl-theme .owl-nav [class*=owl-]:hover {
			background: #00aeef;
			color: #fff;
		}

    .news-section-wrapper {
      box-shadow:none;
    }

    .login-btn {
      color: #d7eb22;
    }

    .link-categorias {
      color:white;
    }

    .link-categorias:hover {
      background-color:#1b4465;
    }

    .nav>li>a:focus, .nav>li>a:hover{
      background-color:#1b4465;
    }

    .logo-nav {
      background:#215a88;
    }

    .data-number{
      color:#dade3c;
    }

    .player-ranking-data{
      background-color: #1a1f23;
    }

    .owl-prev, .owl-next {
      background: #1b4465;
    }

    div#featured-slider.owl-theme .owl-nav [class*=owl-] {
      background: #1b4465;
    }

    .first-name, .last-name{
      color:#6189aa;
    }

    .proximas-partidas{
      background-color: #111f44;
      padding: 1em 1em;
    }

    .proximas-partidas h2{
      color: white;
    }

    .tab-news ul.nav li a{
      color: #d7eb22;
      border-bottom: 4px solid #d7eb22;
    }

    .title-news{
      color: #6da9d9;
    }

    .btn-news {
      color: #6da9d9;
      background-color:#6da9d9;
    }

    .news-txt h3 a, .news-txt h4 a, .news-txt h5 a, .news-txt h6 a{
      color:#6da9d9;
    }

    .author{
      color:black;
    }

    .sidenews-slider .owl-theme .owl-nav [class*=owl-], .newslist-block .news-block:hover .news-txt a.rm{
      background-color:#6da9d9;
    }

    .news-txt a.rm{
      background-color:#6da9d9;
      color:white;
    }

    .tab-proximas-partidas:focus {
      color:white !important;
    }

    .tab-proximas-partidas:hover {
      color:white !important;
    }

    @media (max-width: 767px) {
      .navbar-collapse {
        height:320px!important
      }
    }

    </style>

    @yield('css')

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

<body>

    <div class="wrapper-full color-option-2">

        @include('layouts.includes.menu')

				@yield('content')

        @include('partials.footer')

    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery-migrate-1.4.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.ticker.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.4/holder.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.pt-BR.min.js"></script>

    <script>
        $('.telefone').mask('(00) 00000-0000');
        $('.money').mask('000.000.000.000.000,00', {reverse: true});
        $('.date').mask('00/00/0000');
        $('.time').mask('00:00:00');
        $('.int').mask('00');

        $('.datepicker').datepicker({
          startDate: "today",
          format: "dd/mm/yyyy",
          clearBtn: true,
          todayBtn: "linked",
          language: "pt-BR",
          calendarWeeks: true,
          autoclose: true,
          todayHighlight: true
        });
    </script>


    @yield('js')
</body>

</html>

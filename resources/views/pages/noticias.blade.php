@extends('layouts.layout')

@section('css')
    <style>

      .event-txt-wrap .event-txt {
        width: 100%;
      }

      .team-box {
          background-color: #f4f4f4;
      }

      .page-wrapper {
        padding: 30px 0;
      }

    </style>
@stop

@section('content')

<div class="inner-banner">
    <h1>Notícias</h1>
</div>

<div class="fl-breadcrumps">
    <div class="container">
        <ul class="pull-left">
            <li> <a href="{{ route('home') }}">Início</a> </li>
            <li> <a>Notícias</a> </li>
        </ul>
        <a class="pull-right" href="{{ route('home') }}">Voltar ao início <i class="fa fa-caret-right"></i></a>
    </div>
</div>


<div class="page-wrapper">

    <!-- Blog Full Start -->
    <div class="blog">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <!--Blog Post Start-->
                    <div class="blog-post">

                        <div class="blog-content">

                          @foreach($noticias as $noticia)
                          <div class="col-md-3 col-sm-6">
                              <div class="news-block ">
                                  <div class="news-thumb"> <img style="min-width:300px;max-width:300px;min-height:200px;max-height:200px;" src="{{ route('image', ['link'=>$noticia->banner]) }}" alt="" /> </div>
                                  <div class="news-txt">
                                      <h4> <a href="{{ route('noticia', ['id'=>$noticia->id,'titulo'=>str_slug($noticia->titulo)]) }}">{{ $noticia->titulo }}</a> </h4>
                                      <p> {{ substr($noticia->conteudo, 0, 50) }} </p>
                                      <a class="rm" href="{{ route('noticia', ['id'=>$noticia->id,'titulo'=>str_slug($noticia->titulo)]) }}"> Saiba Mais </a> </div>
                              </div>
                          </div>
                          @endforeach

                        </div>
                    </div>
                    <!--Blog Post End-->

                </div>

            </div>
        </div>
    </div>
    <!-- Blog Full End -->

</div>

@endsection

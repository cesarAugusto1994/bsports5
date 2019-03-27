@extends('layouts.layout')

@section('css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.swipebox/1.4.4/css/swipebox.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/justifiedGallery/3.7.0/css/justifiedGallery.min.css"/>

<style>

.page-wrapper {
  padding: 30px 0;
}

</style>

@stop

@section('content')

<div class="inner-banner">
    <h1>Galerias</h1>
</div>
<div class="fl-breadcrumps">
    <div class="container">
        <ul class="pull-left">
            <li> <a href="{{ route('home') }}">Home</a> </li>
            <li> <a>Galerias</a> </li>
        </ul>
        <a class="pull-right" href="{{ route('home') }}">Voltar à Home <i class="fa fa-caret-right"></i></a> </div>
</div>

<div class="page-wrapper">

    <div class="contact-page">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <div class="contact-form">

                        <div class="row">

                        @foreach($midias as $midia)

                        @php

                        $route="";

                        if($midia->links->isNotEmpty()) {
                            $route = route('image', ['link'=>$midia->links->first()->link]);
                        }

                        @endphp

                        <div class="col-md-3 col-sm-6">
                            <div class="news-block ">
                                <div class="news-thumb"> <img style="min-width:300px;max-width:300px;min-height:200px;max-height:200px;" src="{{ $route }}" alt="" /> </div>
                                <div class="news-txt">
                                    <h4> <a href="{{ route('galeria', [$midia->id]) }}">{{ $midia->titulo }}</a> </h4>
                                    <p> {{ substr($midia->conteudo, 0, 50) }} </p>
                                    <a class="rm" href="{{ route('galeria', [$midia->id]) }}"> Saiba Mais </a> </div>
                            </div>
                        </div>

                        @endforeach

                        </div>

                    </div>
                </div>
            </div>
            <div class="row">

            </div>
        </div>
    </div>

</div>

@endsection

@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.swipebox/1.4.4/js/jquery.swipebox.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/justifiedGallery/3.7.0/js/jquery.justifiedGallery.min.js"></script>

<script type="text/javascript">
;( function( $ ) {

	$( '.swipebox' ).swipebox();

} )( jQuery );



</script>

@stop

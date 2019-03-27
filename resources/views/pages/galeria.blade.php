@extends('layouts.layout')

@section('css')


<style>

.page-wrapper {
  padding: 30px 0;
}

</style>

@stop

@section('content')

<div class="inner-banner">
    <h1>Galeria - {{ $midia->titulo }}</h1>

</div>

<div class="fl-breadcrumps">
    <div class="container">
        <ul class="pull-left">
            <li> <a href="{{ route('home') }}">Home</a> </li>
            <li> <a>Galeria</a> </li>
        </ul>
        <a class="pull-right" href="{{ route('home') }}">Voltar à Home <i class="fa fa-caret-right"></i></a>
    </div>
</div>

<div class="page-wrapper">

    <div class="contact-page">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <div class="contact-form">

                        <div class="row">

                          <p>Descrição: {{ $midia->descricao }}</p>
                          <br/>

                        @foreach($midia->links as $link)

                        <div class="col-md-4">

                          <a rel="gallery-1" href="{{ route('image', ['link'=>$link->link]) }}" class="swipebox">
                          	<img style="width:100%;padding:1em" src="{{ route('image', ['link'=>$link->link]) }}" alt="image">
                          </a>

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

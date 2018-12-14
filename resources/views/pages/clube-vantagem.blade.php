@extends('layouts.layout')

@section('content')

<div class="inner-banner">
    <h1>Clube de Vantagens</h1>
</div>
<div class="fl-breadcrumps">
    <div class="container">
        <ul class="pull-left">
            <li> <a href="{{ route('home') }}">Home</a> </li>
            <li> <a>Clube de Vantagens</a> </li>
        </ul>
        <a class="pull-right" href="{{ route('home') }}">Voltar à Home <i class="fa fa-caret-right"></i></a> </div>
</div>

<div class="page-wrapper">

    <div class="contact-page">
        <div class="container">
            <img src="{{ asset('img/clube.jpg') }}" alt="" style="width:100%"/>
        </div>
    </div>

</div>

@endsection

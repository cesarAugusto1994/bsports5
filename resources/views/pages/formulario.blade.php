@extends('layouts.layout')

@section('content')

<div class="inner-banner">
    <h1>Agedar Partida</h1>
    <p>Agende uma partida</p>
</div>
<div class="fl-breadcrumps">
    <div class="container">
        <ul class="pull-left">
            <li> <a href="{{ route('home') }}">Home</a> </li>
            <li> <a>Agedar Partida</a> </li>
        </ul>
        <a class="pull-right" href="{{ route('home') }}">Voltar à Home <i class="fa fa-caret-right"></i></a> </div>
</div>

<div class="page-wrapper">

    <div class="contact-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="contact-form">
                        <h2 class="section-title"> Marque uma partida </h2>
                        <form method="post" action="{{ route('formulario_agendar_store') }}">
                            {{ csrf_field() }}
                            <ul>
                                <li>
                                    <input name="nome" type="text" class="form-control" placeholder="Nome Completo" required="" />
                                </li>
                                <li>
                                    <input name="telefone" type="text" class="form-control telefone" placeholder="Telefone" required/>
                                </li>
                                <li>
                                    <input name="email" type="text" class="form-control" placeholder="Email" required="" />
                                </li>
                                <li>
                                    <input name="data" type="date" class="form-control" placeholder="Data" required/>
                                </li>
                                <li>
                                    <input name="horario" type="time" class="form-control" placeholder="Horário" required/>
                                </li>
                                <li>
                                    <input class="submit" value="Enviar" type="submit" />
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@section('js')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
@stop

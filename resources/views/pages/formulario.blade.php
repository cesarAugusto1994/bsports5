@extends('layouts.layout')

@section('content')

<div class="inner-banner">
    <h1>Aula Experimental do Ranking</h1>
    <p>Agende uma partida</p>
</div>
<div class="fl-breadcrumps">
    <div class="container">
        <ul class="pull-left">
            <li> <a href="{{ route('home') }}">Home</a> </li>
            <li> <a>Aula Experimental do Ranking</a> </li>
        </ul>
        <a class="pull-right" href="{{ route('home') }}">Voltar à Home <i class="fa fa-caret-right"></i></a> </div>
</div>

<div class="page-wrapper">

    <div class="contact-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                  <div class="contact-form">
                      <h2 class="section-title"> Aula Experimental do Ranking </h2>
                      <p>Preencha os campos abaixo para realizar uma aula grátis do Ranking. Verifique o preenchimento de todos os campos</p>
                      <form method="post" action="{{ route('formulario_clube_store') }}">
                          {{ csrf_field() }}
                          <ul>
                              <li>
                                  <input name="nome" type="text" class="form-control" placeholder="Nome Completo" required="" />
                              </li>
                              <li>
                                  <input name="celular" type="text" class="form-control celular" placeholder="Celular" required/>
                              </li>
                              <li>
                                  <input name="email" type="text" class="form-control" placeholder="Email" required="" />
                              </li>
                              <li>
                                  <input name="idade" type="text" class="form-control int" placeholder="Idade" max="100" maxlength="2" required/>
                              </li>

                              <li>
                                  <select class="form-control" name="categoria" required>
                                        <option value="">Categoria</option>
                                        <option>Masculino</option>
                                        <option>Feminino</option>
                                        <option>Kids</option>
                                        <option>Juvenil</option>
                                  </select>
                              </li>

                              <li>
                                  <select class="form-control" name="classificacao" required>
                                        <option value="">Classificação</option>
                                        <option value="basico">Basico</option>
                                        <option value="medio">Medio</option>
                                        <option value="avancado">Avançado</option>
                                  </select>
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

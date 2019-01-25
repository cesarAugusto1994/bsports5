@extends('adminlte::page')

@section('title', 'Partidas')

@section('content_header')
    <h1>Placar Partida</h1>
@stop

@section('content')

<div class="row">

  <form method="post" action="{{ route('trocar_jogador_store', $partida->id) }}">

      {{ csrf_field() }}

      <div class="col-md-12">
        <div class="box box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">Partida #{{$partida->id}}</h3>
          </div>
          <div class="box-body">
            <div class="table-responsive">

              @php

                $user = \Auth::user();

                $jogador = \App\Models\Pessoa\Jogador::where('email', $user->email)->get()->first();

              @endphp

                <input type="hidden" id="jogador-ajax" value="{{ route('jogadores_ajax') }}"/>

                <div class="col-md-6">
                  <div class="box box-solid">
                    <div class="box-header with-border">
                      <h3 class="box-title">1º Jogador: {{$partida->jagador1->nome ?? ''}}</h3>
                    </div>
                    <div class="box-body">

                        <div class="row">

                          <div class="col-md-12">

                              @if($partida->jogador1)

                                  <img class="img-circle" src="{{ route('image', ['link'=>$partida->jogador1->avatar]) }}" alt=""/>

                                  <strong>{{ substr($partida->jogador1->nome, 0, 12) }}</strong>
                                  <input type="hidden" name="jogador1" value="{{ $partida->jogador1->id }}"/>

                              @else

                                @if($user->isAdmin())
                                    <select class="form-control select2 select-jogador" style="width:270px" name="jogador1">
                                        <option value=""></option>
                                    </select>
                                @else

                                    @if($partida->jogador1 && $partida->jogador2)

                                        <img style="max-width:128px" src="{{ route('image', ['link'=>$jogador->avatar]) }}" alt="">
                                        <strong>{{ substr($jogador->nome, 0, 12) }}</strong>
                                        <input type="hidden" name="jogador1" value="{{ $jogador->id }}"/>

                                    else

                                        A definir

                                    @endif


                                @endif

                              @endif

                          </div>

                        </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="box box-solid">
                    <div class="box-header with-border">
                      <h3 class="box-title">2º Jogador: {{$partida->jagador2->nome ?? ''}}</h3>
                    </div>
                    <div class="box-body">

                        <div class="row">

                          <div class="col-md-12">

                            @if($partida->jogador2)

                                <img width="128" style="max-width:128px" src="{{ route('image', ['link'=>$partida->jogador2->avatar]) }}" alt=""/>
                                <strong>{{ substr($partida->jogador2->nome, 0, 12) }}</strong>
                                <input type="hidden" name="jogador2" value="{{ $partida->jogador2->id }}"/>

                            @else

                              @if($user->isAdmin())
                                  <select class="form-control select2 select-jogador" style="width:270px" name="jogador2">
                                      <option value=""></option>
                                  </select>
                              @else

                                @if($partida->jogador1 && $partida->jogador2)

                                    A definir

                                @else

                                    <img  width="128" style="max-width:128px" src="{{ route('image', ['link'=>$jogador->avatar]) }}" alt="">
                                    <strong>{{ substr($jogador->nome, 0, 12) }}</strong>
                                    <input type="hidden" name="jogador2" value="{{ $jogador->id }}"/>

                                @endif


                              @endif

                            @endif

                          </div>

                        </div>
                    </div>
                  </div>
                </div>


                <div class="col-md-12">
                      <button type="submit" class="btn btn-flat btn-lg btn-block btn-dropbox">Salvar</button>
                </div>



            </div>
          </div>
        </div>
      </div>



  </form>

</div>

@stop

@section('css')
@stop

@section('js')

  <script>

  </script>

@stop

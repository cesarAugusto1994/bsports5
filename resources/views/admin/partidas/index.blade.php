@extends('adminlte::page')

@section('title', 'Partidas')

@section('content_header')
    <h1>Partidas</h1>
@stop

@section('content')

<div class="row">

  <div class="col-md-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Filtros</h3>
        </div>
        <div class="box-body">

          <form action="#">
              <div class="box-body">
                <div class="row">

                  <div class="col-md-1">
                    <div class="form-group">
                      <label for="id">Codigo</label>
                      <input type="text" class="form-control" id="id" name="id">
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="nome">Nome</label>
                      <input type="text" class="form-control" id="nome" name="nome">
                    </div>
                  </div>

                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="categoria">Quadra</label>
                      <select class="form-control select2" name="quadra" id="quadra">
                        <option value=""></option>
                        @foreach($quadras as $quadra)
                            <option value="{{ $quadra->id }}">{{ $quadra->nome }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="categoria">Categoria</label>
                      <select name="categoria" class="form-control" id="categoria">
                        <option value=""></option>
                          @foreach($categorias as $categoria)
                              <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="codigo">Periodo</label>
                      <div id="sandbox-container">
                        <div class="input-daterange input-group">
                          <input type="text" class="form-control date datepicker" name="inicio" />
                          <span class="input-group-addon">até</span>
                          <input type="text" class="form-control date datepicker" name="fim" />
                        </div>
                      </div>
                    </div>
                  </div>

                </div>

                <button type="submit" class="btn btn-success">Buscar</button>
                <a href="{{ route('players.create') }}" class="btn btn-primary">Novo Jogador</a>
              </div>
          </form>

        </div>
      </div>
  </div>

  <div class="col-md-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Opções</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

          <a href="{{ route('matches.create') }}" class="btn btn-success">Nova Partida</a>

        </div>
      </div>
  </div>

  <div class="col-md-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Partidas</h3>
      </div>
      <div class="box-body">
        <div class="table-responsive">
          <table class="table no-margin table-hover">
            <thead>
            <tr>
              <th>ID</th>
              <th>Horário</th>
              <th>Jogadores</th>
              <th>Quadra</th>
              <th>Resultado</th>
              <th>Opções</th>
            </tr>
            </thead>
            <tbody>
              @foreach($partidas as $partida)
                <tr>
                  <td># {{ $partida->id }}</td>
                  <td><h4>{{ $partida->inicio->format('d/m/Y') }} </h4><p class="lead"><b>{{ $partida->inicio->format('H:i') }} : {{ $partida->fim->format('H:i') }}</b></p></td>

                  @php

                    $jogador1 = 'A definir';
                    $jogador2 = 'A definir';
                    $jogador1resultado = $jogador1Pontos = 0;
                    $jogador2resultado = $jogador2Pontos = 0;
                    $jogador1Uuid = '';
                    $jogador2Uuid = '';

                    $showPlacar = $editavel = false;

                    if($partida->jogador1) {
                        $jogador1 = $partida->jogador1->nome;
                        $jogador1Pontos = $partida->jogador1_pontos;
                        $jogador1resultado = $partida->jogador1_resultado_final;
                        $jogador1Uuid = $partida->jogador1->uuid;
                    }

                    if($partida->jogador2) {
                        $jogador2 = $partida->jogador2->nome;
                        $jogador2Pontos = $partida->jogador2_pontos;
                        $jogador2resultado = $partida->jogador2_resultado_final;
                        $jogador2Uuid = $partida->jogador2->uuid;
                    }

                    $editavel = true;
                    $showPlacar = true;

                  @endphp

                  <td class="text-center">

                    <div class="row">

                    @if($jogador1Uuid)

                    <div class="col-md-6">
                      <div class="box box-widget widget-user-2">

                        <div class="widget-user-header bg-aqua-active">
                          <div class="widget-user-image">
                            <img class="img-circle" src="{{ route('image', ['link'=>$partida->jogador1->avatar]) }}" alt="">
                          </div>
                          <!-- /.widget-user-image -->
                          <h3 class="widget-user-username">{{ $jogador1 }} <a class="btn btn-default" href="{{ route('player_profile', $jogador1Uuid) }}"><i class="fa fa-search"></i></a></h3>
                          <h5 class="widget-user-desc">{{ $partida->jogador1->categoria->nome }}</h5>
                          <h5 class="widget-user-desc"></h5>
                        </div>

                        <div class="box-footer">
                          <div class="row">
                            <div class="col-sm-4 border-right">
                              <div class="description-block">
                                <span class="description-text">
                                  @if($editavel)
                                        <a class="btn btn-danger" href="{{ route('remover_jogador_partida', ['id' => $partida->id, 'jogador' => $partida->jogador1->id, 'partida_admin' => '1']) }}"><i class="fa fa-trash"></i> Remover</a>
                                  @endif
                                </span>
                              </div>
                            </div>
                            <div class="col-sm-4 border-right">
                              <div class="description-block">
                                <span class="description-text">
                                  @if($editavel)
                                        <a class="btn btn-primary" href="{{ route('trocar_jogador_partida', ['id' => $partida->id, 'jogador' => $partida->jogador1->id, 'partida_admin' => '1']) }}"><i class="fa fa-refresh"></i> Trocar</a>
                                  @endif
                                </span>
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="description-block">
                                <h5 class="description-header">
                                  @if($showPlacar)
                                    {{ $jogador1Pontos }}
                                  @endif</h5>
                                <span class="description-text">Pontos</span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    @else

                      <div class="col-md-6">

                      @if($editavel)
                          <a class="btn btn-success" target="_blank" href="{{route('agendar_partida_jogador', $partida->id)}}">Selecionar Jogador 1</a>
                      @endif

                      </div>

                    @endif


                    @if($jogador2Uuid)

                      <div class="col-md-6">
                        <div class="box box-widget widget-user-2">

                          <div class="widget-user-header bg-green">
                            <div class="widget-user-image">
                              <img class="img-circle" src="{{ route('image', ['link'=>$partida->jogador2->avatar]) }}" alt="">
                            </div>
                            <!-- /.widget-user-image -->
                            <h3 class="widget-user-username">{{ $jogador2 }} <a class="btn btn-default" href="{{ route('player_profile', $jogador2Uuid) }}"><i class="fa fa-search"></i></a></h3>
                            <h5 class="widget-user-desc">{{ $partida->jogador2->categoria->nome }}</h5>
                            <h5 class="widget-user-desc"></h5>
                          </div>

                          <div class="box-footer">
                            <div class="row">
                              <div class="col-sm-4 border-right">
                                <div class="description-block">
                                  <span class="description-text">
                                    @if($editavel)
                                          <a class="btn btn-danger" href="{{ route('remover_jogador_partida', ['id' => $partida->id, 'jogador' => $partida->jogador2->id, 'partida_admin' => '1']) }}"><i class="fa fa-trash"></i> Remover</a>
                                    @endif
                                  </span>
                                </div>
                              </div>
                              <div class="col-sm-4 border-right">
                                <div class="description-block">
                                  <span class="description-text">
                                    @if($editavel)
                                          <a class="btn btn-primary" href="{{ route('trocar_jogador_partida', ['id' => $partida->id, 'jogador' => $partida->jogador2->id, 'partida_admin' => '1']) }}"><i class="fa fa-refresh"></i> Trocar</a>
                                    @endif
                                  </span>
                                </div>
                              </div>
                              <div class="col-sm-4">
                                <div class="description-block">
                                  <h5 class="description-header">
                                    @if($showPlacar)
                                      {{ $jogador2Pontos }}
                                    @endif</h5>
                                  <span class="description-text">Pontos</span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                    @else

                      <div class="col-md-6">

                        @if($editavel)
                            <a class="btn btn-success" target="_blank" href="{{route('agendar_partida_jogador', $partida->id)}}">Selecionar Jogador 2 </a>
                        @endif

                      </div>

                    @endif
                  </td>
                  <td>
                    <h4>{{ $partida->quadra->nome }}</h4>
                  </td>
                  <td>
                    <h4>{{ $jogador1resultado }} x {{ $jogador2resultado }}</h4>
                  </td>
                  <td>
                    <a class="btn btn-primary btn-sm" href="{{ route('partida_placar', $partida->id) }}"><i class="fa fa-futbol-o"></i></a>
                    <button data-route="{{ route('partida.destroy', ['id' => $partida->id]) }}" class="btn btn-sm btn-danger btnRemoveItem"><i class="fa fa-trash"></i> </button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="box-footer clearfix">
        <span class="pull-right">{{ $partidas->links() }}</span>
      </div>
    </div>
  </div>
</div>

@stop

@section('css')
@stop

@section('js')
@stop

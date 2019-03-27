@extends('adminlte::page')

@section('title', 'Partidas')

@section('content_header')
    <h1>Placar Partida</h1>
@stop

@section('content')

<div class="row">

  <form method="post" action="{{ route('partida_placar_update', $partida->id) }}">

      {{ csrf_field() }}

      <div class="col-md-12">
        <div class="box box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">Partida #{{$partida->id}}</h3>
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <p class="lead">Quadra: {{$partida->quadra->nome}}</p>
              <p class="lead"><label><input type="checkbox" name="atualizacao_manual"/> Atualização Manual</label></p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="box box-solid">
          <div class="box-body">

            <div class="box box-widget widget-user-2">

              <div class="widget-user-header bg-aqua-active">
                <div class="widget-user-image">
                  <img class="img-circle" src="{{ route('image', ['link'=>$partida->jogador1->avatar]) }}" alt="">
                </div>
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username">{{ $partida->jogador1->nome ?? '-' }}</h3>
                <h5 class="widget-user-desc">{{ $partida->jogador1->categoria->nome ?? '-' }}</h5>
                <h5 class="widget-user-desc"></h5>
              </div>

              <div class="box-footer">

              <div class="row">

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="jogador1_set1">1º SET</label>
                      <input type="number" class="form-control" id="jogador1_set1" name="jogador1_set1" value="{{ $partida->jogador1_set1 }}" min="0">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="jogador1_set1">2º SET</label>
                      <input type="number" class="form-control" id="jogador1_set2" name="jogador1_set2" value="{{ $partida->jogador1_set2 }}" min="0">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="jogador1_set1">3º SET</label>
                      <input type="number" class="form-control" id="jogador1_set3" name="jogador1_set3" value="{{ $partida->jogador1_set3 }}" min="0">
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="jogador1_resultado_final">Resultado</label>
                      <input type="number" class="form-control" id="jogador1_resultado_final" name="jogador1_resultado_final" value="{{ $partida->jogador1_resultado_final }}">
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="jogador1_tiebreak">Tiebreak</label>
                      <input type="number" class="form-control" id="jogador1_tiebreak" name="jogador1_tiebreak" value="{{ $partida->jogador1_tiebreak }}">
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="jogador1_pontos">Pontos</label>
                      <input type="number" class="form-control" id="jogador1_pontos" name="jogador1_pontos" value="{{ $partida->jogador1_pontos }}">
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="jogador1_bonus">Bonus</label>
                      <input type="number" class="form-control" id="jogador1_bonus" name="jogador1_bonus" value="{{ $partida->jogador1_bonus }}">
                    </div>
                  </div>

              </div>

              </div>
            </div>

          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="box box-solid">

          <div class="box-body">

            <div class="box box-widget widget-user-2">

              <div class="widget-user-header bg-green-active">
                <div class="widget-user-image">
                  <img class="img-circle" src="{{ route('image', ['link'=>$partida->jogador2->avatar]) }}" alt="">
                </div>
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username">{{ $partida->jogador2->nome ?? '-' }}</h3>
                <h5 class="widget-user-desc">{{ $partida->jogador2->categoria->nome ?? '-' }}</h5>
                <h5 class="widget-user-desc"></h5>
              </div>

              <div class="box-footer">

                  <div class="row">

                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="jogador2_set1">1º SET</label>
                          <input type="number" class="form-control" id="jogador2_set1" name="jogador2_set1" value="{{ $partida->jogador2_set1 }}" min="0">
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="jogador2_set2">2º SET</label>
                          <input type="number" class="form-control" id="jogador2_set2" name="jogador2_set2" value="{{ $partida->jogador2_set2 }}" min="0">
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="jogador2_set3">3º SET</label>
                          <input type="number" class="form-control" id="jogador2_set3" name="jogador2_set3" value="{{ $partida->jogador2_set3 }}" min="0">
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="jogador2_resultado_final">Resultado</label>
                          <input type="number" class="form-control" id="jogador2_resultado_final" name="jogador2_resultado_final" value="{{ $partida->jogador2_resultado_final }}">
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="jogador2_tiebreak">Tiebreak</label>
                          <input type="number" class="form-control" id="jogador2_tiebreak" name="jogador2_tiebreak" value="{{ $partida->jogador2_tiebreak }}">
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="jogador2_pontos">Pontos</label>
                          <input type="number" class="form-control" id="jogador2_pontos" name="jogador2_pontos" value="{{ $partida->jogador2_pontos }}">
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="jogador2_bonus">Bonus</label>
                          <input type="number" class="form-control" id="jogador2_bonus" name="jogador2_bonus" value="{{ $partida->jogador2_bonus }}">
                        </div>
                      </div>

                  </div>

              </div>
            </div>

          </div>
        </div>
      </div>

      <div class="col-md-12">

        <button type="submit" class="btn btn-block btn-success btn-lg">Finalizar Partida</button>

      </div>

  </form>

</div>

@stop

@section('css')
@stop

@section('js')
@stop

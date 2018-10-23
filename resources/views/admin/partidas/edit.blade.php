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

              <button type="submit" class="btn btn-success">Salvar</button>

            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="box box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">1º Jogador: {{$partida->jagador1->nome ?? ''}}</h3>
          </div>
          <div class="box-body">

              <div class="row">

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="jogador1_set1">1º SET</label>
                      <input type="number" class="form-control" id="jogador1_set1" name="jogador1_set1" value="{{ $partida->jogador1_set1 }}">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="jogador1_set1">2º SET</label>
                      <input type="number" class="form-control" id="jogador1_set2" name="jogador1_set2" value="{{ $partida->jogador1_set2 }}">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="jogador1_set1">3º SET</label>
                      <input type="number" class="form-control" id="jogador1_set3" name="jogador1_set3" value="{{ $partida->jogador1_set3 }}">
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

      <div class="col-md-6">
        <div class="box box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">2º Jogador: {{$partida->jogador2->nome ?? ''}}</h3>
          </div>
          <div class="box-body">

            <div class="row">

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="jogador2_set1">1º SET</label>
                    <input type="number" class="form-control" id="jogador2_set1" name="jogador2_set1" value="{{ $partida->jogador2_set1 }}">
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="jogador2_set2">2º SET</label>
                    <input type="number" class="form-control" id="jogador2_set2" name="jogador2_set2" value="{{ $partida->jogador2_set2 }}">
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="jogador2_set3">3º SET</label>
                    <input type="number" class="form-control" id="jogador2_set3" name="jogador2_set3" value="{{ $partida->jogador2_set3 }}">
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

  </form>

</div>

@stop

@section('css')
@stop

@section('js')
@stop

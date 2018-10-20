@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Painel Principal</h1>
@stop

@section('content')


<div class="row">

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Jogadores</span>
              <span class="info-box-number">{{ \App\Models\Pessoa\Jogador::count() }}</span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">

                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Partidas</span>
              <span class="info-box-number">{{ \App\Models\Partida::count() }}</span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">

                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa fa-calendar"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Torneios</span>
              <span class="info-box-number">{{ \App\Models\Torneio::count() }}</span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">

                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-comments-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Quadras</span>
              <span class="info-box-number">{{ \App\Models\Quadras::count() }}</span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">

                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
</div>

<div class="row">

  <div class="col-md-12">


  </div>

  <div class="col-md-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Partidas</h3>
      </div>
      <div class="box-body">
        <div class="table-responsive">
          <table class="table no-margin">
            <thead>
            <tr>
              <th></th>
              <th>Data</th>
              <th>Oponente</th>
              <th>Placar</th>
            </tr>
            </thead>
            <tbody>
              @foreach($partidas as $partida)
                <tr>
                  <td><a href="#"></a></td>
                  <td>{{ $partida->inicio->format('d/m/Y') }} <b>{{ $partida->inicio->format('H:i') }} : {{ $partida->fim->format('H:i') }}</b></td>
                  <td>{{ $partida->jogador1->nome ?? 'A definir' }} x
                    {{ $partida->jogador2->nome ?? 'A definir' }}</td>
                  <td>
                    {{ $partida->jogador1_resultado_final ?? 0 }} x {{ $partida->jogador2_resultado_final ?? 0 }}
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="box-footer clearfix">
        <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">Todas Partidas</a>
      </div>
    </div>
  </div>

</div>


@stop

@section('css')
@stop

@section('js')
@stop

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

  <div class="col-md-6">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Partidas</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="table-responsive">
          <table class="table no-margin">
            <thead>
            <tr>
              <th></th>
              <th>Data</th>
              <th>Opnente</th>
              <th>Placar</th>
            </tr>
            </thead>
            <tbody>
              @foreach($partidas as $partida)
                <tr>
                  <td><a href="#"></a></td>
                  <td>{{ $partida->data->format('d/m/Y') }} : {{ $partida->horario }}</td>
                  <td>{{ $partida->resultado->first()->jogador->pessoa->nome ?? 'A definir' }} x
                    {{ $partida->resultado->count() == 2 && $partida->resultado->last()->jogador->pessoa->nome ?? 'A definir' }}</td>
                  <td>
                    {{ $partida->resultado->first()->resultado_final ?? 0 }} x {{ $partida->resultado->last()->resultado_final ?? 0 }}
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.table-responsive -->
      </div>
      <!-- /.box-body -->
      <div class="box-footer clearfix">
        <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">Todas Partidas</a>
      </div>
      <!-- /.box-footer -->
    </div>
  </div>

</div>


@stop

@section('css')
@stop

@section('js')
@stop

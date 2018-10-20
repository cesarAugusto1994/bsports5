@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Painel do Jogador</h1>
@stop

@section('content')


<div class="row">

        <div class="col-md-4">
        <!-- Widget: user widget style 1 -->
        <div class="box box-widget widget-user">
          <!-- Add the bg color to the header using any of the bg-* classes -->
          <div class="widget-user-header bg-aqua-active">
            <h3 class="widget-user-username">{{ $jogador->nome}}</h3>
            <h5 class="widget-user-desc">{{ $jogador->categoria->nome}}</h5>
          </div>
          <div class="widget-user-image">

            <img class="profile-user-img img-responsive img-circle" alt="" src="{{ route('image', ['link'=>$jogador->avatar]) }}"/>

          </div>
          <div class="box-footer">
            <div class="row">
              <div class="col-sm-4 border-right">
                <div class="description-block">
                  <h5 class="description-header">{{ $jogador->resultados->sum('pontos') - $jogador->resultados->sum('bonus') }}</h5>
                  <span class="description-text">Pontos</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-4 border-right">
                <div class="description-block">
                  <h5 class="description-header">{{ $jogador->resultados->count() }}</h5>
                  <span class="description-text">Partidas</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-4">
                <div class="description-block">

                  @php

                        $vitorias = $jogador->resultados->filter(function($resultado) {
                            return $resultado->resultado_final >= 2;
                        })->count();

                  @endphp

                  <h5 class="description-header">{{ $vitorias }}</h5>
                  <span class="description-text">Vitórias</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
        </div>
        <!-- /.widget-user -->
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Pontos</span>
              <span class="info-box-number">{{ $jogador->resultados->sum('pontos') - $jogador->resultados->sum('bonus') }}</span>

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
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Vitórias</span>
              <span class="info-box-number">{{ $vitorias }}</span>

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
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa fa-calendar"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Partidas</span>
              <span class="info-box-number">{{ $jogador->resultados->count() }}</span>

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
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-comments-o"></i></span>

            <div class="info-box-content">

              @php

                    $derrotas = $jogador->resultados->filter(function($resultado) {
                        return $resultado->resultado_final < 2;
                    })->count();

              @endphp

              <span class="info-box-text">Derrotas</span>
              <span class="info-box-number">{{ $derrotas }}</span>

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

  <div class="col-md-6">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Partidas</h3>
      </div>
      <div class="box-body">
        @if($jogador->resultados->isNotEmpty())
        <div class="table-responsive">
          <table class="table no-margin">
            <thead>
            <tr>
              <th></th>
              <th>Data</th>
              <th>Opnente</th>
              <th>Status</th>
              <th>Placar</th>
            </tr>
            </thead>
            <tbody>
              @foreach($jogador->resultados->take(10) as $resultado)
                <tr>
                  <td><a href="#"></a></td>
                  <td>{{ $resultado->partida->inicio->format('d/m/Y H:i') }}</td>
                  <td>
                    @php

                        $resultadoPartida = $resultado->partida->resultado;

                        $jogadorAdversario = $resultadoPartida->filter(function($resultado) use ($jogador) {
                          return $resultado->jogador->id !== $jogador->id;
                        })->first();

                    @endphp

                    {{ $jogadorAdversario->jogador->nome }}</td>

                    @php

                        $label = $jogadorAdversario->pontos < $resultado->pontos ? 'Venceu' : 'Perdeu';
                        $class = $jogadorAdversario->pontos < $resultado->pontos ? 'success' : 'danger';

                    @endphp
                  <td>

                    <span class="label label-{{$class}}">{{ $label }}</span>

                  </td>
                  <td>

                    {{ $resultado->resultado_final }} x {{ $jogadorAdversario->resultado_final }}

                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @else
        <div class="alert alert-warning">Nenhuma partida encontrada!</div>
        @endif
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Histórico de Mensalidades</h3>
      </div>
      <div class="box-body">
        @if($jogador->mensalidades->isNotEmpty())
        <div class="table-responsive">
          <table class="table no-margin">
            <thead>
            <tr>
              <th>ID</th>
              <th>Mês</th>
              <th>Valor</th>
              <th>Vencimento</th>
              <th>Situação</th>
              <th>Opções</th>
            </tr>
            </thead>
            <tbody>
              @foreach($jogador->mensalidades as $mensalidade)
                <tr>
                  <td><a href="#">{{ substr($mensalidade->uuid, 0, 8) }}</a></td>
                  <td>{{ $mensalidade->mes }}</td>
                  <td>{{ number_format($mensalidade->valor, 2, ',', '.') }}</td>
                  <td>{{ ($mensalidade->vencimento->format('d/m/Y')) }}</td>
                  <td>
                    @if($mensalidade->status->id == 1)
                        <span class="label label-default">A Vencer</span>
                    @else
                        <span class="label label-success">Pago</span>
                    @endif
                  </td>
                  <td>
                    @if($mensalidade->status->id == 1)
                      <a class="btn btn-success btn-xs" href="{{ route('checkout.show', $mensalidade->uuid) }}">
                         <i class="fa fa-dollar"></i> Pagar
                      </a>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @else
        <div class="alert alert-warning">Nenhuma mensalidade encontrada!</div>
        @endif
    </div>
  </div>
</div>


@stop

@section('css')
@stop

@section('js')
@stop

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Jogador</h1>
@stop

@section('content')


<div class="row">
    <div class="col-md-3">

      <!-- Profile Image -->
      <div class="box box-primary">
        <div class="box-body box-profile">
          <img class="profile-user-img img-responsive img-circle" src="{{Gravatar::get(\Auth::user()->email)}}" alt="">

          <h3 class="profile-username text-center">{{ $jogador->pessoa->nome}}</h3>

          <p class="text-muted text-center">{{ $jogador->categoria->nome}}</p>

          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>Pontos</b> <a class="pull-right">{{ $jogador->resultados->sum('pontos') - $jogador->resultados->sum('bonus') }}</a>
            </li>
            <li class="list-group-item">
              <b>Partidas</b> <a class="pull-right">{{ $jogador->resultados->count() }}</a>
            </li>
            <li class="list-group-item">
              @php

                    $vitorias = $jogador->resultados->filter(function($resultado) {
                        return $resultado->resultado_final >= 2;
                    })->count();

              @endphp

              <b>Vitórias</b> <a class="pull-right">{{ $vitorias }}</a>
            </li>
          </ul>

          <!--<a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>-->
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      <!-- About Me Box -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Informações</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <strong><i class="fa fa-at margin-r-5"></i> Email</strong>

          <p class="text-muted">
            {{ $jogador->pessoa->email }}
          </p>

          <hr>
          <strong><i class="fa fa-book margin-r-5"></i> Lateralidade</strong>

          <p class="text-muted">
            {{ $jogador->lateralidade }}
          </p>

          <hr>

          <strong><i class="fa fa-map-marker margin-r-5"></i> Nascimento</strong>

          <p class="text-muted">{{ $jogador->pessoa->nascimento }}</p>


        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#activity" data-toggle="tab">Atividades</a></li>
          <li><a href="#timeline" data-toggle="tab">Partidas</a></li>
          <li><a href="#settings" data-toggle="tab">Configurações</a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="activity">

          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="timeline">
            <!-- The timeline -->
            <ul class="timeline timeline-inverse">
              <!-- timeline time label -->
              @forelse($jogador->resultados->take(10) as $resultado)
              <li class="time-label">
                    <span class="bg-blue">
                      {{ $resultado->partida->data->format('d/m/Y') }}
                    </span>
              </li>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <li>
                <i class="fa fa-user bg-blue"></i>

                <div class="timeline-item">
                  <span class="time"><i class="fa fa-clock-o"></i> {{ $resultado->partida->horario }}</span>

                  @php

                      $resultadoPartida = $resultado->partida->resultado;

                      $jogadorAdversario = $resultadoPartida->filter(function($resultado) use ($jogador) {
                        return $resultado->jogador->id !== $jogador->id;
                      })->first();

                  @endphp

                  <h3 class="timeline-header"><a href="{{ route('jogador', [str_slug($jogadorAdversario->jogador->pessoa->nome), $jogadorAdversario->jogador->id]) }}">{{ $jogadorAdversario->jogador->pessoa->nome }}</a></h3>

                  <div class="timeline-body">
                      Resultado: {{ $resultado->resultado_final }} x {{ $jogadorAdversario->resultado_final }}
                  </div>
                  <div class="timeline-footer">
                    @php

                        $label = $jogadorAdversario->pontos < $resultado->pontos ? 'Venceu' : 'Perdeu';

                    @endphp
                    <a class="btn btn-primary btn-xs">{{$label}}</a>
                  </div>
                </div>
              </li>
              @empty
                <div class="alert alert-info">Nenhuma Partida jogada até o momento.</div>
              @endforelse
              <!-- END timeline item -->

              <!-- END timeline item -->
              @if($jogador->resultados->isNotEmpty())
              <li>
                <i class="fa fa-clock-o bg-gray"></i>
              </li>
              @endif
            </ul>
          </div>
          <!-- /.tab-pane -->

          <div class="tab-pane" id="settings">

            @php

                $route = route('profile.update', $jogador->pessoa->id);

                if(\Auth::user()->isAdmin()) {
                  $route = route('players.update', $jogador->pessoa->id);
                }

            @endphp

            <form class="form-horizontal" method="post" action="{{ $route }}">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              <div class="form-group">
                <label for="nome" class="col-sm-2 control-label">Nome</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="nome" value="{{ $jogador->pessoa->nome }}" id="nome" placeholder="Nome">
                </div>
              </div>
              <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="email" name="email" value="{{ $jogador->pessoa->email }}" placeholder="Email">
                </div>
              </div>

              <div class="form-group">
                <label for="nascimento" class="col-sm-2 control-label">Nascimento</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control date" name="nascimento" id="nascimento" value="{{ $jogador->pessoa->nascimento->format('d/m/Y') ?? '' }}" placeholder="Nascimento">
                </div>
              </div>

              <div class="form-group">
                <label for="cpf" class="col-sm-2 control-label">CPF</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control cpf" id="cpf" name="cpf" placeholder="CPF" value="{{ $jogador->pessoa->cpf }}">
                </div>
              </div>

              <div class="form-group">
                <label for="telefone" class="col-sm-2 control-label">Telefone</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control phone" name="telefone" id="telefone" placeholder="Telefone" value="{{ $jogador->pessoa->telefone }}">
                </div>
              </div>

              <div class="form-group">
                <label for="lateralidade" class="col-sm-2 control-label">Lateralidade</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="lateralidade" value="{{ $jogador->lateralidade }}" id="lateralidade" placeholder="Lateralidade">
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value="1" {{ $jogador->ativo ? 'checked' : '' }} name="ativo"/> Ativo
                    </label>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-danger">Salvar</button>
                </div>
              </div>
            </form>
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
  </div>


@stop

@section('css')
@stop

@section('js')
<script>
  $('.cpf').mask('000.000.000-00', {reverse: true, placeholder: "___.___.___-__"});
  $('.date').mask("00/00/0000", {placeholder: "__/__/____"})
  $('.phone').mask('(00) 00000-0000');
</script>
@stop

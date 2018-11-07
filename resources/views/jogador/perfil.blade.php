@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Perfil do Jogador</h1>
@stop

@section('content')


<div class="row">
    <div class="col-md-3">

      <!-- Profile Image -->
      <div class="box box-primary">
        <div class="box-body box-profile">

          <img class="profile-user-img img-responsive img-circle" alt="" src="{{ route('image', ['link'=>$jogador->avatar]) }}"/>

          <h3 class="profile-username text-center">{{ $jogador->nome}}</h3>

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
            {{ $jogador->email }}
          </p>

          <hr>
          <strong><i class="fa fa-book margin-r-5"></i> Lateralidade</strong>

          <p class="text-muted">
            {{ $jogador->lateralidade }}
          </p>

          <hr>

          <strong><i class="fa fa-map-marker margin-r-5"></i> Nascimento</strong>

          <p class="text-muted">{{ $jogador->nascimento }}</p>


        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li><a href="#activity" data-toggle="tab">Mensalidades</a></li>
          <li><a href="#timeline" data-toggle="tab">Partidas</a></li>
          <li class="active"><a href="#settings" data-toggle="tab">Meus dados</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane" id="activity">
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
          <!-- /.tab-pane -->
          <div class="tab-pane" id="timeline">
            <!-- The timeline -->
            <ul class="timeline timeline-inverse">
              <!-- timeline time label -->
              @foreach($jogador->resultados->take(10) as $resultado)
              <li class="time-label">
                    <span class="bg-blue">
                      {{ $resultado->partida->inicio->format('d/m/Y') }}
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

                  <h3 class="timeline-header"><a href="{{ route('jogador', [str_slug($jogadorAdversario->jogador->nome), $jogadorAdversario->jogador->id]) }}">{{ $jogadorAdversario->jogador->nome }}</a></h3>

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
              @endforeach
              <!-- END timeline item -->

              <!-- END timeline item -->
              <li>
                <i class="fa fa-clock-o bg-gray"></i>
              </li>
            </ul>
          </div>
          <!-- /.tab-pane -->
          <div class="active tab-pane" id="settings">
            <form class="form-horizontal" method="post" action="{{ route('profile.update', $jogador->id) }}" enctype="multipart/form-data">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              <div class="form-group">
                <label for="nome" class="col-sm-2 control-label">Nome</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="nome" value="{{ $jogador->nome }}" id="nome" placeholder="Nome">
                </div>
              </div>
              <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="email" name="email" value="{{ $jogador->email }}" placeholder="Email">
                </div>
              </div>

              <div class="form-group">
                <label for="nascimento" class="col-sm-2 control-label">Nascimento</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control date" name="nascimento" id="nascimento" value="{{ $jogador->nascimento->format('d/m/Y') ?? '' }}" placeholder="Nascimento">
                </div>
              </div>

              <div class="form-group">
                <label for="cpf" class="col-sm-2 control-label">CPF</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control cpf" id="cpf" name="cpf" placeholder="CPF" value="{{ $jogador->cpf }}">
                </div>
              </div>

              <div class="form-group">
                <label for="telefone" class="col-sm-2 control-label">Celular</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control celphone" name="celular" id="celular" placeholder="Celular" value="{{ $jogador->celular }}">
                </div>
              </div>

              <div class="form-group">
                <label for="telefone" class="col-sm-2 control-label">Telefone</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control phone" name="telefone" id="telefone" placeholder="Telefone" value="{{ $jogador->telefone }}">
                </div>
              </div>

              <div class="form-group">
                <label for="telefone" class="col-sm-2 control-label">Avatar</label>
                <div class="col-sm-10">
                  <input type="file" class="form-control" name="avatar" id="avatar" placeholder="Avatar">
                </div>
              </div>

              <div class="form-group">
                <label for="lateralidade" class="col-sm-2 control-label">Lateralidade</label>
                <div class="col-sm-10">

                  <select name="lateralidade" class="form-control" id="lateralidade" name="lateralidade" required>
                      <option value="Destro" {{ $jogador->lateralidade == 'Destro' ? 'selected' : '' }}>Destro</option>
                      <option value="Canhoto" {{ $jogador->lateralidade == 'Canhoto' ? 'selected' : '' }}>Canhoto</option>
                  </select>

                </div>
              </div>

              <div class="form-group">
                <label for="telefone" class="col-sm-2 control-label">Nova Senha</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" name="password" id="password" placeholder="Deixe em branco caso nãoqueira atualizar a senha.">
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
  $('.celphone').mask('(00) 00000-0000');
  $('.phone').mask('(00) 0000-0000');
</script>
@stop

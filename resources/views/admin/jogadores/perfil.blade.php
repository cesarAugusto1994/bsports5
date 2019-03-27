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

          <img class="profile-user-img img-responsive img-circle" alt="" src="{{ route('image', ['link'=>$jogador->avatar]) }}"/>

          <h3 class="profile-username text-center">{{ $jogador->nome}}</h3>

          <p class="text-muted text-center">{{ $jogador->categoria->nome}}</p>

          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">

              @php

              $partidaslist=$partidaslistWeekEnd=[];

              $semestreVigente = \App\Models\Semestre::where('inicio', '<=', now()->format('Y-m-d'))
                ->where('fim', '>=', now()->format('Y-m-d'))
                ->get();

              $semestre = $semestreVigente->last();

              if(!$semestre) {
                notify()->flash('Classificação não carregada', 'error', [
                    'text' => 'Informe um semestre que esteja em vigencia.',
                ]);
                return back();
              }

              $partidas = $jogador->partidas->filter(function($partida) use ($semestre) {
                  return $partida->semestre_id == $semestre->id;
              });

              $partidas2 = $jogador->partidas2->filter(function($partida) use ($semestre) {
                  return $partida->semestre_id == $semestre->id;
              });

              foreach ($partidas as $key => $partida) {
                  $partidaslistWeekEnd[$partida->semana][] = $partida->jogador1_pontos+$partida->jogador1_bonus;
              }

              foreach ($partidas2 as $key => $partida) {
                  $partidaslistWeekEnd[$partida->semana][] = $partida->jogador2_pontos+$partida->jogador2_bonus;
              }

              $semanasPontos = [];

              foreach ($partidaslistWeekEnd as $key => $item) {
                  $semanasPontos[] = array_sum($item) / count($item);
              }

              $pontos = array_sum(array_merge($semanasPontos, $partidaslist));

              $pontos = round($pontos,2);

              $vitorias = $jogador->partidas->filter(function($partida) use ($jogador) {

                  if($partida->jogador1_id == $jogador->id) {
                    return $partida->jogador1_resultado_final >= 2;
                  } elseif ($partida->jogador2_id == $jogador->id) {
                    return $partida->jogador2_resultado_final >= 2;
                  }

              })->count();

              $vitorias2 = $jogador->partidas2->filter(function($partida) use ($jogador) {

                  if($partida->jogador1_id == $jogador->id) {
                    return $partida->jogador1_resultado_final >= 2;
                  } elseif ($partida->jogador2_id == $jogador->id) {
                    return $partida->jogador2_resultado_final >= 2;
                  }

              })->count();

              $vitorias = $vitorias+$vitorias2;

              $totalPartidas = $jogador->partidas->count() + $jogador->partidas2->count();

              @endphp

              <b>Pontos</b> <a class="pull-right">{{ $pontos }}</a>
            </li>
            <li class="list-group-item">
              <b>Partidas</b> <a class="pull-right">{{ $totalPartidas }}</a>
            </li>
            <li class="list-group-item">
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

          @php

              $Born = $jogador->nascimento;
              $Age = $Born->diff(\Carbon\Carbon::now())->format('%y Anos');

          @endphp

          <p class="text-muted">{{ $jogador->nascimento->format('d/m/Y') ?? '' }} ({{$Age}})</p>


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
          <li class="active"><a href="#settings" data-toggle="tab">Dados do Jogador</a></li>
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
                        @role('user')
                        @if($mensalidade->status->id == 1)
                          <a class="btn btn-success btn-xs" href="{{ route('checkout.show', $mensalidade->uuid) }}">
                             <i class="fa fa-dollar"></i> Pagar
                          </a>
                        @endif
                        @endrole
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

          <div class="tab-pane active" id="settings">

            @php

                $route = route('profile.update', $jogador->id);

                if(\Auth::user()->isAdmin()) {
                  $route = route('players.update', $jogador->id);
                }

            @endphp

            <form class="form-horizontal" method="post" action="{{ $route }}" enctype="multipart/form-data">
              {{ csrf_field() }}
              {{ method_field('PUT') }}

              <div class="row">

                <div class="col-md-6">

                  <div class="box box-solid">
                    <div class="box-header with-border">
                      <h3 class="box-title">Informações</h3>
                    </div>
                    <div class="box-body">

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

                    </div>
                  </div>

                </div>

                <div class="col-md-6">

                  <div class="box box-solid">
                    <div class="box-header with-border">
                      <h3 class="box-title">Contato</h3>
                    </div>
                    <div class="box-body">

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

                    </div>
                  </div>

                </div>

              </div>

              <div class="row">

                <div class="col-md-6">

                  <div class="box box-solid">
                    <div class="box-header with-border">
                      <h3 class="box-title">Endereco</h3>
                    </div>
                    <div class="box-body">

                      <div class="form-group">
                        <label for="cep" class="col-sm-2 control-label">CEP</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control cep" name="cep" data-url="{{ route('cep') }}" value="{{ $jogador->cep }}" id="cep" placeholder="">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="endereco" class="col-sm-2 control-label">Endereço</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="endereco" value="{{ $jogador->endereco }}" id="endereco" placeholder="">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="numero" class="col-sm-2 control-label">Numero</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="numero" value="{{ $jogador->numero }}" id="numero" placeholder="">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="bairro" class="col-sm-2 control-label">Bairro</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="bairro" value="{{ $jogador->bairro }}" id="bairro" placeholder="">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="cidade" class="col-sm-2 control-label">Cidade</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="cidade" value="{{ $jogador->cidade }}" id="cidade" placeholder="">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="estado" class="col-sm-2 control-label">Estado</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="estado" value="{{ $jogador->estado }}" id="estado" placeholder="">
                        </div>
                      </div>

                    </div>
                  </div>

                </div>

                <div class="col-md-6">

                  <div class="box box-solid">
                    <div class="box-header with-border">
                      <h3 class="box-title">Jogador</h3>
                    </div>
                    <div class="box-body">

                      <div class="form-group">
                        <label for="telefone" class="col-sm-2 control-label">Avatar</label>
                        <div class="col-sm-10">
                          <input type="file" class="form-control" name="avatar" id="avatar" placeholder="Avatar">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="lateralidade" class="col-sm-2 control-label">Lateralidade</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="lateralidade" value="{{ $jogador->lateralidade }}" id="lateralidade" placeholder="Lateralidade">
                        </div>
                      </div>

                      @if(\Auth::user()->isAdmin())

                      <div class="form-group">
                        <label for="categoria" class="col-sm-2 control-label">Categoria</label>
                        <div class="col-sm-10">
                          <select name="categoria" class="form-control" id="categoria" name="categoria" required>
                              @foreach($categorias as $categoria)
                                  <option value="{{ $categoria->id }}" {{ $jogador->categoria_id == $categoria->id ? 'selected' : '' }}>{{ $categoria->nome }}</option>
                              @endforeach
                          </select>
                        </div>
                      </div>

                      @endif

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
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" value="1" {{ $jogador->aluno ? 'checked' : '' }} name="aluno"/> Aluno
                            </label>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>

                </div>

              </div>

              <div class="row">

                <div class="col-md-12">

                  <div class="box box-solid">
                    <div class="box-header with-border">
                      <h3 class="box-title">Senha</h3>
                    </div>
                    <div class="box-body">

                      <div class="form-group">
                        <label for="telefone" class="col-sm-2 control-label">Nova Senha</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" name="password" id="password" placeholder="Deixe em branco caso nãoqueira atualizar a senha.">
                        </div>
                      </div>

                    </div>
                  </div>

                </div>

                <div class="col-md-12">

                  <div class="form-group">
                    <div class="col-sm-12">
                      <button type="submit" class="btn btn-danger">Salvar</button>
                    </div>
                  </div>

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
  $('.phone').mask('(00) 0000-0000');
  $('.celphone').mask('(00) 00000-0000');
</script>
@stop

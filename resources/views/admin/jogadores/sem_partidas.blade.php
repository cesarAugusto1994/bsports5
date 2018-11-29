@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Jogadores</h1>
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

                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="codigo">Periodo</label>
                      <div id="sandbox-container">
                        <div class="input-daterange input-group" id="datepicker">
                          <input type="text" class="form-control input-daterange date" name="start" value="{{ $start->format('d/m/Y') }}" />
                          <span class="input-group-addon">até</span>
                          <input type="text" class="form-control input-daterange date" name="end" value="{{ $end->format('d/m/Y') }}" />
                        </div>
                      </div>
                    </div>
                  </div>

                </div>

                <button type="submit" class="btn btn-success">Buscar</button>
              </div>
          </form>

        </div>
      </div>
  </div>

  <div class="col-md-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Jogadores ({{$quantidade}})</h3>
      </div>
      <div class="box-body">

          <div class="table-responsive">
              <table class="table no-margin">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Nome</th>
                  <th>Categoria</th>
                  <th>Email</th>
                  <th>Celular</th>
                  <th>Telefone</th>
                  <th>Pontos</th>
                  <th>Ativo</th>
                  <th>Opções</th>
                </tr>
                </thead>
                <tbody>

                  @foreach($jogadores as $jogador)
                    <tr>
                      <td>{{ $jogador->id }}</td>
                      <td><a href="{{ route('player_profile', $jogador->uuid) }}">{{ $jogador->nome }}</a></td>
                      <td>{{ $jogador->categoria->nome ?? '' }}</td>
                      <td>{{ $jogador->email }}</td>
                      <td>{{ $jogador->celular }}</td>
                      <td>{{ $jogador->telefone }}</td>
                      <td>{{ $jogador->partidas->sum('jogador1_pontos') - $jogador->partidas->sum('jogador1_bonus') +
                        $jogador->partidas2->sum('jogador2_pontos') - $jogador->partidas2->sum('jogador2_bonus') }}</td>
                      <td>
                        @if($jogador->ativo)
                        <span class="badge bg-green">Ativo</span>
                        @else
                        <span class="badge bg-red">Inativo</span>
                        @endif
                      </td>
                      <td>
                        <a href="{{ route('player_profile', $jogador->uuid) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> </a>
                        <button type="button" data-route="{{ route('jogadores.destroy', ['id' => $jogador->id]) }}" class="btn btn-sm btn-danger btnRemoveItem"><i class="fa fa-trash"></i> </button>
                      </td>
                    </tr>
                  @endforeach

                </tbody>
              </table>
            </div>

      </div>
      <div class="box-footer clearfix">

        <span class="pull-right">{{ $jogadores->links() }}</span>

      </div>
    </div>
  </div>
</div>

@stop

@section('css')
@stop

@section('js')

  <script>

      $("#selecao_jogadores_all").change(function() {

        var self = $(this);

        var itens = $(".selecao_jogadores");

        $.each(itens, function(i, item) {

          if(self.is(':checked') === true) {
              item.checked = true;
          } else {
              item.checked = false;
          }

        });

      });

  </script>

@stop

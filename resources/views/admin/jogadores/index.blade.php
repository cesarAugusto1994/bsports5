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

                  <div class="col-md-2">
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
                      <label for="email">Email</label>
                      <input type="text" class="form-control" id="email" name="email">
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="categoria">Categoria</label>
                      <select name="categoria" class="form-control" id="categoria">
                        <option value=""></option>
                          @foreach(\App\Models\Categoria::where('tipo', 'Simples')->orderBy('nome')->get() as $categoria)
                              <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="status">Status</label>
                      <select name="status" class="form-control" id="status">

                        <option value=""></option>
                        <option value="1">Ativo</option>
                        <option value="0">Inativo</option>

                      </select>
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
        <h3 class="box-title">Jogadores ({{$quantidade}})</h3>
      </div>
      <div class="box-body">

        <form method="post" action="{{ route('jogadores_inativar_em_massa') }}">

            {{csrf_field()}}

            <button type="submit" class="btn btn-danger btn-sm">Inativar</button>

            <div class="table-responsive">
              <table class="table no-margin">
                <thead>
                <tr>
                  <th><input type="checkbox" id="selecao_jogadores_all" value="1"/></th>
                  <th>ID</th>
                  <th>Nome</th>
                  <th>Categoria</th>
                  <th>Email</th>
                  <th>Pontos</th>
                  <th>Ativo</th>
                  <th>Opções</th>
                </tr>
                </thead>
                <tbody>

                  @foreach($jogadores as $jogador)
                    <tr>
                      <td><input type="checkbox" class="selecao_jogadores" name="selecao_jogadores[]" value="{{ $jogador->id }}"/></td>
                      <td>{{ $jogador->id }}</td>
                      <td><a href="{{ route('player_profile', $jogador->uuid) }}">{{ $jogador->nome }}</a></td>
                      <td>{{ $jogador->categoria->nome ?? '' }}</td>
                      <td>{{ $jogador->email }}</td>
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

        </form>

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

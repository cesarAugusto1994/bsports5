@extends('adminlte::page')

@section('title', 'Solicitação de Partidas')

@section('content')

<div class="row">

  <div class="col-md-12">
  </div>

  <div class="col-md-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Solicitação de Partidas</h3>
      </div>
      <div class="box-body">
        <div class="table-responsive">
          <table class="table no-margin">
            <thead>
            <tr>
              <th>Nome</th>
              <th>Email</th>
              <th>Telefone</th>
              <th>Data</th>
              <th>Horário</th>
            </tr>
            </thead>
            <tbody>
              @foreach($solicitacoes as $solicitacao)
                <tr>
                  <td>{{ $solicitacao->nome }}</td>
                  <td>{{ $solicitacao->email }}</td>
                  <td>{{ $solicitacao->telefone }}</td>
                  <td>{{ $solicitacao->data }}</td>
                  <td>{{ $solicitacao->horario }}</td>
                </tr>
              @endforeach

            </tbody>
          </table>
        </div>
      </div>
      <div class="box-footer clearfix">
        <span>{{ $solicitacoes->links() }}</span>
      </div>
    </div>
  </div>
</div>


@stop

@section('css')
@stop

@section('js')
@stop

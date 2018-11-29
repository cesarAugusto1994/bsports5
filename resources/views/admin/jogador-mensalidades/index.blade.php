@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Mensalidades</h1>
@stop

@section('content')

<div class="row">

  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Opções</h3>
      </div>
      <div class="box-body">

        <a href="{{ url('admin/mensalidades/create') }}" class="btn btn-success">Adicionar Mensalidade</a>
        <a href="{{ route('mensalidade_create_from_categories') }}" class="btn btn-danger">Adicionar Mensalidade Por categoria</a>

      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Histórico de Mensalidades</h3>
      </div>
      <div class="box-body">
        <div class="table-responsive">
          <table id="dataTable" class="table table-striped database-tables">
              <thead>
                  <tr>
                      <th>ID</th>
                      <th>Nome</th>
                      <th>Mês</th>
                      <th>Valor</th>
                      <th>Vencimento</th>
                      <th>Status</th>
                      <th>Referencia</th>
                      <th style="text-align:right" colspan="2"></th>
                  </tr>
              </thead>

              @foreach($mensalidades as $mensalidade)

                  <tr>

                      <td>#{{ $mensalidade->id }}</td>

                      <td>
                          <p class="name">
                              <a href="{{ route('player_profile', $mensalidade->jogador->uuid) }}">
                                 {{ $mensalidade->jogador->nome }}
                              </a>
                          </p>
                      </td>

                      <td>{{ $mensalidade->mes }}</td>
                      <td>{{ number_format($mensalidade->valor, 2, ',', '.') }}</td>
                      <td>{{ $mensalidade->vencimento->format('d/m/Y') }}</td>
                      <td>{{ $mensalidade->status->nome }}</td>
                      <td>{{ $mensalidade->referencia }}</td>

                      <td class="actions">
                        @if($mensalidade->status->id == 1)
                          <a class="btn btn-danger btn-sm pull-right delete_table btnRemoveItem"
                             data-table="{{ $mensalidade->name }}"
                             data-route="{{ route('mensalidades.destroy', $mensalidade->id) }}">
                             <i class="fa fa-trash"></i>
                          </a>
                        @endif
                          <!--<a href=""
                             class="btn btn-sm btn-primary pull-right" style="display:inline; margin-right:10px;">
                             <i class="fa fa-edit"></i>
                          </a>
                          <a href=""
                             data-name="{{ $mensalidade->name }}"
                             class="btn btn-sm btn-warning pull-right desctable" style="display:inline; margin-right:10px;">
                             <i class="fa fa-eye"></i>
                          </a>
                        -->
                      </td>
                  </tr>
              @endforeach

          </table>
          <div class="text-center">{{ $mensalidades->links() }}</div>
        </div>
      </div>
    </div>
  </div>
</div>

@stop

@section('css')
@stop

@section('js')
@stop

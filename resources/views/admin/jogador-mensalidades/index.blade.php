@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Mensalidades</h1>
@stop

@section('content')

<div class="row">

  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Histórico de Mensalidades</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="table-responsive">
          <table id="dataTable" class="table table-striped database-tables">
              <thead>
                  <tr>
                      <th>ID</th>
                      <th>Nome</th>
                      <th>Mes</th>
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
                              <a href="{{ route('jogador', [str_slug($mensalidade->jogador->pessoa->nome), $mensalidade->jogador->id]) }}">
                                 {{ $mensalidade->jogador->pessoa->nome }}
                              </a>
                          </p>
                      </td>

                      <td>{{ $mensalidade->mes }}</td>
                      <td>{{ $mensalidade->vencimento->format('d/m/Y') }}</td>
                      <td>{{ $mensalidade->status->nome }}</td>
                      <td>{{ $mensalidade->referencia }}</td>

                      <td class="actions">
                          <a class="btn btn-danger btn-sm pull-right delete_table"
                             data-table="{{ $mensalidade->name }}">
                             <i class="fa fa-trash"></i>
                          </a>
                          <a href=""
                             class="btn btn-sm btn-primary pull-right" style="display:inline; margin-right:10px;">
                             <i class="fa fa-edit"></i>
                          </a>
                          <a href=""
                             data-name="{{ $mensalidade->name }}"
                             class="btn btn-sm btn-warning pull-right desctable" style="display:inline; margin-right:10px;">
                             <i class="fa fa-eye"></i>
                          </a>
                      </td>
                  </tr>
              @endforeach

          </table>

          <div class="text-center">{{ $mensalidades->links() }}</div>
        </div>
        <!-- /.table-responsive -->
      </div>
      <!-- /.box-body -->
      <div class="box-footer clearfix">
        <a href="{{ url('admin/mensalidades/create') }}" class="btn btn-sm btn-info btn-flat pull-left">Adicionar Mensalidade</a>
        <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">Todas Mensalidades</a>
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

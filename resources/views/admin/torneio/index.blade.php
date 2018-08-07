@extends('adminlte::page')

@section('title', 'Torneios')

@section('content_header')
    <h1>Torneios</h1>
@stop

@section('content')

<div class="row">

  <div class="col-md-12">
  </div>

  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Torneios</h3>

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
              <th>ID</th>
              <th>Nome</th>
              <th>Valor</th>
              <th>Ativo</th>
              <th>Opções</th>
            </tr>
            </thead>
            <tbody>
              @foreach($torneios as $torneio)
                <tr>
                  <td><a href="#">{{ $torneio->id }}</a></td>
                  <td>{{ $torneio->nome }}</td>
                  <td>{{ number_format($torneio->valor, 2) }}</td>
                  <td>{{ $torneio->ativo ? 'Ativo' : 'Inativo' }}</td>
                  <td>
                    <a href="{{ route('torneios.edit', $torneio->id) }}" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Editar</a>
                    <form style="display:inline-block" method="post" action="{{ route('torneios.destroy', ['id' => $torneio->id]) }}">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Remover</button>
                    </form>
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
        <a href="{{ route('torneios.create') }}" class="btn btn-sm btn-info btn-flat pull-left">Novo Torneio</a>
        <span class="pull-right">{{ $torneios->links() }}</span>
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

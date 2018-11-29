@extends('adminlte::page')

@section('title', 'Torneios')

@section('content_header')
    <h1>Torneios</h1>
@stop

@section('content')

<div class="row">

  <div class="col-md-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Opções</h3>
      </div>
      <div class="box-body">
          <a href="{{ route('torneios.create') }}" class="btn btn-success">Novo Torneio</a>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Lista</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="table-responsive">
          <table class="table no-margin table-bordered table-striped">
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
                    <a href="{{ route('torneios.edit', $torneio->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i> </a>
                    <form style="display:inline-block" method="post" action="{{ route('torneios.destroy', ['id' => $torneio->id]) }}">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button class="btn btn-danger"><i class="fa fa-trash"></i> </button>
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

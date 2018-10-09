@extends('adminlte::page')

@section('title', 'Eventos')

@section('content_header')
    <h1>Eventos</h1>
@stop

@section('content')

<div class="row">

  <div class="col-md-12">

    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Eventos</h3>
      </div>
      <div class="box-body">
          <a href="{{ route('eventos.create') }}" class="btn btn-sm btn-success">Novo Evento</a>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Eventos</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="table-responsive">
          <table class="table no-margin">
            <thead>
            <tr>
              <th>ID</th>
              <th>Titulo</th>
              <th>Conteúdo</th>
              <th style="width:100px">Ativo</th>
              <th style="width:200px">Opções</th>
            </tr>
            </thead>
            <tbody>
              @foreach($eventos as $evento)
                <tr>
                  <td>{{ $evento->id }}</td>
                  <td>{{ $evento->titulo }}</td>
                  <td>{{ $evento->conteudo }}</td>
                  <td>{{ $evento->ativo ? 'Ativo' : 'Inativo' }}</td>
                  <td>
                    <a href="{{ route('eventos.edit', $evento->id) }}" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Editar</a>
                    <form style="display:inline-block" method="post" action="{{ route('eventos.destroy', ['id' => $evento->id]) }}">
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

        <span class="pull-right">{{ $eventos->links() }}</span>
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

@extends('adminlte::page')

@section('title', 'Categorias')

@section('content_header')
    <h1>Categorias</h1>
@stop

@section('content')

<div class="row">

  <div class="col-md-12">
  </div>

  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Categorias</h3>

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
              <th>Tipo</th>
              <th>Opções</th>
            </tr>
            </thead>
            <tbody>
              @foreach($categorias as $categoria)
                <tr>
                  <td><a href="#">{{ $categoria->id }}</a></td>
                  <td>{{ $categoria->nome }}</td>
                  <td>{{ $categoria->tipo }}</td>
                  <td>
                    <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Editar</a>
                    @if($categoria->menu->isEmpty())
                    <a href="?adicionar-menu={{ $categoria->id }}" class="btn btn-xs btn-success"><i class="fa fa-check"></i> Adicionar ao Menu</a>
                    @else
                    <a href="?adicionar-menu={{ $categoria->id }}" class="btn btn-xs btn-warning"><i class="fa fa-trash"></i> Remover do Menu</a>
                    @endif
                    <form style="display:inline-block" method="post" action="{{ route('categorias.destroy', ['id' => $categoria->id]) }}">
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
        <a href="{{ route('categorias.create') }}" class="btn btn-sm btn-info btn-flat pull-left">Nova Categoria</a>
        <span class="pull-right">{{ $categorias->links() }}</span>
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

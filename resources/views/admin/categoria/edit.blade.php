@extends('adminlte::page')

@section('title', 'Categorias')

@section('content_header')
    <h1>Editar Categoria</h1>
@stop

@section('content')

<div class="row">

  <div class="col-md-12">
  </div>

  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Editar Categoria</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>

      <form class="form-horizontal" method="post" action="{{ route('categorias.update', $categoria->id) }}">
        <!-- /.box-header -->
        <div class="box-body">

          {{ method_field('PUT') }}
          {{ csrf_field() }}

          <div class="form-group">
            <label for="nome" class="col-sm-2 control-label">Nome</label>

            <div class="col-sm-10">
              <input type="text" class="form-control" value="{{ $categoria->nome }}" name="nome" id="nome" placeholder="Nome">
            </div>
          </div>
          <div class="form-group">
            <label for="tipo" class="col-sm-2 control-label">Tipo</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="tipo" value="{{ $categoria->tipo }}" placeholder="Tipo">
            </div>
          </div>

        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <button type="submit" class="btn btn-sm btn-info btn-flat pull-left">Salvar</button>
        </div>
      </form>
      <!-- /.box-footer -->
    </div>
  </div>
</div>


@stop

@section('css')
@stop

@section('js')
@stop

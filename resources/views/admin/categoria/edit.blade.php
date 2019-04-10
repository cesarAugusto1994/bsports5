@extends('adminlte::page')

@section('title', 'Categorias')

@section('content')

<div class="row">

  <div class="col-md-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Editar Categoria</h3>
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
            <label for="nome" class="col-sm-2 control-label">Ativo</label>

            <div class="col-sm-10">
              <input type="checkbox" {{ $categoria->ativo ? 'checked' : '' }} value="{{ $categoria->ativo }}" name="ativo" id="ativo" placeholder="Ativo">
            </div>
          </div>

        </div>
        <div class="box-footer clearfix">
          <button type="submit" class="btn btn-sm btn-success">Salvar</button>
          <a href="{{ route('categorias.index') }}" class="btn btn-sm btn-white">Cancelar</a>
        </div>
      </form>
    </div>
  </div>
</div>


@stop

@section('css')
@stop

@section('js')
@stop

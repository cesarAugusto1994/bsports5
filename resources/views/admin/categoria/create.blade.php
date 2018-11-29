@extends('adminlte::page')

@section('title', 'Categorias')

@section('content')

<div class="row">

  <div class="col-md-12">
  </div>

  <div class="col-md-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Nova Categoria</h3>
      </div>

      <form class="form-horizontal" method="post" action="{{ route('categorias.store') }}">
        <div class="box-body">

          {{ csrf_field() }}

          <div class="form-group">
            <label for="nome" class="col-sm-2 control-label">Nome</label>

            <div class="col-sm-10">
              <input type="text" class="form-control" value="" name="nome" id="nome" placeholder="Nome">
            </div>
          </div>

        </div>
        <div class="box-footer clearfix">
          <button type="submit" class="btn btn-sm btn-info btn-flat pull-left">Salvar</button>
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

@extends('adminlte::page')

@section('title', 'Quadras')

@section('content_header')
    <h1>Nova Quadra</h1>
@stop

@section('content')

<div class="row">

  <div class="col-md-12">
  </div>

  <div class="col-md-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Nova Quadra</h3>
      </div>

      <form class="form-horizontal" method="post" action="{{ route('quadras.store') }}">
        <!-- /.box-header -->
        <div class="box-body">

          {{ csrf_field() }}

          <div class="form-group">
            <label for="nome" class="col-sm-2 control-label">Nome</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" value="" name="nome" id="nome" required>
            </div>
          </div>

          <div class="form-group">
            <label for="nome" class="col-sm-2 control-label">Cor</label>
            <div class="col-sm-10">
              <input type="color" class="form-control" value="" name="cor" id="cor" required>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <div class="checkbox">
                <label>
                  <input type="checkbox" value="1" checked name="ativo"/> Ativo
                </label>
              </div>
            </div>
          </div>

        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <button type="submit" class="btn btn-sm btn-success pull-left">Salvar</button>
        </div>
      </form>
      <!-- /.box-footer -->
    </div>
  </div>
</div>
@stop

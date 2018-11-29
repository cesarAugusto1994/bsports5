@extends('adminlte::page')

@section('title', 'Configurações')


@section('content')

<div class="row">

  <div class="col-md-12">
  </div>

  <div class="col-md-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Editar Configuração</h3>
      </div>

      <form class="form-horizontal" method="post" action="{{ route('configs.update', $config->id) }}">
        <!-- /.box-header -->
        <div class="box-body">

          {{ method_field('PUT') }}
          {{ csrf_field() }}

          <div class="form-group">
            <label for="key" class="col-sm-2 control-label">Nome</label>
            <div class="col-sm-10">
              <input type="text" disabled class="form-control" value="{{ $config->nome }}" name="nome" id="nome" placeholder="Nome">
            </div>
          </div>
          <div class="form-group">
            <label for="key" class="col-sm-2 control-label">Descrição</label>
            <div class="col-sm-10">
              <input type="text" disabled class="form-control" value="{{ $config->descricao }}" name="descricao" id="descricao" placeholder="Descrição">
            </div>
          </div>
          <div class="form-group">
            <label for="partidas" class="col-sm-2 control-label">Valor</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="valor" name="valor" value="{{ $config->valor }}" placeholder="Valor">
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

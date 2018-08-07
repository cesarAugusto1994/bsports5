@extends('adminlte::page')

@section('title', 'Torneio')

@section('content_header')
    <h1>Novo torneio</h1>
@stop

@section('content')

<div class="row">

  <div class="col-md-12">
  </div>

  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Novo torneio</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>

      <form class="form-horizontal" method="post" action="{{ route('torneios.store') }}">
        <!-- /.box-header -->
        <div class="box-body">

          {{ csrf_field() }}

          <div class="form-group">
            <label for="nome" class="col-sm-2 control-label">Nome</label>

            <div class="col-sm-10">
              <input type="text" class="form-control" value="" name="nome" id="nome" placeholder="Nome" required>
            </div>
          </div>
          <div class="form-group">
            <label for="partidas" class="col-sm-2 control-label">Partidas</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="partidas" name="partidas" value="" placeholder="Partidas" required>
            </div>
          </div>
          <div class="form-group">
            <label for="valor" class="col-sm-2 control-label">Valor</label>
            <div class="col-sm-10">
              <input type="text" class="form-control money" id="valor" name="valor" value="" placeholder="Valor" required>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <div class="checkbox">
                <label>
                  <input type="checkbox" value="1" name="ativo"/> Ativo
                </label>
              </div>
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
<script>
    $('.money').mask('000.000.000.000.000,00', {reverse: true})
</script>
@stop

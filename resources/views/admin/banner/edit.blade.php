@extends('adminlte::page')

@section('title', 'Torneios')

@section('content_header')
    <h1>Editar Torneio</h1>
@stop

@section('content')

<div class="row">

  <div class="col-md-12">
  </div>

  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Editar Torneio</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>

      <form class="form-horizontal" method="post" action="{{ route('torneios.update', $torneio->id) }}">
        <!-- /.box-header -->
        <div class="box-body">

          {{ method_field('PUT') }}
          {{ csrf_field() }}

          <div class="form-group">
            <label for="nome" class="col-sm-2 control-label">Nome</label>

            <div class="col-sm-10">
              <input type="text" class="form-control" value="{{ $torneio->nome }}" name="nome" id="nome" placeholder="Nome">
            </div>
          </div>
          <div class="form-group">
            <label for="partidas" class="col-sm-2 control-label">Partidas</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="partidas" name="partidas" value="{{ $torneio->partidas }}" placeholder="Partidas" required>
            </div>
          </div>
          <div class="form-group">
            <label for="valor" class="col-sm-2 control-label">Valor</label>
            <div class="col-sm-10">
              <input type="text" class="form-control money" id="valor" name="valor" value="{{ number_format($torneio->valor, 2) }}" placeholder="Tipo">
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <div class="checkbox">
                <label>
                  <input type="checkbox" value="1" {{ $torneio->ativo ? 'checked' : '' }} name="ativo"/> Ativo
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

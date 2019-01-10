@extends('adminlte::page')

@section('title', 'Mídias')

@section('content')

<div class="row">

  <div class="col-md-12">
  </div>

  <div class="col-md-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Novo Semestre</h3>
      </div>

      <form class="form-horizontal" method="post" action="{{ route('semestres.store') }}">
        <!-- /.box-header -->
        <div class="box-body">

          {{ csrf_field() }}

          <div class="form-group">
            <label for="nome" class="col-sm-2 control-label">Titulo</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="titulo" id="titulo" placeholder="1º Semestre do Ano XXXX" required>
            </div>
          </div>

          <div class="form-group">
            <label for="nascimento" class="col-sm-2 control-label">Início</label>
            <div class="col-sm-10">
              <input type="text" class="form-control date datepicker" name="inicio" id="inicio" value="" placeholder="Início do Periodo" required>
            </div>
          </div>

          <div class="form-group">
            <label for="nascimento" class="col-sm-2 control-label">Fim</label>
            <div class="col-sm-10">
              <input type="text" class="form-control date datepicker" name="fim" id="fim" value="" placeholder="Fim do Periodo" required>
            </div>
          </div>

        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <button type="submit" class="btn btn-sm btn-success">Salvar</button>
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

</script>
@stop

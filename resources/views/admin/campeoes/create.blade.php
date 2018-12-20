@extends('adminlte::page')

@section('title', 'Campeões')

@section('content')

<div class="row">

  <div class="col-md-12">
  </div>

  <div class="col-md-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Novo Campeão</h3>
      </div>

      <form class="form-horizontal" method="post" action="{{ route('campeoes.store') }}" enctype="multipart/form-data">

        <div class="box-body">

          {{ csrf_field() }}

          <div class="form-group">
            <label for="nome" class="col-sm-2 control-label">Titulo</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Titulo" required>
            </div>
          </div>

          <div class="form-group">
            <label for="nome" class="col-sm-2 control-label">Descrição</label>
            <div class="col-sm-10">
              <textarea class="form-control" name="descricao" rows="3"></textarea>
            </div>
          </div>

          <div class="form-group">
            <label for="partidas" class="col-sm-2 control-label">Imagem</label>
            <div class="col-sm-10">
              <input type="file" class="form-control" name="imagem" multiple placeholder="Banner">
            </div>
          </div>

        </div>
        <div class="box-footer clearfix">
          <button type="submit" class="btn btn-sm btn-success">Salvar</button>
        </div>
      </form>
    </div>
  </div>
</div>


@stop

@section('css')
@stop

@section('js')
<script>
    $(document).ready(function() {

        var tipo = $("#tipo");
        var files = $("#files");
        var link = $("#link");

        if(tipo.val() == 'imagem') {
            link.hide();
        }

        tipo.click(function() {

          if(tipo.val() == 'imagem') {
              link.hide();
              files.show();
          } else {
              link.show();
              files.hide();
          }

        });

    });
</script>
@stop

@extends('adminlte::page')

@section('title', 'Mídias')

@section('content')

<div class="row">

  <div class="col-md-12">
  </div>

  <div class="col-md-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Nova Mídia</h3>
      </div>

      <form class="form-horizontal" method="post" action="{{ route('midias.store') }}" enctype="multipart/form-data">
        <!-- /.box-header -->
        <div class="box-body">

          {{ csrf_field() }}

          <div class="form-group">
            <label for="nome" class="col-sm-2 control-label">Tipo</label>
            <div class="col-sm-10">
              <select class="form-control" name="tipo" id="tipo">
                  <option value="imagem">Imagem</option>
                  <option value="video">Video</option>
                  <option value="link">Link</option>
              </select>
            </div>
          </div>

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

          <div class="form-group" id="files">
            <label for="partidas" class="col-sm-2 control-label">Anexos</label>
            <div class="col-sm-10">
              <input type="file" class="form-control" name="files[]" multiple placeholder="Banner">
            </div>
          </div>

          <div class="form-group" id="link">
            <label for="partidas" class="col-sm-2 control-label">Link</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="link" value="" placeholder="Link">
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <div class="checkbox">
                <label>
                  <input type="checkbox" value="1" name="ativo" checked/> Ativo
                </label>
              </div>
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

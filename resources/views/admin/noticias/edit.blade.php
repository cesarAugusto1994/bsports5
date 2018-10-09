@extends('adminlte::page')

@section('title', 'Noticias')

@section('content_header')
    <h1>Editar Noticia</h1>
@stop

@section('content')

<div class="row">

  <div class="col-md-12">
  </div>

  <div class="col-md-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Editar Noticia</h3>
      </div>

      <form class="form-horizontal" method="post" action="{{ route('noticias.update', $noticia->id) }}" enctype="multipart/form-data">
        <!-- /.box-header -->
        <div class="box-body">

          {{ method_field('PUT') }}
          {{ csrf_field() }}

          <div class="form-group">
            <label for="nome" class="col-sm-2 control-label">Titulo</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" value="{{ $noticia->titulo }}" name="titulo" id="titulo" placeholder="Titulo" required>
            </div>
          </div>

          <div class="form-group">
            <label for="nome" class="col-sm-2 control-label">Texto</label>
            <div class="col-sm-10">
              <textarea class="form-control" name="conteudo" rows="8">{{ $noticia->conteudo }}</textarea>
            </div>
          </div>

          <div class="form-group">
            <label for="partidas" class="col-sm-2 control-label">Banner</label>
            <div class="col-sm-10">
              <input type="file" class="form-control" id="banner" name="banner" value="" placeholder="Banner">
            </div>
          </div>

          <div class="form-group">
            <label for="partidas" class="col-sm-2 control-label">Link</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="link" name="link" value="{{ $noticia->link }}" placeholder="Link">
            </div>
          </div>

          <div class="form-group">
            <label for="partidas" class="col-sm-2 control-label">Video</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="video" name="video" value="{{ $noticia->video }}" placeholder="Video">
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <div class="checkbox">
                <label>
                  <input type="checkbox" value="1" {{ $noticia->ativo ? 'checked' : '' }} name="ativo"/> Ativo
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

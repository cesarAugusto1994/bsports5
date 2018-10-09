@extends('adminlte::page')

@section('title', 'Noticias')

@section('content_header')
    <h1>Noticias</h1>
@stop

@section('content')

<div class="row">

  <div class="col-md-12">

    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Noticias</h3>
      </div>
      <div class="box-body">
          <a href="{{ route('noticias.create') }}" class="btn btn-sm btn-success">Nova Noticia</a>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Noticias</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="table-responsive">
          <table class="table no-margin">
            <thead>
            <tr>
              <th>ID</th>
              <th>Titulo</th>
              <th>Conteúdo</th>
              <th style="width:100px">Ativo</th>
              <th style="width:200px">Opções</th>
            </tr>
            </thead>
            <tbody>
              @foreach($noticias as $noticia)
                <tr>
                  <td>{{ $noticia->id }}</td>
                  <td>{{ $noticia->titulo }}</td>
                  <td>{{ $noticia->conteudo }}</td>
                  <td>{{ $noticia->ativo ? 'Ativo' : 'Inativo' }}</td>
                  <td>
                    <a href="{{ route('noticias.edit', $noticia->id) }}" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Editar</a>
                    <form style="display:inline-block" method="post" action="{{ route('noticias.destroy', ['id' => $noticia->id]) }}">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Remover</button>
                    </form>
                  </td>
                </tr>
              @endforeach

            </tbody>
          </table>
        </div>
        <!-- /.table-responsive -->
      </div>
      <!-- /.box-body -->
      <div class="box-footer clearfix">

        <span class="pull-right">{{ $noticias->links() }}</span>
      </div>
      <!-- /.box-footer -->
    </div>
  </div>
</div>


@stop

@section('css')
@stop

@section('js')
@stop

@extends('adminlte::page')

@section('title', 'Mídias')

@section('content_header')
    <h1>Mídias</h1>
@stop

@section('content')

<div class="row">

  <div class="col-md-12">

    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Opções</h3>
      </div>
      <div class="box-body">
          <a href="{{ route('midias.create') }}" class="btn btn-sm btn-success">Nova Mídia</a>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Mídias</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="table-responsive">
          <table class="table no-margin">
            <thead>
            <tr>
              <th>Tipo</th>
              <th>Titulo</th>
              <th>Conteúdo</th>
              <th style="width:100px">Ativo</th>
              <th style="width:200px">Opções</th>
            </tr>
            </thead>
            <tbody>
              @foreach($midias as $midia)
                <tr>
                  <td>{{ $midia->tipo }}</td>
                  <td>{{ $midia->titulo }}</td>
                  <td>{{ $midia->descricao }}</td>
                  <td>{{ $midia->ativo ? 'Ativo' : 'Inativo' }}</td>
                  <td>
                    <button type="button" data-route="{{ route('midias.destroy', ['id' => $midia->id]) }}" class="btn btn-sm btn-danger btnRemoveItem"><i class="fa fa-trash"></i> </button>
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

        <span class="pull-right">{{ $midias->links() }}</span>
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

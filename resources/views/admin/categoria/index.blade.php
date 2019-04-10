@extends('adminlte::page')

@section('title', 'Categorias')

@section('content_header')
    <h1>Categorias</h1>
@stop

@section('content')

<div class="row">

  <div class="col-md-12">
  </div>
<!--
  <div class="col-md-12">

    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Opções</h3>
      </div>
      <div class="box-body">
          <a href="{{ route('categorias.create') }}" class="btn btn-sm btn-success">Nova Categoria</a>
      </div>
    </div>
  </div>
-->
  <div class="col-md-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Lista</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="table-responsive">
          <table class="table no-margin table-bordered table-hover">
            <thead>
            <tr>
              <th>Nome</th>
              <th>Ativo</th>
              <th style="width:250px">Opções</th>
            </tr>
            </thead>
            <tbody>
              @foreach($categorias as $categoria)
                <tr class="{{ $categoria->ativo ? '' : 'danger' }}">
                  <td>{{ $categoria->nome }}</td>
                  <td>{{ $categoria->ativo ? 'Ativo' : 'Inativo' }}</td>
                  <td>

                    <form style="display:inline-block" method="post" action="{{ route('categoria_to_menu', ['id' => $categoria->id]) }}">

                        {{ csrf_field() }}

                        @if(!$categoria->habilitar_menu == true)
                            <button class="btn btn-sm btn-success"><i class="fa fa-check"></i> Adicionar ao Menu</button>
                        @else
                            <button class="btn btn-sm btn-warning"><i class="fa fa-trash"></i> Remover do Menu</button>
                        @endif

                    </form>

                    <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> </a>
                    <form style="display:inline-block" method="post" action="{{ route('categorias.destroy', ['id' => $categoria->id]) }}">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> </button>
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

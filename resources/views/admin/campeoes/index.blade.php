@extends('adminlte::page')

@section('title', 'Campeões')

@section('content_header')
    <h1>Campeões</h1>
@stop

@section('content')

<div class="row">

  <div class="col-md-12">

    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Opções</h3>
      </div>
      <div class="box-body">
          <a href="{{ route('campeoes.create') }}" class="btn btn-sm btn-success">Adicionar</a>
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
              <th>Imagem</th>
              <th>Titulo</th>
              <th>Descrição</th>
              <th style="width:200px">Opções</th>
            </tr>
            </thead>
            <tbody>
              @foreach($campeoes as $campeao)
                <tr>
                  <td><img width="64" src="{{ route('image', ['link'=>$campeao->imagem]) }}" alt="" /></td>
                  <td>{{ $campeao->titulo }}</td>
                  <td>{{ $campeao->descricao }}</td>
                  <td>
                    <button type="button" data-route="{{ route('campeoes.destroy', ['id' => $campeao->id]) }}" class="btn btn-sm btn-danger btnRemoveItem"><i class="fa fa-trash"></i> </button>
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

        <span class="pull-right">{{ $campeoes->links() }}</span>
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

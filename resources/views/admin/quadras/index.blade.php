@extends('adminlte::page')

@section('title', 'Quadras')

@section('content_header')
    <h1>Quadras</h1>
@stop

@section('content')

<div class="row">

  <div class="col-md-12">

    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Opções</h3>
      </div>
      <div class="box-body">
          <a href="{{ route('quadras.create') }}" class="btn btn-sm btn-success pull-left">Nova Quadra</a>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Quadras</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="table-responsive">
          <table class="table no-margin">
            <thead>
            <tr>
              <th>Nome</th>
              <th style="width:80px">Cor</th>
              <th style="width:80px">Ativo</th>
              <th style="width:100px">Opções</th>
            </tr>
            </thead>
            <tbody>
              @foreach($quadras as $quadra)
                <tr>
                  <td>{{ $quadra->nome }}</td>
                  <td style="background-color:{{ $quadra->cor }}"></td>
                  <td>{{ $quadra->ativo ? 'Ativo' : 'Inativo' }}</td>
                  <td>
                    <a href="{{ route('quadras.edit', $quadra->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                    <form style="display:inline-block" method="post" action="{{ route('quadras.destroy', ['id' => $quadra->id]) }}">
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

        <span class="pull-right">{{ $quadras->links() }}</span>
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

@extends('adminlte::page')

@section('title', 'Semestres')

@section('content_header')
    <h1>Semestres</h1>
@stop

@section('content')

<div class="row">

  <div class="col-md-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Opções</h3>
      </div>
      <div class="box-body">
          <a href="{{ route('semestres.create') }}" class="btn btn-sm btn-success">Novo Semestre</a>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Semestres</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="table-responsive">
          <table class="table no-margin">
            <thead>
            <tr>
              <th>Titulo</th>
              <th>Início</th>
              <th>Fim</th>
              <th>Opções</th>
            </tr>
            </thead>
            <tbody>
              @foreach($semestres as $semestre)
                <tr>
                  <td>{{ $semestre->titulo }}</td>
                  <td>{{ $semestre->inicio->format('d/m/Y') }}</td>
                  <td>{{ $semestre->fim->format('d/m/Y') }}</td>
                  <td>
                    <button type="button" data-route="{{ route('semestres.destroy', ['id' => $semestre->id]) }}" class="btn btn-sm btn-danger btnRemoveItem"><i class="fa fa-trash"></i> </button>
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

        <span class="pull-right">{{ $semestres->links() }}</span>
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

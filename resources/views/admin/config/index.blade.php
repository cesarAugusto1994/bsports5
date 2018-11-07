@extends('adminlte::page')

@section('title', 'Configurações')

@section('content_header')
    <h1>Configurações</h1>
@stop

@section('content')

<div class="row">

  <div class="col-md-12">
  </div>

  <div class="col-md-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Configurações</h3>
      </div>
      <div class="box-body">
        <div class="table-responsive">
          <table class="table no-margin">
            <thead>
            <tr>
              <th>Chave</th>
              <th>Valor</th>
              <th>Opções</th>
            </tr>
            </thead>
            <tbody>
              @foreach($configs as $config)
                <tr>
                  <td>{{ $config->key }}</td>
                  <td>{{ $config->value }}</td>
                  <td>
                    <a href="{{ route('configs.edit', $config->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> </a>
                  </td>
                </tr>
              @endforeach

            </tbody>
          </table>
        </div>
      </div>
      <div class="box-footer clearfix">
        <span>{{ $configs->links() }}</span>
      </div>
    </div>
  </div>
</div>


@stop

@section('css')
@stop

@section('js')
@stop

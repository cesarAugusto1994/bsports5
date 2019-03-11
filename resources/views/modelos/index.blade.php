@extends('adminlte::page')

@section('title', 'Modelos')

@section('content_header')
    <h1>Painel de Modelos</h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> Painel Principal</a></li>
      <li class="active">Modelos</li>
    </ol>
@stop

@section('content')

  <div class="row">

    <div class="col-md-12">
      <div class="box box-solid">

          <div class="box-header with-border">
              <h3 class="box-title">Modelos</h3>
          </div>

          <div class="box-body">
              <a href="{{ route('modelos.create') }}" class="btn btn-success">Novo Modelo</a>
          </div>

      </div>
    </div>

    @if(\Request::has('chamado'))
    <div class="col-md-12">
      <div class="box box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">Gerar Propaganda para o chamado #{{ \Request::get('chamado') }}</h3>
          </div>
          <div class="box-body">
            @php
                $chamado = \App\Models\Chamados::findOrFail(\Request::get('chamado'));
            @endphp

            @foreach($chamado->empreendimentos as $item)
              <h3>{{ $item->empreendimento->nome }}</h3>
            @endforeach
          </div>
      </div>
    </div>
    @endif

    <div class="col-md-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Lista Modelos</h3>
        </div>
        <div class="box-body table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Template</th>
                <th style="width:100px">Opções</th>
              </tr>
            </thead>
            <tbody>
            @forelse($modelos as $modelo)
                <tr>
                  <td>{{ $modelo->id }}</td>
                  <td>{{ $modelo->nome }}</td>
                  <td>{{ $modelo->template->nome }}</td>
                  <td>{{ $modelo->arquivo }}</td>
                  <td>
                    @if(\Request::has('chamado'))
                        <a class="btn btn-primary" href="{{ route('modelos.show', ['id'=>$modelo->id,'chamado'=>\Request::get('chamado')]) }}"><i class="fa fa-cog"></i> </a>
                    @else
                        <a class="btn btn-primary" href="{{ route('modelos.show', ['id'=>$modelo->id]) }}"><i class="fa fa-cog"></i> </a>
                    @endif

                    <a class="btn btn-info" href="{{ route('modelos.edit', $modelo->id) }}"><i class="fa fa-edit"></i> </a>
                    <a class="btn btn-danger btnRemoveItem" data-route="{{ route('modelos.destroy', $modelo->id) }}"><i class="fa fa-trash"></i> </a>
                  </td>
                </tr>
            @empty
                <tr>
                  <td colspan="20">
                    <div class="alert alert-warning text-center">
                      <p>Nenhum registro encontrado.</p>
                    </div>
                  </td>
                </tr>
            @endforelse
            </tbody>
          </table>
        </div>
        <div class="box-footer clearfix">
          {{ $modelos->links() }}
        </div>
      </div>
    </div>
  </div>

@stop

@section('js')
    <script src="{{ asset('js/custom.js') }}"></script>
@stop

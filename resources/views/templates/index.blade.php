@extends('adminlte::page')

@section('title', 'Templates')

@section('content_header')
    <h1>Painel de Templates</h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> Painel Principal</a></li>
      <li class="active">Templates</li>
    </ol>
@stop

@section('content')

  <div class="row">

    <div class="col-md-12">
      <div class="box box-solid">

          <div class="box-header with-border">
            <h3 class="box-title">Templates</h3>
          </div>

          <div class="box-body">

            <a href="{{ route('templates.create') }}" class="btn btn-success">Novo Template</a>

          </div>

      </div>
    </div>

    <div class="col-md-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Lista Templates</h3>
        </div>
        <div class="box-body table-responsive">

          <table class="table table-hover">
            <thead>

              <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Arquivo</th>
                <th>Opções</th>
              </tr>

            </thead>
            <tbody>

              @forelse($templates as $template)
                  <tr>
                    <td>{{ $template->id }}</td>
                    <td>{{ $template->nome }}</td>
                    <td>{{ $template->arquivo }}</td>
                    <td>

                      <a class="btn btn-info" href="{{ route('templates.edit', $template->id) }}"><i class="fa fa-edit"></i> </a>
                      <a class="btn btn-danger btnRemoveItem" data-route="{{ route('templates.destroy', $template->id) }}"><i class="fa fa-trash"></i> </a>

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
          </tbody></table>
        </div>
        <div class="box-footer clearfix">
          {{ $templates->links() }}
        </div>
      </div>
    </div>
  </div>

@stop

@section('js')
    <script src="{{ asset('js/custom.js') }}"></script>
@stop

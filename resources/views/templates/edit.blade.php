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
            <form action="{{ route('templates.update', $template->id) }}" method="post">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              <div class="form-group">
                <label for="codigo">Nome</label>
                <input type="text" class="form-control" id="nome" required value="{{ $template->nome }}" name="nome"/>
              </div>
              <div class="form-group">
                <label for="codigo">Arquivo</label>
                <input type="text" class="form-control" id="arquivo" name="arquivo" value="{{ $template->arquivo }}"/>
              </div>

              <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
          </div>

      </div>
    </div>

  </div>


@stop

@section('js')
    <script src="{{ asset('js/custom.js') }}"></script>
@stop

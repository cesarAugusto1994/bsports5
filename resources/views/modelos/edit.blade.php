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
            <form action="{{ route('modelos.update', $modelo->id) }}" method="post">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              <div class="form-group">
                <label for="codigo">Nome</label>
                <input type="text" class="form-control" id="nome" required value="{{ $modelo->nome }}" name="nome"/>
              </div>
              <div class="form-group">
                <label for="codigo">Templates</label>
                <select class="form-control" name="template_id">

                  @foreach($templates as $template)
                      <option value="{{ $template->id }}" {{ $template->id == $modelo->template_id ? 'selected' : '' }}>{{ $template->nome }}</option>
                  @endforeach

                </select>
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

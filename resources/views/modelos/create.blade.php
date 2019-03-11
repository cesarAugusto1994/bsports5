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
            <form action="{{ route('modelos.store') }}" method="post">
              {{ csrf_field() }}
              <div class="form-group">
                <label for="codigo">Nome</label>
                <input type="text" class="form-control" required id="nome" name="nome"/>
              </div>
              <div class="form-group">
                <label for="codigo">Templates</label>
                <select class="form-control" name="template_id" required>

                  @foreach($templates as $template)
                      <option value="{{ $template->id }}">{{ $template->nome }}</option>
                  @endforeach

                </select>
              </div>

              <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
          </div>

      </div>
    </div>

  </div>

  <div class="modal fade" id="selectImovelModal">
    <div class="modal-dialog" style="width: 900px; z-index: 9999999">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">
                  Selecione o imóvel
                  <div style="float: right; margin-right: 20px">
                      <input class="form-control" type="text" name="search" id='keySearch' placeholder="Pesquisar imóveis">
                  </div>
              </h4>
          </div>
          <div class="modal-body">
              <div class="container-img">

              </div>
              <table class="table table-striped table-hover table-imoveis">
                  <thead>
                      <tr>
                          <th>Titulo</th>
                          <th>Referência</th>
                          <th>Oferta</th>
                      </tr>
                  </thead>
                  <tbody class="bodyImovelModal">
                      <tr class='nodata'>
                          <td colspan="3" style="text-align: center;">Nenhum imóvel encontrado</td>
                      </tr>
                  </tbody>
              </table>
          </div>
          <div class="modal-footer">
              <button class="btn btn-success btn-img-prev" title="Voltar">
                  <i class="glyphicon glyphicon-chevron-left"></i>
              </button>
              <button  class="btn btn-success btn-img-next" title="Avan&ccedil;ar">
                  <i class="glyphicon glyphicon-chevron-right"></i>
              </button>

              <button class="btn btn-primary btn-prev" title="Voltar">
                  <i class="glyphicon glyphicon-chevron-left"></i>
              </button>
              <button  class="btn btn-primary btn-next" title="Avan&ccedil;ar">
                  <i class="glyphicon glyphicon-chevron-right"></i>
              </button>
              <button type="button" class="btn btn-default closeModalSelectImovel" data-dismiss="modal">Fechar</button>
          </div>
      </div>
    </div>
  </div>

@stop

@section('js')
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/bootstrap-filestyle.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
@stop

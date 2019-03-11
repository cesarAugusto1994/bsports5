@extends('adminlte::page')

@section('title', 'Modelos')

@section('content_header')
    <h1>Modelo: {{ $modelo->nome }} / Template: {{ $modelo->template->nome }} </h1>
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
              <h3 class="box-title">Modelo 4</h3>
          </div>
          <div class="box-body">
            <div class="row">

              <div class="col-md-12">
                  <h2>Cadastrar modelo 4</h2>
                  <!-- Nav tabs -->
                  <div class="card">
                      <ul class="nav nav-tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#header" aria-controls="header" role="tab" data-toggle="tab">Header</a></li>
                          <li role="presentation"><a href="#imovel1" aria-controls="imovel1" role="tab" data-toggle="tab">Imóvel 1</a></li>
                          <li role="presentation"><a href="#imovel2" aria-controls="imovel2" role="tab" data-toggle="tab">Imóvel 2</a></li>
                          <li role="presentation"><a href="#imovel3" aria-controls="imovel3" role="tab" data-toggle="tab">Imóvel 3</a></li>
                          <li role="presentation"><a href="#imovel4" aria-controls="imovel4" role="tab" data-toggle="tab">Imóvel 4</a></li>
                          <li role="presentation"><a href="#teste" aria-controls="teste" role="tab" data-toggle="tab">Testar</a></li>
                      </ul>
                      <!-- Tab panes -->
                      <div class="tab-content">
                          <div role="tabpanel" class="tab-pane active" id="header">
                              <div class="logo">
                                  <img src="{url}assets/images/common/logo.png" >
                              </div>
                              <div class="row margin-top-10">
                                  <div style="text-align:center; width: 100%; float: left;">
                                      <input class="form-control text1" type="text" value="{text1}" name="text1" id='text1' placeholder="Titulo">
                                  </div>
                              </div>
                              <div class="row margin-top-10">
                                  <div style="text-align:center; width: 100%; float: left;">
                                      <input class="form-control text1" type="text" value="{text2}" name="text2" id='text2' placeholder="Titulo 2">
                                  </div>
                              </div>
                          </div>
                          <div role="tabpanel" class="tab-pane" id="imovel1">
                              <div class="row">
                                  <div style="float: left; width: 50%; padding: 10px;">
                                      <button class="btn btn-primary selectImovel1" data-id="1">Selecione o imóvel em lan&ccedil;amento</button>
                                  </div>
                              </div>
                              <div class="row">
                                  <div style="float: left; width: 50%; padding: 10px; margin-top: 10px">
                                      <input readonly="true" style="float: left; margin-top: 4px;" class="form-control" value="{d1}" placeholder="0 dorms" type="text" id="dorms1">
                                      <input readonly="true" style="float: left; margin-top: 4px;" class="form-control" value="{d2}" placeholder="0 suítes" type="text" id="suites1">
                                      <input readonly="true" style="float: left; margin-top: 4px;" class="form-control" value="{d3}" placeholder="0 vagas" type="text" id="vagas1">
                                      <input readonly="true" style="float: left; margin-top: 4px;" class="form-control" value="{d4}" placeholder="0 metragem" type="text" id="metragem1">
                                      <input  readonly="true" style="float: left; margin-top: 4px;" class="form-control" placeholder="Bairro: nenhum" type="text" id="bairro1" value="{d37}">
                                      <input style="float: left; margin-top: 4px;" class="form-control" value="{d29}" placeholder="Link: nenhum" type="text" id="link1">
                                      <input style="float: left; margin-top: 4px;" class="form-control" value="{d33}" placeholder="Publicidade: nenhuma" type="text" id="publicidade1">
                                      <p style="padding: 10px; float: left;">Linhas editáveis:</p>
                                      <input style="float: left; margin-top: 4px;" class="form-control" value="{d6}" placeholder="Linha 1" type="text" id="linhaEdit11">
                                      <input style="float: left; margin-top: 4px;" class="form-control" value="{d7}" placeholder="Linha 2" type="text" id="linhaEdit12">
                                  </div>
                                  <div style="float: left; width: 50%; padding: 10px; margin-top: 10px">
                                      <p class="messImagem1">Imagem selecionada: nenhuma</p>
                                      <img src="{d5}" class="imgimovel1" style="display: none;" width="160px" height="160px">
                                  </div>
                              </div>
                          </div>
                          <div role="tabpanel" class="tab-pane" id="imovel2">
                              <div class="row">
                                  <div style="float: left; width: 50%; padding: 10px;">
                                      <button class="btn btn-primary selectImovel2" data-id="2">Selecione o imóvel pronto</button>
                                  </div>
                              </div>
                              <div class="row">
                                  <div style="float: left; width: 50%; padding: 10px; margin-top: 10px">
                                      <input readonly="true" style="float: left; margin-top: 4px;" class="form-control" value="{d8}" placeholder="0 dorms" type="text" id="dorms2">
                                      <input readonly="true" style="float: left; margin-top: 4px;" class="form-control" value="{d9}" placeholder="0 suítes" type="text" id="suites2">
                                      <input readonly="true" style="float: left; margin-top: 4px;" class="form-control" value="{d10}" placeholder="0 vagas" type="text" id="vagas2">
                                      <input readonly="true" style="float: left; margin-top: 4px;" class="form-control" value="{d11}" placeholder="0 metragem" type="text" id="metragem2">
                                      <input  readonly="true" style="float: left; margin-top: 4px;" class="form-control" placeholder="Bairro: nenhum" type="text" id="bairro2" value="{d38}">
                                      <input style="float: left; margin-top: 4px;" class="form-control" value="{d30}" placeholder="Link: nenhum" type="text" id="link2">
                                      <input style="float: left; margin-top: 4px;" class="form-control" value="{d34}" placeholder="Publicidade: nenhuma" type="text" id="publicidade2">
                                      <p style="padding: 10px; float: left;">Linhas editáveis:</p>
                                      <input style="float: left; margin-top: 4px;" class="form-control" value="{d13}" placeholder="Linha 1" type="text" id="linhaEdit21">
                                      <input style="float: left; margin-top: 4px;" class="form-control" value="{d14}" placeholder="Linha 2" type="text" id="linhaEdit22">
                                  </div>
                                  <div style="float: left; width: 50%; padding: 10px; margin-top: 10px">
                                      <p class="messImagem2">Imagem selecionada: nenhuma</p>
                                      <img src="{d12}" class="imgimovel2" style="display: none;" width="160px" height="160px">
                                  </div>
                              </div>
                          </div>
                          <div role="tabpanel" class="tab-pane" id="imovel3">
                              <div class="row">
                                  <div style="float: left; width: 50%; padding: 10px;">
                                      <button class="btn btn-primary selectImovel3" data-id="3">Selecione o imóvel em lan&ccedil;amento</button>
                                  </div>
                              </div>
                              <div class="row">
                                  <div style="float: left; width: 50%; padding: 10px; margin-top: 10px">
                                      <input readonly="true" style="float: left; margin-top: 4px;" class="form-control" value="{d15}" placeholder="0 dorms" type="text" id="dorms3">
                                      <input readonly="true" style="float: left; margin-top: 4px;" class="form-control" value="{d16}" placeholder="0 suítes" type="text" id="suites3">
                                      <input readonly="true" style="float: left; margin-top: 4px;" class="form-control" value="{d17}" placeholder="0 vagas" type="text" id="vagas3">
                                      <input readonly="true" style="float: left; margin-top: 4px;" class="form-control" value="{d18}" placeholder="0 metragem" type="text" id="metragem3">
                                      <input  readonly="true" style="float: left; margin-top: 4px;" class="form-control" placeholder="Bairro: nenhum" type="text" id="bairro3" value="{d39}">
                                      <input style="float: left; margin-top: 4px;" class="form-control" value="{d31}" placeholder="Link: nenhum" type="text" id="link3">
                                      <input style="float: left; margin-top: 4px;" class="form-control" value="{d35}" placeholder="Publicidade: nenhuma" type="text" id="publicidade3">
                                      <p style="padding: 10px; float: left;">Linhas editáveis:</p>
                                      <input style="float: left; margin-top: 4px;" class="form-control" value="{d20}" placeholder="Linha 1" type="text" id="linhaEdit31">
                                      <input style="float: left; margin-top: 4px;" class="form-control" value="{d21}" placeholder="Linha 2" type="text" id="linhaEdit32">
                                  </div>
                                  <div style="float: left; width: 50%; padding: 10px; margin-top: 10px">
                                      <p class="messImagem3">Imagem selecionada: nenhuma</p>
                                      <img src="{d19}" class="imgimovel3" style="display: none;" width="160px" height="160px">
                                  </div>
                              </div>
                          </div>
                          <div role="tabpanel" class="tab-pane" id="imovel4">
                              <div class="row">
                                  <div style="float: left; width: 50%; padding: 10px;">
                                      <button class="btn btn-primary selectImovel4" data-id="4">Selecione o imóvel pronto</button>
                                  </div>
                              </div>
                              <div class="row">
                                  <div style="float: left; width: 50%; padding: 10px; margin-top: 10px">
                                      <input readonly="true" style="float: left; margin-top: 4px;" class="form-control" value="{d22}" placeholder="0 dorms" type="text" id="dorms4">
                                      <input readonly="true" style="float: left; margin-top: 4px;" class="form-control" value="{d23}" placeholder="0 suítes" type="text" id="suites4">
                                      <input readonly="true" style="float: left; margin-top: 4px;" class="form-control" value="{d24}" placeholder="0 vagas" type="text" id="vagas4">
                                      <input readonly="true" style="float: left; margin-top: 4px;" class="form-control" value="{d25}" placeholder="0 metragem" type="text" id="metragem4">
                                      <input  readonly="true" style="float: left; margin-top: 4px;" class="form-control" placeholder="Bairro: nenhum" type="text" id="bairro4" value="{d40}">
                                      <input style="float: left; margin-top: 4px;" class="form-control" value="{d32}" placeholder="Link: nenhum" type="text" id="link4">
                                      <input style="float: left; margin-top: 4px;" class="form-control" value="{d36}" placeholder="Publicidade: nenhuma" type="text" id="publicidade4">
                                      <p style="padding: 10px; float: left;">Linhas editáveis:</p>
                                      <input style="float: left; margin-top: 4px;" class="form-control" value="{d27}" placeholder="Linha 1" type="text" id="linhaEdit41">
                                      <input style="float: left; margin-top: 4px;" class="form-control" value="{d28}" placeholder="Linha 2" type="text" id="linhaEdit42">
                                  </div>
                                  <div style="float: left; width: 50%; padding: 10px; margin-top: 10px">
                                      <p class="messImagem4">Imagem selecionada: nenhuma</p>
                                      <img src="{d26}" class="imgimovel4" style="display: none;" width="160px" height="160px">
                                  </div>
                              </div>
                          </div>
                          <div role="tabpanel" class="tab-pane" id="teste">
                              <div class="row">
                                  <div style="float: left; width: 100%; text-align: center; padding: 10px">
                                      <input class="form-control" style="width: 50%; display: inline-block;" value="{name}" type="text" name="nomepropaganda" id='salvar' placeholder="Nome da propaganda">
                                      <!-- <button class="btn btn-success salvar">Salvar propaganda</button> -->
                                      <button class="btn btn-primary preview" data-id="4">Preview</button>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

            </div>
          </div>
          <div class="box-footer clearfix">
              <a href="{{ route('modelos.index') }}" class="btn btn-danger btn-flat pull-left">Cancelar</a>
              <a href="javascript:void(0)" class="btn btn-success btn-flat pull-right">Salvar</a>
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

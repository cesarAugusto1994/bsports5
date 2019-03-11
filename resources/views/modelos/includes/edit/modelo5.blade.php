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
              <h3 class="box-title">Modelo 5</h3>
          </div>
          <div class="box-body">
            <div class="row">

              <div class="col-md-12">
                  <h2>Cadastrar modelo 5</h2>
                  <!-- Nav tabs -->
                  <div class="card">
                      <ul class="nav nav-tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#header" aria-controls="header" role="tab" data-toggle="tab">Header</a></li>
                          <li role="presentation"><a href="#imagens" aria-controls="imagens" role="tab" data-toggle="tab">Imagens</a></li>
                          <li role="presentation"><a href="#texto" aria-controls="texto" role="tab" data-toggle="tab">Texto</a></li>
                          <li role="presentation"><a href="#informacoesgerais" aria-controls="informacoesgerais" role="tab" data-toggle="tab">Informa&ccedil;ões Gerais</a></li>
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
                                      <input class="form-control text1" type="text" value="{d1}" name="text1" id='text1' placeholder="Titulo">
                                  </div>
                              </div>
                              <div class="row margin-top-10">
                                  <div style="text-align:center; width: 100%; float: left;">
                                      <input class="form-control text1" type="text" value="{d2}" name="text2" id='text2' placeholder="Titulo 2">
                                  </div>
                              </div>
                          </div>
                          <div role="tabpanel" class="tab-pane" id="imagens">
                              <div class="row">
                                  <div style="float: left; width: 50%; text-align: center; padding: 10px">
                                      <button class="btn btn-primary btn-img1">Selecione a imagem 1</button>
                                      <div style="float: left; width: 100%; text-align: center; padding: 10px">
                                          <img src="{d3}" id='img1' style="display: none; padding: 10px; width: 100px; height: 100px;">
                                      </div>
                                  </div>
                                  <div style="float: left; width: 50%; text-align: center; padding: 10px">
                                      <button class="btn btn-primary btn-img2">Selecione a imagem 2</button>
                                      <div style="float: left; width: 100%; text-align: center; padding: 10px">
                                          <img src="{d4}" id='img2' style="display: none; padding: 10px; width: 100px; height: 100px;">
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div style="float: left; width: 50%; text-align: center; padding: 10px">
                                      <button class="btn btn-primary btn-img3">Selecione a imagem 3</button>
                                      <div style="float: left; width: 100%; text-align: center; padding: 10px">
                                          <img src="{d5}" id='img3' style="display: none; padding: 10px; width: 100px; height: 100px;">
                                      </div>
                                  </div>
                                  <div style="float: left; width: 50%; text-align: center; padding: 10px">
                                      <button class="btn btn-primary btn-img4">Selecione a imagem 4</button>
                                      <div style="float: left; width: 100%; text-align: center; padding: 10px">
                                          <img src="{d6}" id='img4' style="display: none; padding: 10px; width: 100px; height: 100px;">
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div role="tabpanel" class="tab-pane" id="texto">
                              <div class="row">
                                  <div style="float: left; width: 100%; text-align: center; padding: 10px">
                                      <p style="text-align: center;">Adicione as 5 linhas de texto</p>
                                      <div style="float: left; width: 100%; text-align: center; padding: 10px">
                                          <input style="float: left;" class="form-control" value="{d7}" type="text" id="linhaEdit1" placeholder="Linha 1">
                                          <input style="float: left; margin-top: 10px;" value="{d8}" class="form-control" type="text" id="linhaEdit2" placeholder="Linha 2">
                                          <input style="float: left; margin-top: 10px;" value="{d9}" class="form-control" type="text" id="linhaEdit3" placeholder="Linha 3">
                                          <input style="float: left; margin-top: 10px;" value="{d10}" class="form-control" type="text" id="linhaEdit4" placeholder="Linha 4">
                                          <input style="float: left; margin-top: 10px;" value="{d11}" class="form-control" type="text" id="linhaEdit5" placeholder="Linha 5">
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div role="tabpanel" class="tab-pane" id="informacoesgerais">
                              <div class="row">
                                  <div style="float: left; width: 50%; text-align: center; padding: 10px">
                                      <button class="btn btn-primary btn-localidade">Obter localidade</button>
                                      <div style="float: left; width: 100%; text-align: center; padding: 10px">
                                          <input class="form-control" type="text" value="{d12}" id="localidade" placeholder="Localidade indisponível">
                                      </div>
                                      <div style="float: left; width: 100%; text-align: center; padding: 10px">
                                          <input class="form-control" type="text" value="{d14}" id="video" placeholder="Insira a URL do vídeo">
                                      </div>
                                      <div style="float: left; width: 100%; text-align: center; padding: 10px">
                                          <input class="form-control" type="text" value="{d15}" id="linkGeral" placeholder="Insira o LINK da localidade">
                                      </div>
                                  </div>
                                  <div style="float: left; width: 50%; text-align: center; padding: 10px">
                                      <form class="formMapaGoogle" method="post" action="{url}imoveis/enviarImagem" enctype="multipart/form-data">
                                          <button class="btn btn-success btn-enviar" type="submit">Enviar imagem do mapa</button>
                                          <div style="float: left; width: 100%; text-align: center; padding: 10px">
                                              <input type="file" name="arquivo" class="campoArquivo">
                                          </div>
                                          <div style="float: left; width: 100%; text-align: center; padding: 10px">
                                              <p class="textoImgGoogle">Imagem selecionada: nenhuma</p>
                                              <img src="{d13}" width="300" height="100" style="display: none;" class="imageGoogle">
                                          </div>
                                      </form>
                                  </div>
                              </div>
                          </div>
                          <div role="tabpanel" class="tab-pane" id="teste">
                              <div class="row">
                                  <div style="float: left; width: 100%; text-align: center; padding: 10px">
                                      <input class="form-control" style="width: 50%; display: inline-block;" value="{name}" type="text" name="nomepropaganda" id='salvar' placeholder="Nome da propaganda">
                                      <!-- <button class="btn btn-success salvar">Salvar propaganda</button> -->
                                      <button class="btn btn-primary preview" data-id="5">Preview</button>
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

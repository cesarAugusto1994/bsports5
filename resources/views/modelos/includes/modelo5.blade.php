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
                            <div class="row">
                              <div class="col-md-12 text-center">
                                <div class="logo">
                                    <img src="{{ asset('images/common/logo.png') }}" >
                                </div>
                                <div class="form-group">
                                    <div>
                                        <input class="form-control text1" type="text" value='' name="texto[]" id='text1' placeholder="Titulo">
                                    </div>
                                </div>
                                <div class="form-group">
                                  <div>
                                      <input class="form-control text1" type="text" value='' name="texto[]" id='text2' placeholder="Titulo 2">
                                  </div>
                              </div>
                              </div>
                            </div>
                          </div>
                          <div role="tabpanel" class="tab-pane" id="imagens">
                              <div class="row">
                                  <div style="float: left; width: 50%; text-align: center; padding: 10px">
                                      <button class="btn btn-primary btn-img1">Selecione a imagem 1</button>
                                      <div style="float: left; width: 100%; text-align: center; padding: 10px">
                                          <img src="" id='img1' style="display: none; padding: 10px; width: 100px; height: 100px;">
                                      </div>
                                  </div>
                                  <div style="float: left; width: 50%; text-align: center; padding: 10px">
                                      <button class="btn btn-primary btn-img2">Selecione a imagem 2</button>
                                      <div style="float: left; width: 100%; text-align: center; padding: 10px">
                                          <img src="" id='img2' style="display: none; padding: 10px; width: 100px; height: 100px;">
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div style="float: left; width: 50%; text-align: center; padding: 10px">
                                      <button class="btn btn-primary btn-img3">Selecione a imagem 3</button>
                                      <div style="float: left; width: 100%; text-align: center; padding: 10px">
                                          <img src="" id='img3' style="display: none; padding: 10px; width: 100px; height: 100px;">
                                      </div>
                                  </div>
                                  <div style="float: left; width: 50%; text-align: center; padding: 10px">
                                      <button class="btn btn-primary btn-img4">Selecione a imagem 4</button>
                                      <div style="float: left; width: 100%; text-align: center; padding: 10px">
                                          <img src="" id='img4' style="display: none; padding: 10px; width: 100px; height: 100px;">
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div role="tabpanel" class="tab-pane" id="texto">
                              <div class="row">
                                  <div style="float: left; width: 100%; text-align: center; padding: 10px">
                                      <p style="text-align: center;">Adicione as 5 linhas de texto</p>
                                      <div style="float: left; width: 100%; text-align: center; padding: 10px">
                                          <input style="float: left;" class="form-control" value="" type="text" id="linhaEdit1" placeholder="Linha 1">
                                          <input style="float: left; margin-top: 10px;" value="" class="form-control" type="text" id="linhaEdit2" placeholder="Linha 2">
                                          <input style="float: left; margin-top: 10px;" value="" class="form-control" type="text" id="linhaEdit3" placeholder="Linha 3">
                                          <input style="float: left; margin-top: 10px;" value="" class="form-control" type="text" id="linhaEdit4" placeholder="Linha 4">
                                          <input style="float: left; margin-top: 10px;" value="" class="form-control" type="text" id="linhaEdit5" placeholder="Linha 5">
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div role="tabpanel" class="tab-pane" id="informacoesgerais">
                              <div class="row">
                                  <div style="float: left; width: 50%; text-align: center; padding: 10px">
                                      <button class="btn btn-primary btn-localidade">Obter localidade</button>
                                      <div style="float: left; width: 100%; text-align: center; padding: 10px">
                                          <input class="form-control" type="text" value="" id="localidade" placeholder="Localidade indisponível">
                                      </div>
                                      <div style="float: left; width: 100%; text-align: center; padding: 10px">
                                          <input class="form-control" type="text" value="" id="video" placeholder="Insira a URL do vídeo">
                                      </div>
                                      <div style="float: left; width: 100%; text-align: center; padding: 10px">
                                          <input class="form-control" type="text" value="" id="linkGeral" placeholder="Insira o LINK da localidade">
                                      </div>
                                  </div>
                                  <div style="float: left; width: 50%; text-align: center; padding: 10px">
                                    <form class="formMapaGoogle" method="post" action="{{ route('upload_images') }}" enctype="multipart/form-data">
                                      {{csrf_field()}}
                                        <button class="btn btn-success btn-enviar" type="submit">Enviar imagem do mapa</button>
                                        <div style="float: left; width: 100%; text-align: center; padding: 10px">
                                            <input type="file" name="arquivo" class="campoArquivo">
                                        </div>
                                        <div style="float: left; width: 100%; text-align: center; padding: 10px">
                                            <p class="textoImgGoogle">Imagem selecionada:</p>
                                            <img src="{mapa}" width="300" height="100" style="display: none;" class="imageGoogle">
                                        </div>
                                    </form>
                                  </div>
                              </div>
                          </div>
                          <div role="tabpanel" class="tab-pane" id="teste">
                              <div class="row">
                                  <div style="float: left; width: 100%; text-align: center; padding: 10px">
                                      <input class="form-control" style="width: 50%; display: inline-block;" value="" type="text" name="nomepropaganda" id='salvar' placeholder="Nome da propaganda">
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

  <input type="hidden" id="route-imoveis" value="{{ route('imoveis_ajax') }}"/>
  <input type="hidden" id="route-imoveis-imagens" value="{{ route('imoveis_imagens_ajax') }}"/>
  <input type="hidden" id="route-imoveis-dormitorios" value="{{ route('imoveis_dormitorios_ajax') }}"/>
  <input type="hidden" id="route-imoveis-informacoes" value="{{ route('imoveis_informacoes_ajax') }}"/>
  <input type="hidden" id="modelo" value="{{ $modelo->id }}"/>

  @if(\Request::has('chamado'))
      <input type="hidden" id="chamado" value="{{ \Request::get('chamado') }}"/>
  @endif
  
@stop

@section('js')
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <script src="{{ asset('js/bootstrap-filestyle.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
@stop

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
              <h3 class="box-title">Modelo 1</h3>
          </div>
          <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#header" aria-controls="header" role="tab" data-toggle="tab">Header</a></li>
                            <li role="presentation"><a href="#imagens" aria-controls="imagens" role="tab" data-toggle="tab">Imagem</a></li>
                            <li role="presentation"><a href="#infoimovel" aria-controls="infoimovel" role="tab" data-toggle="tab">Info Imóvel</a></li>
                            <li role="presentation"><a href="#maisimagens" aria-controls="maisimagens" role="tab" data-toggle="tab">Mais Imagens</a></li>
                            <li role="presentation"><a href="#informacoesgerais" aria-controls="informacoesgerais" role="tab" data-toggle="tab">Informa&ccedil;ões Gerais</a></li>
                            <li role="presentation"><a href="#teste" aria-controls="teste" role="tab" data-toggle="tab">Testar</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="header">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="logo">
                                      <img src="{url}assets/images/common/logo.png" >
                                  </div>
                                  <div class="form-group">
                                      <div>
                                          <input class="form-control text1" type="text" value='{text1}' name="text1" id='text1' placeholder="Titulo">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                    <div>
                                        <input class="form-control text1" type="text" value='{text2}' name="text2" id='text2' placeholder="Titulo 2">
                                    </div>
                                </div>
                                </div>
                              </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="imagens">

                              <div class="row">
                                <div class="col-md-12">
                                    <div style="margin-top: 30px; float: left; width: 50%">
                                        <p style="color: #666">Selecione uma imagem de um empreendimento</p>
                                        <button class="btn btn-primary selectImageImovel">Selecione o imóvel</button>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div style="margin-top: 30px; float: left; width: 50%">
                                        <p style="color: #666">Imagem selecionada:</p>
                                        <p class="message-image">Nenhuma</p>
                                        <img class="selected-img" src="{imgUrl1}" style="display: none; width: 100px; height: 100px;" />
                                    </div>
                                </div>
                              </div>
                            </div>

                            <div role="tabpanel" class="tab-pane" id="infoimovel">
                              <div class="row">
                                <div class="col-md-12" style="text-align: center;">
                                    <button class="btn btn-primary selectImovelInfo">Selecione o imóvel</button>
                                </div>
                                <div class="col-md-12">
                                    <div style="float: left; width: 50%; padding: 10px; margin-top: 10px">
                                        <input readonly="true" style="float: left; margin-top: 4px;" class="form-control" value="{dorms}" placeholder="0 dorms" type="text" id="dorms">
                                        <input readonly="true" style="float: left; margin-top: 4px;" class="form-control" value="{suites}" placeholder="0 suítes" type="text" id="suites">
                                        <input readonly="true" style="float: left; margin-top: 4px;" class="form-control" value="{vagas}" placeholder="0 vagas" type="text" id="vagas">
                                        <input readonly="true" style="float: left; margin-top: 4px;" class="form-control" value="{metragem}" placeholder="0 metragem" type="text" id="metragem">
                                    </div>
                                    <div style="float: left; width: 50%; padding: 10px; margin-top: 10px">
                                        <input style="float: left; margin-top: 4px;" class="form-control" placeholder="Linha editável 1" value="{edit1}" type="text" id="editavel1">
                                        <input style="float: left; margin-top: 4px;" class="form-control" placeholder="Linha editável 2" value="{edit2}" type="text" id="editavel2">
                                        <input style="float: left; margin-top: 4px;" class="form-control" placeholder="Linha editável 3" value="{edit3}" type="text" id="editavel3">
                                        <input style="float: left; margin-top: 4px;" class="form-control" placeholder="Linha editável 4" value="{edit4}" type="text" id="editavel4">
                                    </div>
                                </div>
                              </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="maisimagens">
                              <div class="row">
                                <div class="col-md-12">
                                    <div style="float: left; width: 50%; text-align: center; padding: 10px">
                                        <button class="btn btn-primary btn-img1">Selecione a imagem 1</button>
                                        <div style="float: left; width: 100%; text-align: center; padding: 10px">
                                            <img src="{img1}" id='img1' style="display: none; padding: 10px; width: 100px; height: 100px;">
                                        </div>
                                    </div>
                                    <div style="float: left; width: 50%; text-align: center; padding: 10px">
                                        <button class="btn btn-primary btn-img2">Selecione a imagem 2</button>
                                        <div style="float: left; width: 100%; text-align: center; padding: 10px">
                                            <img src="{img2}" id='img2' style="display: none; padding: 10px; width: 100px; height: 100px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div style="float: left; width: 50%; text-align: center; padding: 10px">
                                        <button class="btn btn-primary btn-img3">Selecione a imagem 3</button>
                                        <div style="float: left; width: 100%; text-align: center; padding: 10px">
                                            <img src="{img3}" id='img3' style="display: none; padding: 10px; width: 100px; height: 100px;">
                                        </div>
                                    </div>
                                    <div style="float: left; width: 50%; text-align: center; padding: 10px">
                                        <button class="btn btn-primary btn-img4">Selecione a imagem 4</button>
                                        <div style="float: left; width: 100%; text-align: center; padding: 10px">
                                            <img src="{img4}" id='img4' style="display: none; padding: 10px; width: 100px; height: 100px;">
                                        </div>
                                    </div>
                                </div>
                              </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="informacoesgerais">
                                <div class="row">
                                    <div style="float: left; width: 50%; text-align: center; padding: 10px">
                                        <button class="btn btn-primary btn-localidade">Obter Localidade/Vídeo</button>
                                        <div style="float: left; width: 100%; text-align: center; padding: 10px">
                                            <input class="form-control" value="{local}" type="text" id="localidade" placeholder="Localidade indisponível">
                                        </div>

                                        <div style="float: left; width: 100%; text-align: center; padding: 10px">
                                            <input class="form-control" type="text" value="{video}" id="video" placeholder="Insira a URL do vídeo">
                                        </div>

                                        <div style="float: left; width: 100%; text-align: center; padding: 10px">
                                            <input class="form-control" type="text" value="{linkGer}" id="linkGeral" placeholder="Insira o LINK da localidade">
                                        </div>
                                    </div>
                                    <div style="float: left; width: 50%; text-align: center; padding: 10px">
                                        <form class="formMapaGoogle" method="post" action="{url}imoveis/enviarImagem" enctype="multipart/form-data">
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
                                        <input class="form-control" style="width: 50%; display: inline-block;" value="{name}" type="text" name="nomepropaganda" id='salvar' placeholder="Nome da propaganda">
                                        <!-- <button class="btn btn-success salvar">Salvar propaganda</button> -->
                                        <button class="btn btn-primary preview" data-id="1">Preview</button>
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
    <script src="{{ asset('js/custom0.js') }}"></script>
    <script src="{{ asset('js/bootstrap-filestyle.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
@stop

@extends('adminlte::page')

@section('title', 'Chamados')

@section('content_header')
    <h1>Painel Mailling</h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> Painel Principal</a></li>
      <li class="active">Mailling</li>
    </ol>
@stop

@section('content')

  <div class="row">

          <div class="col-md-6">
            <div class="box box-solid">

                <div class="box-header with-border">
                  <h3 class="box-title">Filtros</h3>
                </div>

                <form action="{{ route('mailling.index') }}" method="get">
                    <input type="hidden" name="buscar" value="1"/>
                    <div class="box-body">
                      <div class="row">

                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="tipo">Tipo</label>
                            <select class="form-control" name="tipo" id="tipo" style="width:100%">
                              <option value=""></option>
                              @foreach(\App\Models\Clientes\Tipo::all() as $tipo)
                                  <option value="{{  $tipo->id }}">{{ $tipo->nome }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>

                      </div>
                    </div>
                    <div class="box-footer clearfix">
                      <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </form>

            </div>
          </div>

          <form action="{{ route('mailling_envio_email_clientes') }}" method="get">

              <div class="col-md-6">
                <div class="box box-solid">
                  <div class="box-header with-border">
                    <h3 class="box-title">Envia Email</h3>
                  </div>

                      <div class="box-body">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="select-empreendimento">Propaganda</label>
                              <select name="propaganda" class="form-control">

                                @php
                                    $propagandas = \App\Models\Propaganda::all();
                                @endphp

                                @foreach($propagandas as $propaganda)
                                    <option value="{{ $propaganda->id }}">{{ $propaganda->nome }}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="box-footer clearfix">
                        <button type="submit" class="btn btn-success">Enviar</button>
                      </div>

                </div>
              </div>
              @if(request()->has('buscar'))
              <div class="col-md-12">
                  <div class="box box-solid">
                    <div class="box-header with-border">
                      <h3 class="box-title">Listagem de Mailling ({{$quantidade}})</h3>
                    </div>
                    <div class="box-body table-responsive">

                      <table class="table table-striped table-condensed">
                        <thead>

                          <tr>
                            <th style="width: 10px">#</th>
                            <th>Cliente</th>
                            <th>Tipo</th>
                            <th>Email</th>
                            <th>Grupo</th>
                            <th style="width:100px">#</th>
                          </tr>

                        </thead>
                        <tbody>

                          @forelse($clientes as $cliente)
                              <tr>
                                <td>{{ $cliente->id }}</td>
                                <td>{{ $cliente->nome ?? '-' }}</td>
                                <td>{{ $cliente->tipoCadastro->nome ?? '-' }}</td>
                                <td>
                                  @foreach($cliente->emails as $item)
                                      <p>{{ $item->email ?? '' }}</p>
                                  @endforeach
                                </td>
                                <td>{{ $empreendimento }}</td>
                                <td>
                                  <input type="checkbox" name="clientes[]" checked value="{{ $cliente->id }}"/>
                                </td>
                              </tr>
                          @empty
                              <tr>
                                <td colspan="9">
                                  <div class="alert alert-warning">
                                    <p><i class="icon fa fa-info"></i> Nenhum registro encontrado.</p>
                                  </div>
                                </td>
                              </tr>
                          @endforelse
                      </tbody></table>
                    </div>
                    <div class="box-footer clearfix">
                    </div>
                  </div>
              </div>
              @endif

          </form>

  </div>

@stop

@section('js')
    <script src="{{ asset('js/custom.js') }}"></script>
@stop

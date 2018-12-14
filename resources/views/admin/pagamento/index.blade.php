@extends('adminlte::page')

@section('title', 'Pagamentos')

@section('content_header')
    <h1>Pagamentos</h1>
@stop

@section('content')

<div class="row">

  <div class="col-md-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Opções</h3>
      </div>
      <div class="box-body">



      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Histórico de Pagamentos</h3>
      </div>
      <div class="box-body">
        <div class="table-responsive">
          <table id="dataTable" class="table table-striped database-tables">
              <thead>
                  <tr>
                      <th>ID</th>
                      <th>Nome</th>
                      <th>Mês</th>
                      <th>Valor</th>
                      <th>Vencimento</th>
                      <th>Pago Em</th>
                      <th>Status</th>
                      <th>Referencia</th>
                      <th>Opções</th>
                  </tr>
              </thead>

              @foreach($pagamentos as $pagamento)

                  <tr>

                      <td>#{{ $pagamento->id }}</td>

                      <td>
                          <p class="name">
                              <a href="{{ route('player_profile', $pagamento->jogador->uuid) }}">
                                 {{ $pagamento->jogador->nome }}
                              </a>
                          </p>
                      </td>

                      <td>{{ $pagamento->mes }}</td>
                      <td>{{ number_format($pagamento->valor, 2, ',', '.') }}</td>
                      <td>{{ $pagamento->vencimento->format('d/m/Y') }}</td>
                      <td>{{ $pagamento->data_pagamento ? $pagamento->data_pagamento->format('d/m/Y') : '' }}</td>
                      <td>{{ $pagamento->status->nome }}</td>
                      <td>{{ $pagamento->referencia }}</td>

                      <td class="actions">

                        @if(in_array($pagamento->status->id, [1,2]))
                        <form action="{{ route('informe_pagamento', $pagamento->uuid) }}" method="post" style="display:inline">
                          {{ csrf_field() }}
                          <button class="btn btn-primary btn-sm">
                             <i class="fa fa-money"></i> Informar pagamento
                          </button>
                        </form>
                          <a class="btn btn-danger btn-sm delete_table btnRemoveItem"
                             data-table="{{ $pagamento->name }}"
                             data-route="{{ route('mensalidades.destroy', $pagamento->id) }}">
                             <i class="fa fa-trash"></i>
                          </a>
                        @elseif($pagamento->status->id == 10)
                          <form action="{{ route('informe_pagamento', ['id' => $pagamento->uuid, 'status' => 3]) }}" method="post" style="display:inline">
                            {{ csrf_field() }}
                            <button class="btn btn-success btn-sm">
                               <i class="fa fa-money"></i> Confirmar Pagamento
                            </button>
                          </form>
                        @endif
                      </td>
                  </tr>
              @endforeach

          </table>
          <div class="text-center">{{ $pagamentos->links() }}</div>
        </div>
      </div>
    </div>
  </div>
</div>

@stop

@section('css')
@stop

@section('js')
@stop

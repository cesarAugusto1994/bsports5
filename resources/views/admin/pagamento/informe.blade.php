@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Adicionar Mensalidade</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-bordered">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="panel-body">

                   <form class="form-edit-add" role="form"
                        action="{{ route('informe_pagamento', ['id' => $pagamento->uuid, 'status' => 10]) }}"
                        method="POST" autocomplete="off">
                      {{ csrf_field() }}

                        <div class="form-group">
                            <label>Jogador</label>
                            <input type="text" class="form-control" disabled value="{{ $pagamento->jogador->nome }}" required>
                        </div>

                        <div class="form-group">
                            <label>Pagamento</label>
                            <input type="text" class="form-control" value="{{ $pagamento->id }}/{{ $pagamento->uuid }}" disabled>
                        </div>

                        <div class="form-group">
                            <label>Mês Referência</label>
                            <input type="text" class="form-control datetime" value="{{ $pagamento->referencia}}" disabled required>
                        </div>

                        <div class="form-group">
                            <label>Valor</label>
                            <input type="text" class="form-control money" disabled value="{{ $pagamento->valor*100 }}" placeholder="R$ Valor" required>
                        </div>

                        <div class="form-group">
                            <label>Data Pagamento</label>
                            <input type="text" name="data_pagamento" class="form-control date datepicker" value="{{ now()->format('d/m/Y') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Forma de Pagamento</label>
                            <select class="form-control" name="forma_pagamento" required>
                                <option value="">Selecione a forma de pagamento</option>
                                <option value="dinheiro">Dinheiro</option>
                                <option value="cartao">Cartão de Crédito</option>
                                <option value="cheque">Cheque</option>
                                <option value="boleto">Boleto</option>
                                <option value="outro">Outros</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Descrição</label>
                            <textarea class="form-control" name="descricao" rows="4" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary save">
                            Salvar
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="input-append date" id="datepicker1"
    data-date="Aug-2015"
    data-date-format="mm-yyyy"
    data-dates-disabled="Set-2018,Out-2018" style="display:inline-block; font-weight:bold;">

@stop

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">

@stop

@section('js')

    <script>

      $(document).ready(function() {

        $('.money').mask('000.000.000.000.000,00', {reverse: true});

        var datesToDisable = $('#datepicker1').data("datesDisabled").split(',');

        $('.datetime').datepicker({
            format: "mm/yyyy",
            startView: "months",
            minViewMode: "months",
            clearBtn: true,
            language: "pt-BR",
            multidate: true,
            multidateSeparator: ", ",
            todayHighlight: true
        }).on("show", function(event) {

            var year = $("th.datepicker-switch").eq(1).text();  // there are 3 matches

            $(".month").each(function(index, element) {

              var el = $(element);

              var hideMonth = $.grep( datesToDisable, function( n, i ) {
                                return n.substr(4, 4) == year && n.substr(0, 3) == el.text();
                              });
           });

        });

        $(".select-jogador").select2({
          ajax: {
            type: 'GET',
            url: $('#select-jogador').data('url'),
            dataType: 'json',
            delay: 250,
            data: function (params) {
              return {
                search: params.term
              };
            },
            processResults: function (data, params) {

              return {
                  results: $.map(data, function (item) {
                      return {
                          text: item.nome,
                          email: item.email,
                          id: item.id
                      }
                  })
              };
            },
            cache: true
          },
          escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
          templateResult: formatRepo,
          placeholder: 'Selecione um jogador',
          minimumInputLength: 1
        });

        function formatRepo (repo) {

          if (repo.loading) {
            return repo.text;
          }

          var markup = "<div class='select2-result-repository clearfix'>" +
            "<div class='select2-result-repository__meta'>" +
              "<div class='select2-result-repository__title'>" + repo.text + "</div>";

          if (repo.description) {
            markup += "<div class='select2-result-repository__description'>" + repo.description + "</div>";
          }

          markup += "<div class='select2-result-repository__statistics'>" +
          "<div class='select2-result-repository__forks'><i class='fa fa-flash'></i> Email: " + repo.email + " </div>" +
          "<div class='select2-result-repository__forks'><i class='fa fa-flash'></i> Código: #" + repo.id + " </div>" +
          "</div>" +
          "</div></div>";

          return markup;
        }

        function formatRepoSelection (repo) {
          return repo.full_name || repo.text;
        }

      });

    </script>

@stop

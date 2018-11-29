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
                       action="?"
                       method="get" autocomplete="off">

                       <div class="form-group">
                           <label for="email">Categoria</label>
                           <select name="categoria" class="form-control" id="categoria" name="categoria" required>
                               @foreach($categorias as $categoria)
                                   <option value="{{ $categoria->id }}" {{ \Request::has('categoria') && \Request::get('categoria') == $categoria->id ? 'selected' : '' }}>{{ $categoria->nome }}</option>
                               @endforeach
                           </select>
                       </div>


                       <button type="submit" class="btn btn-primary save">
                           Buscar
                       </button>

                   </form>

                </div>
            </div>
        </div>
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
                        action="{{ route('mensalidades.store') }}"
                        method="POST" autocomplete="off">
                      <!-- PUT Method if we are editing -->
                      {{ csrf_field() }}

                        @if(!empty($jogadores) && $jogadores->isNotEmpty())
                        <div class="form-group">
                            <label for="email">Jogadores ({{$quantidade}})</label>

                            <div style="">

                              <table class="table table-bordered table-hover" data-toggle="table" data-pagination="true" data-search="true">
                                <thead>
                                  <tr>
                                     <th><input type="checkbox" id="checkall"></th>
                                     <th>Nome</th>
                                     <th>Email</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach($jogadores as $jogador)
                                  <tr>
                                     <td><input type="checkbox" name="jogador[]" value="{{ $jogador->id }}" class="checkbox-jogador"></td>
                                     <td>{{ $jogador->nome }}</td>
                                     <td>{{ $jogador->email }}</td>
                                  </tr>
                                  @endforeach
                                </tbody>
                              </table>

                            </div>

                        </div>
                        @endif

                        <div class="form-group">
                            <label for="email">Mês Referência</label>
                            <input type="text" class="form-control datetime" id="mes" name="mes" placeholder="Meses" readonly required>
                        </div>

                        <div class="form-group">
                            <label for="email">Valor Mensalidade</label>
                            <input type="text" class="form-control money" id="valor" name="valor" value="{{\App\Helpers\Helper::getConfig('valor-mensalidade')}}" placeholder="R$ Valor" required>
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

        $("#checkall").change(function() {

            var self = $(this);
            var checked = self.is(':checked');

            var elements = $(".checkbox-jogador");

            if(checked) {

                elements.attr('checked', true);

            } else {

                elements.attr('checked', false);

            }

        });

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

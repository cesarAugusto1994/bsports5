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
                     <!-- PUT Method if we are editing -->

                       <div class="form-group">
                           <label for="email">Categoria</label>
                           <select name="categoria" class="form-control" id="categoria" name="categoria" required>
                               @foreach(\App\Models\Categoria::where('tipo', 'Simples')->orderBy('tipo')->get() as $categoria)
                                   <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
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
                            <label for="email">Jogadores</label>

                            <div style="min-height:300px;max-height:300px;overflow: auto;">

                              <table class="table">
                                <thead>
                                  <tr>
                                     <th>Opções</th>
                                     <th>Nome</th>
                                     <th>Email</th>
                                     <th>Pontos</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach($jogadores as $jogador)
                                  <tr>
                                     <td><input type="checkbox" name="jogador[]" value="{{ $jogador->id }}"></td>
                                     <td>{{ $jogador->pessoa->nome }}</td>
                                     <td>{{ $jogador->pessoa->email }}</td>
                                     <td>{{ $jogador->resultados->sum('pontos') + $jogador->resultados->sum('bonus') }}</td>
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
                            <input type="text" class="form-control money" id="valor" name="valor" value="150.00" placeholder="R$ Valor" required>
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

@extends('adminlte::page')

@section('css')
    <style>

      .event-txt-wrap .event-txt {
        width: 100%;
      }

      .modal, .modal2, .modal-carousel-wrapper {
        background-color: none !important;
      }

      .calendar {
        cursor: pointer !important;
      }

      .select2-search__field {
        width: 100%
      }

    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.3.0/fullcalendar.min.css" rel="stylesheet"/>
@stop

@section('title', 'Partidas')

@section('content_header')
    <h1>Partidas</h1>
@stop

@section('content')

  <div class="row">

      <div class="col-md-12">@include('flash::message')</div>

      <div class="col-md-9">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Caledário</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <div class="calendar"></div>

            </div>
          </div>
      </div>

      <div class="col-md-3">

          <div class="row">

              <div class="col-md-12">

                <div class="box box-default color-palette-box">
                  <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-tag"></i> Legenda Quadras</h3>
                  </div>
                  <div class="box-body">
                    <div class="row">
                        @foreach($quadras as $quadra)
                      <div class="col-sm-4 col-md-4">
                        <p class="text-center">{{ $quadra->nome }}</p>
                        <div class="color-palette-set">
                              <option value="{{ $quadra->id }}"></option>
                              <div style="height:20px;background-color:{{ $quadra->cor }}"><span></span></div>
                        </div>
                      </div>
                      @endforeach
                    </div>
                  </div>
                  <!-- /.box-body -->
                </div>

              </div>

              <div class="col-md-12">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Agendamento</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                  <form id="" method="POST" action="{{ route('partida.store') }}">

                      {{  csrf_field() }}
                      <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Inicio</label>
                                <div class="input-group col-md-12 col-xs-12 col-sm-12">
                                  <input type="text" class="form-control date_time" name="inicio" id="inicio" required/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Fim</label>
                                <div class="input-group col-md-12 col-xs-12 col-sm-12">
                                  <input type="text" class="form-control date_time" maxlength="" name="fim" id="fim" required/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Jogadores</label>
                                <div class="input-group col-md-12 col-xs-12 col-sm-12">
                                  <select class="form-control select2 select-jogador" multiple style="width:99%" id="jogadores" name="jogador[]">
                                      <option value=""></option>

                                  </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Quadra</label>
                                <div class="input-group col-md-12 col-xs-12 col-sm-12">
                                    <select class="form-control select2" multiple name="quadra[]" id="quadra">
                                      @foreach($quadras as $quadra)
                                          <option value="{{ $quadra->id }}">{{ $quadra->nome }}</option>
                                      @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Torneio</label>
                                <div class="input-group col-md-12 col-xs-12 col-sm-12">
                                    <select class="form-control" name="torneio" id="torneio">
                                      @foreach($torneios as $quadra)
                                          <option value="{{ $quadra->id }}" {{ $loop->last ? 'selected' : '' }}>{{ $quadra->nome }}</option>
                                      @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Semestre</label>
                                <div class="input-group col-md-12 col-xs-12 col-sm-12">
                                    <select class="form-control" name="semestre_id" id="semestre_id">
                                      @foreach($semestres as $semestre)
                                          <option value="{{ $semestre->id }}" {{ $loop->last ? 'selected' : '' }}>{{ $semestre->titulo }}</option>
                                      @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>


                      </div>

                    <button type="submit" id="btnAgendar" class="btn btn-bitbucket btn-block">Agendar</button>

                  </form>

                </div>
              </div>
          </div>

          </div>

      </div>

  </div>

<input type="hidden" id="partidas-ajax" value="{{ route('lista_partidas_ajax') }}">
<input type="hidden" id="now" value="{{ now()->format('c') }}">
<input type="hidden" id="jogador-ajax" value="{{ route('jogadores_ajax') }}"/>
@endsection

@section('js')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/i18n/pt-BR.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/locale/pt-br.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.3.0/fullcalendar.min.js"></script>

  <script>

  $('.date_time').mask('00/00/0000 00:00', {placeholder: "__/__/____ __:__"});

  $('.select2').select2();

  $(".select-jogador").select2({
    ajax: {
      type: 'GET',
      url: $('#jogador-ajax').val(),
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
                    categoria: item.categoria,
                    id: item.id
                }
            })
        };
      },
      cache: true
    },
    escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
    templateResult: formatRepo,
    placeholder: 'Selecione ao menos jogador',
    minimumInputLength: 1
  });

  function formatRepo (repo) {

    if (repo.loading) {
      return repo.text;
    }

    var markup = "<div class='select2-result-repository clearfix'>" +
      "<div class='select2-result-repository__meta'>" +
        "<div class='select2-result-repository__title'>" + repo.text + "</div>";

    markup += "<div class='select2-result-repository__statistics'>" +
    "<div class='select2-result-repository__forks'><i class=''></i> Categoria: " + repo.categoria + " </div>" +
    "<div class='select2-result-repository__forks'><i class=''></i> Email: " + repo.email + " </div>" +
    "<div class='select2-result-repository__forks'><i class=''></i> Código: #" + repo.id + " </div>" +
    "</div>" +
    "</div></div>";

    return markup;
  }

  function formatRepoSelection (repo) {
    return repo.full_name || repo.text;
  }

  function popularModal(event) {
    $("#formConsultaModal").prop('action', '/professional/consults/' + event.id + '/update');
    $("#cadastra-consulta-modal").modal('show');
    $("#cadastra-consulta-modal").find('#title').val(event.title);
    $("#consulta-inicio").val(event.start.format('DD/MM/YYYY HH:mm'));
    $("#consulta-fim").val(event.end.format('DD/MM/YYYY HH:mm'));
    $("#consulta-notas").val(event.notas);
  }

  function limparModal() {

  }

  let $calendar = $('.calendar');

  $calendar.fullCalendar({
    views: {

      listDay: {
        buttonText: 'list day',
        titleFormat: "dddd, DD MMMM YYYY",
        columnFormat: "",
        timeFormat: "HH:mm"
      },

      listWeek: {
        buttonText: 'list week',
        columnFormat: "ddd D",
        timeFormat: "HH:mm"
      },

      listMonth: {
        buttonText: 'list month',
        titleFormat: "MMMM YYYY",
        timeFormat: "HH:mm"
      },

      month: {
        buttonText: 'month',
        titleFormat: 'MMMM YYYY',
        columnFormat: "ddd",
        timeFormat: "HH:mm"
      },

      agendaWeek: {
        buttonText: 'agendaWeek',
        columnFormat: "ddd D",
        timeFormat: "HH:mm"
      },

      agendaDay: {
        buttonText: 'agendaDay',
        titleFormat: 'dddd, DD MMMM YYYY',
        columnFormat: "",
        timeFormat: "HH:mm"
      },
    },

    lang: 'pt-br',
    eventLimit: true,
    eventLimitText: 'partidas',
    defaultView: 'agendaWeek',
    eventBorderColor: "#de1f1f",
    eventColor: "#AC1E23",
    slotLabelFormat: 'HH:mm',
    eventLimitText: 'consultas',
    minTime: '06:00:00',
    maxTime: '22:59:59',
    header: {
        left: 'prev,next,today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay,listMonth,listWeek'
    },
    navLinks: true,
    selectable: true,
    selectHelper: true,
    select: function(start, end, jsEvent, view) {

        var view = $('.calendar').fullCalendar('getView');

        if(view.name == 'agendaDay' || view.name == 'agendaWeek') {

          limparModal();

          $("#inicio").val(start.format('DD/MM/YYYY HH:mm'));
          $("#fim").val(end.format('DD/MM/YYYY HH:mm'));

        }

    },
    editable: true,
    allDaySlot: false,
    eventLimit: true,
    dayClick: function(date, jsEvent, view) {

        jsEvent.preventDefault();

          setTimeout(function() {
            if(view.name == 'month') {
              $('.calendar').fullCalendar('gotoDate', date);
              $('.calendar').fullCalendar('changeView','agendaDay');
            }
          }, 100);

      },
      events: $("#partidas-ajax").val(),
      color: 'black',
      resourceRender: function(resourceObj, $td) {
        $td.eq(0).find('.fc-cell-content')
          .append(
            $('<strong>(?)</strong>').popover({
              title: resourceObj.title,
              content: 'test!',
              trigger: 'hover',
              placement: 'bottom',
              container: 'body'
            })
          );
      },
      textColor: 'yellow',
      eventDrop: function (event, delta, revertFunc) {
        popularModal(event);
      },
      eventResize: function (event, delta, revertFunc) {
        popularModal(event);
      },
      eventRender: function(event, element) {
          $(element).tooltip({title: event.title});
      },
      ignoreTimezone: false,
      allDayText: 'Dia Inteiro',
      monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
      monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
      dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'],
      dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],

      axisFormat: 'HH:mm',

      buttonText: {
          prev: "<",
          next: ">",
          prevYear: "Ano anterior",
          nextYear: "Proximo ano",
          today: "Hoje",
          month: "Mês",
          week: "Semana",
          day: "Dia",
          listMonth: "Lista Mensal",
          listWeek: "Lista Semanal",
          listDay: "Lista Diária"
      }

  });

  </script>
  @if(\Request::has('date'))
    <script>
      $('.calendar').fullCalendar('gotoDate', '{{ (\DateTime::createFromFormat('d/m/Y', \Request::get('date')))->format("Y-m-d") }}');
    </script>
  @endif
@stop

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

    <link href="{{ asset('css/fullcalendar.css') }}" rel="stylesheet"/>
@stop

@section('title', 'Partidas')

@section('content_header')
    <h1>Partidas</h1>
@stop

@section('content')

  <div class="row">

              <div class="col-md-12">@include('flash::message')</div>

              <div class="col-md-8">
                  <div class="box box-info">
                    <div class="box-header with-border">
                      <h3 class="box-title">Caledário</h3>

                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                      <div class="calendar"></div>

                    </div>
                  </div>
              </div>

              <div class="col-md-4">
                  <div class="box box-info">
                    <div class="box-header with-border">
                      <h3 class="box-title">Caledário</h3>

                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                      <form id="" method="POST" action="{{ route('partida.store') }}">

                          {{  csrf_field() }}
                          <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <h2>Agendar partida</h2>
                                </div>
                            </div>


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
                                      <select class="form-control select2 select-jogador" multiple style="width:270px" id="jogadores" name="jogador[]">
                                          <option value=""></option>

                                      </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Quadra</label>
                                    <div class="input-group col-md-12 col-xs-12 col-sm-12">
                                        <select class="form-control" name="quadra" id="quadra">
                                          @foreach(\App\Models\Quadras::all() as $quadra)
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
                                          @foreach(\App\Models\Torneio::all() as $quadra)
                                              <option value="{{ $quadra->id }}" {{ $loop->last ? 'selected' : '' }}>{{ $quadra->nome }}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>


                          </div>

                        <button type="submit" id="btnAgendar" class="btn btn-block btn-info pull-right">Agendar</button>

                      </form>

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

  <script src="{{ asset('js/fullcalendar/moment.min.js') }}"></script>
  <script src="{{ asset('js/fullcalendar/fullcalendar.min.js') }}"></script>

  <script>

  $('.date_time').mask('00/00/0000 00:00:00', {placeholder: "__/__/____ __:__"});

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

  $('.calendar').fullCalendar({
    height: 380,
    contentHeight: 590,
    lang: 'pt-br',
    defaultView: 'agendaWeek',
    eventLimit: true,
    eventLimitText: 'partidas',
    eventBorderColor: "#de1f1f",
    eventColor: "#AC1E23",
    contentHeight: 'auto',
    defaultEventMinutes: 30,
    minTime: '06:00:00',
    maxTime: '22:59:59',
    header:
    {
        left: 'prev,next,today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
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
    eventClick: function(event, element, view) {
        //popularModal(event);

        //$(".select2").hide();
        //$("#inicio").val(event.start.format('DD/MM/YYYY HH:mm'));
        //$("#fim").val(event.end.format('DD/MM/YYYY HH:mm'));

    },
    editable: false,
    allDaySlot: false,
    dayClick: function(date, jsEvent, view) {

        jsEvent.preventDefault();

        //window.location.href = '?date=' + date.format('DD/MM/YYYY');

          setTimeout(function() {

            //limparModal();

            //$("#formConsultaModal").prop('action', $("#consultas-store").val());

            if(view.name == 'month') {
              $('.calendar').fullCalendar('gotoDate', date);
              $('.calendar').fullCalendar('changeView','agendaDay');
            }

          }, 100);

      },
      eventSources: [

        // your event source
        {
          url: $("#partidas-ajax").val(),
          type: 'GET',
          error: function() {
            alert('there was an error while fetching events!');
          },
          complete: function() {



          }
        }

        // any other sources...

      ],
      color: 'black',     // an option!
      textColor: 'yellow', // an option!
      //When u drop an event in the calendar do the following:
      eventDrop: function (event, delta, revertFunc) {
        popularModal(event);
      },
      //When u resize an event in the calendar do the following:
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
      views: {
        agenda: {
          titleFormat: 'dddd, DD MMMM YYYY',
          titleRangeSeparator: ' to ',
          columnFormat: ''
        },
        day: {
          titleFormat: 'dddd, DD MMMM YYYY',
          titleRangeSeparator: ' to ',
          columnFormat: ''
        },
        week: {
          titleFormat: 'MMMM YYYY',
          titleRangeSeparator: ' to ',
          columnFormat: 'ddd D'
        },
        month: {
          titleFormat: 'MMMM YYYY',
          titleRangeSeparator: ' to ',
          columnFormat: 'dddd'
        }
      },
      nowIndicator: true,
      now: $("#now").val(),
      slotLabelFormat: '',
      columnFormat: {
          month: 'ddd',
          week: 'ddd D',
          day: 'dddd'
      },
      axisFormat: 'HH:mm',
      timeFormat: {
          '': 'HH:mm',
          agenda: 'HH:mm'
      },
      buttonText: {
          prev: "<",
          next: ">",
          prevYear: "Ano anterior",
          nextYear: "Proximo ano",
          today: "Hoje",
          month: "Mês",
          week: "Semana",
          day: "Dia"
      }

  });

  </script>
  @if(\Request::has('date'))
    <script>
      $('.calendar').fullCalendar('gotoDate', '{{ (\DateTime::createFromFormat('d/m/Y', \Request::get('date')))->format("Y-m-d") }}');
    </script>
  @endif
@stop

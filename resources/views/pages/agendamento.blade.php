@extends('layouts.layout')

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

    </style>

    <link href="{{ asset('css/fullcalendar.css') }}" rel="stylesheet"/>
@stop

@section('content')

<!--Inner Banner Start-->
<div class="inner-banner">
    <h1>Agendamento de Partidas</h1>
</div>
<div class="fl-breadcrumps">
    <div class="container">
        <ul class="pull-left">
            <li> <a href="{{ route('home') }}">Início</a> </li>
            <li> <a>Calendário Partidas</a> </li>
        </ul>
        <a class="pull-right" href="{{ route('home') }}">Voltar ao início <i class="fa fa-caret-right"></i></a>
    </div>
</div>

<div class="page-wrapper">

  <div class="ticket-listing">
      <div class="container">
          <div class="row">

                @if (!Auth::user()->roles->contains('admin'))
                  <div class="col-md-12"><a class="btn btn-info" href="{{ route('create_partida') }}">Novo Agendamento</a></div>
                @endif

                <br/>
                <br/>
                <br/>


              <div class="col-md-12">@include('flash::message')</div>

              <div class="col-md-6">

                  <div class="calendar"></div>

              </div>

              <div class="col-md-6">
                  @if(!empty($partidas) && $partidas->isNotEmpty())

                      <div class="tickets-sort text-center">
                        <h2>Partidas Dia {{ \Request::has('date') ? \Request::get('date') : '' }}</h2>
                      </div>
                      <div class="tickets-list">

                            <ul>
                              @foreach($partidas as $partida)

                                <li>
                                    <div class="tickets-date"> <span>{{ $partida->inicio ? $partida->inicio->format('D') : '' }}</span>
                                      <strong>{{ $partida->inicio ? $partida->inicio->format('M d') : '' }}</strong> <span>{{ $partida->inicio->format('H:i') }}</span> </div>
                                    <div class="tickets-detail">
                                        <div class="team-vs text-center">

                                          @php

                                          $user = \Auth::user();

                                          if($user->isAdmin()) {

                                            $rotaJOgador = route('agendar_partida_jogador', ['id' => $partida->id]);

                                            $jogador = \App\Models\Pessoa\Jogador::where('email', \Auth::user()->email)->get()->first();

                                            if(!is_null($jogador)) {
                                              $categoria = $jogador->categoria->id;
                                              $rotaJOgador = route('agendar_partida_jogador', ['id' => $partida->id, 'jogador' => $jogador->id]);
                                            }

                                          } else {

                                            $rotaJOgador = route('player_agendar_partida_jogador', ['id' => $partida->id]);

                                            $jogador = \App\Models\Pessoa\Jogador::where('email', \Auth::user()->email)->get()->first();

                                            if(!is_null($jogador)) {
                                              $categoria = $jogador->categoria->id;
                                              $rotaJOgador = route('player_agendar_partida_jogador', ['id' => $partida->id, 'jogador' => $jogador->id]);
                                            }

                                          }

                                          @endphp

                                            <h4>
                                              @if($partida->jogador1)
                                                  <a href="{{ route('jogador', $partida->jogador1->uuid) }}">
                                                  {{ substr($partida->jogador1->nome, 0, 12) }}</a>
                                              @else
                                                <a class="btn btn-success btn-sm btn-flat" href="{{ $rotaJOgador }}">Agendar</a>
                                              @endif
                                              <i>vs</i>
                                              @if($partida->jogador2)
                                                  <a href="{{ route('jogador', $partida->jogador2->uuid) }}">
                                                  {{ substr($partida->jogador2->nome, 0, 12) }}</a>
                                              @else
                                                <a class="btn btn-success btn-sm btn-flat" href="{{ $rotaJOgador }}">Agendar</a>
                                              @endif
                                            </h4>

                                            @if($partida->inicio < now())
                                                <h3>{{$partida->jogador1_resultado_final}} x {{$partida->jogador2_resultado_final}}</h3>
                                            @endif

                                            <p>{{ $partida->quadra->nome }}</p>
                                        </div>
                                    </div>
                                    @if($partida->inicio < now())
                                    <div class="event-box-footer">
                                      @if($partida->jogador1)
                                      <div class="widget">
                                        <div class="social-counter">
                                            <ul>
                                                <li>
                                                    <a class="item twitter">
                                                      <span class="count">{{$partida->jogador1_set1}} x {{$partida->jogador2_set1}}</span>
                                                      <em>1º SET</em> </a>
                                                </li>
                                                <li>
                                                    <a class="item ">
                                                      <span class="count">{{$partida->jogador1_set2}} x {{$partida->jogador2_set2}}</span>
                                                      <em>2º SET</em> </a>
                                                </li>
                                                <li>
                                                    <a class="item twitter">
                                                      <span class="count">{{$partida->jogador1_set3}} x {{$partida->jogador2_set3}}</span>
                                                      <em>3º SET</em> </a>
                                                </li>
                                                <li>
                                                    <a class="item ">
                                                      <span class="count">{{$partida->jogador1_resultado_final}} x {{$partida->jogador2_resultado_final}}</span>
                                                      <em>SETS</em> </a>
                                                </li>
                                                <li>
                                                    <a class="item twitter">
                                                      <span class="count">{{$partida->jogador1_pontos}} x {{$partida->jogador2_pontos}}</span><em>Pontos</em> </a>
                                                </li>
                                                <li>
                                                    <a class="item">
                                                      <span class="count">{{$partida->jogador1_bonus}} x {{$partida->jogador2_bonus}}</span><em>Bonus</em> </a>
                                                </li>
                                                <li></li>
                                            </ul>
                                        </div>
                                      @endif
                                    </div>
                                    @endif
                                </li>

                              @endforeach
                            </ul>
                      </div>
                  @else

                      <div class="alert alert-info">Nenhuma partida foi agendada até o momento para este dia. </div>

                  @endif
              </div>
          </div>
      </div>
  </div>

</div>

<div class="modal inmodal" id="cadastra-consulta-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <i class="fa fa-clock-o modal-icon"></i>
                <h4 class="modal-title">Consulta</h4>
                <small>Registre nova consulta</small>
            </div>

            <form id="formConsultaModal" method="POST" action="#">
            <div class="modal-body">

                  {{  csrf_field() }}
                  <div class="row">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Notas do agendamento</label>
                            <div class="input-group col-md-12 col-xs-12 col-sm-12">
                                <textarea class="form-control" rows="6" id="consulta-notas" name="notas"></textarea>
                            </div>
                        </div>
                    </div>

                  </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white pull-left" data-dismiss="modal">Fechar</button>
                <button type="submit" id="btnConsulta" class="btn btn-primary">Marcar Consulta</button>
            </div>
            </form>
        </div>
    </div>
</div>


<input type="hidden" id="partidas-ajax" value="{{ route('partidas_ajax') }}">
<input type="hidden" id="now" value="{{ now()->format('c') }}">
@endsection

@section('js')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

  <script src="{{ asset('js/fullcalendar/moment.min.js') }}"></script>
  <script src="{{ asset('js/fullcalendar/fullcalendar.min.js') }}"></script>

  <script>

  function popularModal(event) {
    $("#formConsultaModal").prop('action', '/professional/consults/' + event.id + '/update');
    $("#cadastra-consulta-modal").modal('show');
    $("#cadastra-consulta-modal").find('#title').val(event.title);
    $("#consulta-inicio").val(event.start.format('DD/MM/YYYY HH:mm'));
    $("#consulta-fim").val(event.end.format('DD/MM/YYYY HH:mm'));
    $("#consulta-notas").val(event.notas);
  }

  $('.calendar').fullCalendar({
    height: 380,
    contentHeight: 590,
    lang: 'pt-br',
    defaultView: 'month',
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
        right: 'month'
    },
    navLinks: true,
    selectable: true,
    selectHelper: true,
    select: function(start, end, jsEvent, view) {

        var view = $('.calendar').fullCalendar('getView');

        if(view.name == 'agendaDay' || view.name == 'agendaWeek') {

          limparModal();

          $("#cadastra-consulta-modal").modal('show');
          $("#consulta-inicio").val(start.format('DD/MM/YYYY HH:mm'));
          $("#consulta-fim").val(end.format('DD/MM/YYYY HH:mm'));

        }

    },
    eventClick: function(event, element, view) {
        //popularModal(event);
    },
    editable: false,
    allDaySlot: false,
    dayClick: function(date, jsEvent, view) {

        jsEvent.preventDefault();

        window.location.href = '?date=' + date.format('DD/MM/YYYY');

          /*
          setTimeout(function() {

            //limparModal();

            //$("#formConsultaModal").prop('action', $("#consultas-store").val());

            if(view.name == 'month') {
              //$('.calendar').fullCalendar('gotoDate', date);
              //$('.calendar').fullCalendar('changeView','agendaDay');
            }

          }, 100);
          */

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

@extends('layouts.layout')

@section('css')
    <style>

      .event-txt-wrap .event-txt {
        width: 100%;
      }

      .calendar {
        cursor: pointer !important;
      }

      .match-fixture-inner li {
        width: 100%;
        float: none;
      }

      .points-listing td {
        padding:0;
        line-height:20px;
        vertical-align:top;
      }

      .inner-banner {
        background: url('images/banners/BANNER-1.png') no-repeat center center;
      }

    </style>
    <link href="{{ asset('css/fullcalendar.css') }}" rel="stylesheet"/>
@stop

@section('content')

<!--Inner Banner Start-->
<div class="inner-banner">

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

    <!--Ticket Listing Page Start-->
    <div class="ticket-listing">
        <div class="container">
            <div class="row">

              <div class="col-md-{{ \Request::has('date') ? '3' : '12' }}">
                  <div class="calendar"></div>
              </div>

              <div class="col-md-9 table-responsive" {{ !\Request::has('date') ? 'style=display:none' : "" }}>
                <div class="tickets-sort"> <a href="#" class="pull-left"><i class="fa fa-map-marker"></i><span> Todas as Partidas </span> <i class="fa fa-angle-right"></i></a>
                  <a href="#" class="pull-right"><i class="fa fa-calendar"></i><span>Calendario</span><i class="fa fa-angle-right"></i></a>
                </div>
                  <table class="points-listing">
                      <thead>
                          <tr class="first">
                              <th>Horario</th>
                              @php

                                $quadras = \App\Models\Quadras::where('ativo',true)->get();

                              @endphp

                              @foreach($quadras as $quadra)
                                  <th>{{$quadra->nome}}</th>
                              @endforeach
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($partidas as $key => $partida)
                            <tr>
                                <td>{{ $key }}</td>
                                <td>
                                  @if(isset($partida['quadra-1']))

                                  <div class="match-box">
                                      <ul class="match-fixture-inner">
                                          <li class="team"> <strong>

                                            @if($partida['quadra-1']['jogador1'])


                                              {{$partida['quadra-1']['jogador1']}}


                                            @else

                                              @php

                                                $user = \Auth::user();

                                                if(\Auth::check() && $user->isAdmin()) {
                                                  $rotaJOgador = route('agendar_partida_jogador', ['id' => $partida['quadra-1']['id']]);
                                                } else {
                                                  $rotaJOgador = route('player_agendar_partida_jogador', ['id' => $partida['quadra-1']['id']]);
                                                }

                                              @endphp

                                              <a class="btn btn-sm btn-flat btn-success" href="{{ $rotaJOgador }}">Agendar</a>


                                            @endif



                                          </strong></li>
                                          <li class="time-batch"> <strong class="m-vs">VS</strong></li>
                                          <li class="team">
                                            <strong>
                                            @if($partida['quadra-1']['jogador2'])


                                              {{$partida['quadra-1']['jogador2']}}


                                            @else

                                              @php

                                                $user = \Auth::user();

                                                if(\Auth::check() && $user->isAdmin()) {
                                                  $rotaJOgador = route('agendar_partida_jogador', ['id' => $partida['quadra-1']['id']]);
                                                } else {
                                                  $rotaJOgador = route('player_agendar_partida_jogador', ['id' => $partida['quadra-1']['id']]);
                                                }

                                              @endphp

                                              <a class="btn btn-sm btn-flat btn-success" href="{{ $rotaJOgador }}">Agendar</a>


                                            @endif


                                            </strong></li>
                                      </ul>
                                  </div>

                                  @endif
                                </td>
                                <td>
                                  @if(isset($partida['quadra-2']))

                                    <div class="match-box">
                                        <ul class="match-fixture-inner">
                                            <li class="team"> <strong>

                                              @if($partida['quadra-2']['jogador1'])


                                                {{$partida['quadra-2']['jogador1']}}


                                              @else

                                                @php

                                                  $user = \Auth::user();

                                                  if(\Auth::check() && $user->isAdmin()) {
                                                    $rotaJOgador = route('agendar_partida_jogador', ['id' => $partida['quadra-2']['id']]);
                                                  } else {
                                                    $rotaJOgador = route('player_agendar_partida_jogador', ['id' => $partida['quadra-2']['id']]);
                                                  }

                                                @endphp

                                                <a class="btn btn-sm btn-flat btn-success" href="{{ $rotaJOgador }}">Agendar</a>


                                              @endif

                                            </strong></li>
                                            <li class="time-batch"> <strong class="m-vs">VS</strong></li>
                                            <li class="team"> <strong>

                                              @if($partida['quadra-2']['jogador2'])


                                                {{$partida['quadra-2']['jogador2']}}


                                              @else

                                                @php

                                                  $user = \Auth::user();

                                                  if(\Auth::check() && $user->isAdmin()) {
                                                    $rotaJOgador = route('agendar_partida_jogador', ['id' => $partida['quadra-2']['id']]);
                                                  } else {
                                                    $rotaJOgador = route('player_agendar_partida_jogador', ['id' => $partida['quadra-2']['id']]);
                                                  }

                                                @endphp

                                                <a class="btn btn-sm btn-flat btn-success" href="{{ $rotaJOgador }}">Agendar</a>

                                              @endif

                                            </strong></li>
                                        </ul>
                                    </div>

                                  @endif
                                </td>
                                <td>
                                  @if(isset($partida['quadra-3']))

                                  <div class="match-box">
                                      <ul class="match-fixture-inner">
                                          <li class="team"> <strong>

                                            @if($partida['quadra-3']['jogador1'])


                                              {{$partida['quadra-3']['jogador1']}}


                                            @else

                                              @php

                                                $user = \Auth::user();

                                                if(\Auth::check() && $user->isAdmin()) {
                                                  $rotaJOgador = route('agendar_partida_jogador', ['id' => $partida['quadra-3']['id']]);
                                                } else {
                                                  $rotaJOgador = route('player_agendar_partida_jogador', ['id' => $partida['quadra-3']['id']]);
                                                }

                                              @endphp

                                              <a class="btn btn-sm btn-flat btn-success" href="{{ $rotaJOgador }}">Agendar</a>

                                            @endif

                                          </strong></li>
                                          <li class="time-batch"> <strong class="m-vs">VS</strong></li>
                                          <li class="team"> <strong>

                                            @if($partida['quadra-3']['jogador2'])


                                              {{$partida['quadra-3']['jogador2']}}


                                            @else

                                              @php

                                                $user = \Auth::user();

                                                if(\Auth::check() && $user->isAdmin()) {
                                                  $rotaJOgador = route('agendar_partida_jogador', ['id' => $partida['quadra-3']['id']]);
                                                } else {
                                                  $rotaJOgador = route('player_agendar_partida_jogador', ['id' => $partida['quadra-3']['id']]);
                                                }

                                              @endphp

                                              <a class="btn btn-sm btn-flat btn-success" href="{{ $rotaJOgador }}">Agendar</a>

                                            @endif


                                          </strong></li>
                                      </ul>
                                  </div>

                                  @endif
                                </td>
                                <td>
                                  @if(isset($partida['quadra-4']))

                                  <div class="match-box">
                                      <ul class="match-fixture-inner">
                                          <li class="team"> <strong>

                                            @if($partida['quadra-4']['jogador1'])


                                              {{$partida['quadra-4']['jogador1']}}


                                            @else

                                              @php

                                                $user = \Auth::user();

                                                if(\Auth::check() && $user->isAdmin()) {
                                                  $rotaJOgador = route('agendar_partida_jogador', ['id' => $partida['quadra-4']['id']]);
                                                } else {
                                                  $rotaJOgador = route('player_agendar_partida_jogador', ['id' => $partida['quadra-4']['id']]);
                                                }

                                              @endphp

                                              <a class="btn btn-sm btn-flat btn-success" href="{{ $rotaJOgador }}">Agendar</a>

                                            @endif

                                          </strong></li>
                                          <li class="time-batch"> <strong class="m-vs">VS</strong></li>
                                          <li class="team"> <strong>


                                            @if($partida['quadra-4']['jogador2'])


                                              {{$partida['quadra-4']['jogador2']}}


                                            @else

                                              @php

                                                $user = \Auth::user();

                                                if(\Auth::check() && $user->isAdmin()) {
                                                  $rotaJOgador = route('agendar_partida_jogador', ['id' => $partida['quadra-4']['id']]);
                                                } else {
                                                  $rotaJOgador = route('player_agendar_partida_jogador', ['id' => $partida['quadra-4']['id']]);
                                                }

                                              @endphp

                                              <a class="btn btn-sm btn-flat btn-success" href="{{ $rotaJOgador }}">Agendar</a>

                                            @endif


                                          </strong></li>
                                      </ul>
                                  </div>

                                  @endif
                                </td>
                                <td>
                                  @if(isset($partida['quadra-5']))

                                  <div class="match-box">
                                      <ul class="match-fixture-inner">
                                          <li class="team"> <strong>

                                            @if($partida['quadra-5']['jogador1'])


                                              {{$partida['quadra-5']['jogador1']}}


                                            @else

                                              @php

                                                $user = \Auth::user();

                                                if(\Auth::check() && $user->isAdmin()) {
                                                  $rotaJOgador = route('agendar_partida_jogador', ['id' => $partida['quadra-5']['id']]);
                                                } else {
                                                  $rotaJOgador = route('player_agendar_partida_jogador', ['id' => $partida['quadra-5']['id']]);
                                                }

                                              @endphp

                                              <a class="btn btn-sm btn-flat btn-success" href="{{ $rotaJOgador }}">Agendar</a>

                                            @endif

                                          </strong></li>
                                          <li class="time-batch"> <strong class="m-vs">VS</strong></li>
                                          <li class="team"> <strong>

                                            @if($partida['quadra-5']['jogador2'])


                                              {{$partida['quadra-5']['jogador2']}}


                                            @else

                                              @php

                                                $user = \Auth::user();

                                                if(\Auth::check() && $user->isAdmin()) {
                                                  $rotaJOgador = route('agendar_partida_jogador', ['id' => $partida['quadra-5']['id']]);
                                                } else {
                                                  $rotaJOgador = route('player_agendar_partida_jogador', ['id' => $partida['quadra-5']['id']]);
                                                }

                                              @endphp

                                              <a class="btn btn-sm btn-flat btn-success" href="{{ $rotaJOgador }}">Agendar</a>

                                            @endif

                                          </strong></li>
                                      </ul>
                                  </div>

                                  @endif
                                </td>
                                <td>
                                  @if(isset($partida['quadra-6']))

                                  <div class="match-box">
                                      <ul class="match-fixture-inner">
                                          <li class="team"> <strong>

                                            @if($partida['quadra-6']['jogador1'])


                                              {{$partida['quadra-6']['jogador1']}}


                                            @else

                                              @php

                                                $user = \Auth::user();

                                                if(\Auth::check() && $user->isAdmin()) {
                                                  $rotaJOgador = route('agendar_partida_jogador', ['id' => $partida['quadra-6']['id']]);
                                                } else {
                                                  $rotaJOgador = route('player_agendar_partida_jogador', ['id' => $partida['quadra-6']['id']]);
                                                }

                                              @endphp

                                              <a class="btn btn-sm btn-flat btn-success" href="{{ $rotaJOgador }}">Agendar</a>

                                            @endif

                                          </strong></li>
                                          <li class="time-batch"> <strong class="m-vs">VS</strong></li>
                                          <li class="team"> <strong>

                                            @if($partida['quadra-6']['jogador2'])


                                              {{$partida['quadra-6']['jogador2']}}


                                            @else

                                              @php

                                                $user = \Auth::user();

                                                if(\Auth::check() && $user->isAdmin()) {
                                                  $rotaJOgador = route('agendar_partida_jogador', ['id' => $partida['quadra-6']['id']]);
                                                } else {
                                                  $rotaJOgador = route('player_agendar_partida_jogador', ['id' => $partida['quadra-6']['id']]);
                                                }

                                              @endphp

                                              <a class="btn btn-sm btn-flat btn-success" href="{{ $rotaJOgador }}">Agendar</a>

                                            @endif

                                          </strong></li>
                                      </ul>
                                  </div>

                                  @endif
                                </td>
                            </tr>
                        @endforeach

                      </tbody>
                  </table>
              </div>

            </div>
        </div>
    </div>
    <!--Ticket Listing Page End-->

    <input type="hidden" id="partidas-ajax" value="{{ route('partidas_ajax') }}">
    <input type="hidden" id="now" value="{{ now()->format('c') }}">

</div>

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
        left: 'prev,next',
        center: 'title',
        right: ''
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

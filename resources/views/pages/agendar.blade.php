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

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet">
@stop

@section('content')

<!--Inner Banner Start-->
<div class="inner-banner">
    <h1>Agendar Partida</h1>
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
              <div class="col-md-12">

                <form method="post" action="{{ route('partida_jogador_store', $partida->id) }}">

                <div class="match-fixture-thumb">
                  <ul class="fix">
                    @if($partida->resultado->isNotEmpty())
                    <li class="team-logo"> <img src="#" alt=""> <strong>{{ substr($partida->resultado->first()->jogador->pessoa->nome, 0, 12) }}</strong> </li>
                    <input type="hidden" name="jogador[]" value="{{ $partida->resultado->first()->jogador->id }}"/>
                    @else
                    <li class="team-logo">

                      <select class="form-control select2 select-jogador" style="width:270px" name="jogador[]">
                          <option value=""></option>

                      </select>

                     </li>
                    @endif
                    <li class="t-vs"> <span>vs</span></li>
                    @if($jogador)
                    <li class="team-logo"> <img src="#" alt=""> <strong>{{ $jogador->pessoa->nome }}</strong> </li>
                    @else
                    <li class="team-logo">

                      <h3>Indefinido</h3>

                     </li>
                    @endif
                  </ul>
                  <ul class="post-meta">
                    <li><i class="fa fa-calendar"></i> {{ $partida->data->format('d M Y') }}</li>
                    <!--
                    <li><i class="fa fa-thumbs-up"></i> 178 Likes</li>
                    <li><i class="fa fa-comment"></i> 56 Comments</li>
                    -->

                        <li class="buy">

                            {{csrf_field()}}
                            @if($jogador)
                            <input type="hidden" name="jogador[]" value="{{ $jogador->id }}">
                            @endif
                            <button type="submit" class="btn btn-info">Agendar</button>

                        </li>

                  </ul>
                </div>

                </form>

              </div>
          </div>
      </div>
  </div>

</div>

<input type="hidden" id="jogador-ajax" value="{{ route('jogadores_ajax') }}"/>

@endsection

@section('js')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/i18n/pt-BR.js"></script>

  <script>

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

  </script>

@stop

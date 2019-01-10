<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title_prefix', config('adminlte.title_prefix', ''))
@yield('title', config('adminlte.title', 'AdminLTE 2'))
@yield('title_postfix', config('adminlte.title_postfix', ''))</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/Ionicons/css/ionicons.min.css') }}">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/AdminLTE.min.css') }}">

    <link rel="stylesheet"  href="{{ asset('css/app.css') }}"/>
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css"/>

    @yield('adminlte_css')

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition @yield('body_class')">

@yield('body')

<script src="{{ asset('js/jquery-2.1.4.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.20.6/sweetalert2.all.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/i18n/pt-BR.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.pt-BR.min.js"></script>

@yield('adminlte_js')

<script>

  $(document).ready(function() {

    $('.money').mask('000.000.000.000.000,00', {reverse: true});
    $('.date').mask('00/00/0000');
    $('.time').mask('00:00:00');
    $('.cep').mask('00000-000');

    $('.datepicker').datepicker({
      format: "dd/mm/yyyy",
      clearBtn: true,
      todayBtn: "linked",
      language: "pt-BR",
      calendarWeeks: true,
      autoclose: true,
      todayHighlight: true
    });

  })



</script>

<script>

  $(".btnRemoveItem").click(function(e) {
      var self = $(this);

      swal({
        title: 'Remover este item?',
        text: "Não será possível recuperá-lo!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim',
        cancelButtonText: 'Cancelar'
        }).then((result) => {
        if (result.value) {

          e.preventDefault();

          $.ajax({
            headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
            url: self.data('route'),
            type: 'POST',
            dataType: 'json',
            data: {
              _method: 'DELETE'
            }
          }).done(function(data) {

            if(data.code == 201) {
                self.parents('tr').hide();
                swal(
                  'Ok!',
                  data.message,
                  'success'
                )
            } else {

              swal(
                'Ok!',
                data.message,
                'error'
              )

            }

          });


        }
      });

  });

  $('#cep').blur(function() {

    var self = $(this);
    var cep = self.val();
    var url = self.data('url');

    if(cep.length > 7) {

        $.ajax(
          {
            url: url,
            data: {
              cep: cep
            },
            dataType: 'json'
          }
        ).done(function(data) {

          if(data.success === false) {

            swal(
              'Atenção!',
              'Endereço não encontrado',
              'error'
            )

          } else {

            var info = data.data;

            $("#cep").val(info.cep);
            $("#endereco").val(info.logradouro);
            $("#bairro").val(info.bairro);
            $("#cidade").val(info.localidade);
            $("#estado").val(info.uf);

            $("#numero").focus();

          }


        })

    } else {

      swal(
        'Atenção!',
        'O CEP deve conter 8 digitos.',
        'info'
      )

    }

  });

</script>

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
  "</div>" +
  "</div></div>";

  return markup;
}

function formatRepoSelection (repo) {
  return repo.full_name || repo.text;
}

</script>

</body>
</html>

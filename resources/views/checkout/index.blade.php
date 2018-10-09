@extends('adminlte::page')

@section('title', 'Checkout')

@section('content_header')
    <h1>Checkout</h1>
@stop

@section('content')
<section class="invoice">
  <form method="post" action="{{ route('checkout_sale') }}">
    {{ csrf_field() }}
  <!-- title row -->
  <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header">
        <i class="fa fa-globe"></i> BSports Tennis & Fitness.
        <small class="pull-right">Data: {{ now()->format('d/m/Y') }}</small>
      </h2>
    </div>
    <!-- /.col -->
  </div>
  <!-- info row -->
  <div class="row invoice-info">
    <div class="col-sm-4 invoice-col">
      De
      <address>
        <strong>B.Sports Tennis & Fitness.</strong><br>
        Rua Dona Ana Pimentel, 272<br>
        Perdizes - São Paulo/SP<br>
        Fone: (11) 3871.9555<br>
        Email: bsports@bsports.com.br
      </address>
    </div>
    <!-- /.col -->
    <div class="col-sm-4 invoice-col">
      Para
      <address>
        <strong>{{ $mensalidade->jogador->pessoa->nome }}</strong><br>

        <!--795 Folsom Ave, Suite 600<br>
        San Francisco, CA 94107<br>
        Phone: (555) 539-1037<br>
      -->
        Email: {{ $mensalidade->jogador->pessoa->email }}
      </address>
    </div>
    <!-- /.col -->
    <div class="col-sm-4 invoice-col">
      <b>Fatura #{{ $mensalidade->id }}</b><br>
      <b>Data pagamento:</b> {{ now()->format('d/m/Y') }}<br>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <!-- Table row -->
  <div class="row">
    <div class="col-xs-12 table-responsive">
      <table class="table table-bordered">
        <thead>
        <tr>
          <th>Qtd</th>
          <th>Produto</th>
          <th>Referência #</th>
          <th>Descrição</th>
          <th>Subtotal</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>1</td>
          <td>Plano Mensal</td>
          <td>{{ $mensalidade->uuid }}</td>
          <td>{{ 'BSports PLano Mensal' }}</td>
          <td>R$ {{ $mensalidade->valor }}</td>
        </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <div class="row">
    <!-- accepted payments column -->
    <div class="col-xs-6">
      <p class="lead">Metodos de Pagamento:</p>
      <img src="{{ asset('/images/pagseguro.png') }}" style="max-width:128px" alt="PagSeguro">
      <!--
      <img src="../../dist/img/credit/visa.png" alt="Visa">
      <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
      <img src="../../dist/img/credit/american-express.png" alt="American Express">
      <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

      <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
        dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
      </p>
      -->

    </div>
    <!-- /.col -->
    <div class="col-xs-6">
      <p class="lead">Valor Total {{ now()->format('d/m/Y') }}</p>


      <div class="table-responsive">
        <table class="table">
          <tbody><tr>
            <th style="width:50%">Subtotal:</th>
            <td>R$ {{ $mensalidade->valor }}</td>
          </tr>
          <tr>
            <th>Total:</th>
            <td>R$ {{ $mensalidade->valor }}</td>
          </tr>
        </tbody></table>
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <div class="row">

    <div class="col-md-3">
      <p class="lead">Informações Complementares</p>
      <strong>Telefone: </strong><input type="text" class="form-control phone" autocomplete="off" value="{{ $mensalidade->jogador->pessoa->telefone }}" name="telefone" required><br>
      <strong>CPF: </strong><input type="text" class="form-control cpf" autocomplete="off" value="{{ $mensalidade->jogador->pessoa->cpf }}" name="cpf" required><br>
      <strong>Nascimento: </strong><input type="text" class="form-control date" autocomplete="off" value="{{ $mensalidade->jogador->pessoa->nascimento->format('d/m/Y') ?? '-' }}" name="nascimento" required><br>
    </div>

    <div class="col-md-2">

      <p class="lead">Pagamento</p>

      <div class="row">

        <div class="col-md-12">

          <div id="paymentMethodsOptions">

            <div class="field radio">
              <label><input type="radio" id="creditCardRadio" name="changePaymentMethod" value="creditCard">Cartão de Crédito</label>
            </div>

            <div class="field radio">
              <label><input type="radio" id="boletoRadio" name="changePaymentMethod" value="boleto">Boleto</label>
            </div>

          </div>

        </div>

      </div>

    </div>

    <div class="col-md-4">

      <p class="lead">Dados do Cartão</p>

      <input type="hidden" name="creditCardToken" id="creditCardToken"  />
      <input type="hidden" name="creditCardBrand" id="creditCardBrand"  />

      <div class="row">

        <div class="col-md-12">

          <strong>Número: </strong><input id="cardNumber" type="text" class="form-control cardDatainput" autocomplete="off" name="cardNumber" required maxlength="16"/>
          <span>
              <img class="bandeiraCartao" id="bandeiraCartao"/>
          </span>

        </div>

        <div class="col-md-12">

          <div class="row">

            <div class="col-md-6">

              <strong>Data de Vencimento (99/9999): </strong>

              <div class="row">
                <div class="col-md-6">
                    <input id="cardExpirationMonth" type="text" class="form-control cardDatainput" autocomplete="off" name="cardExpirationMonth" required maxlength="2"/>
                </div>
                <div class="col-md-6" style="padding-left:0">
                    <input id="cardExpirationYear" type="text" class="form-control cardDatainput" autocomplete="off" name="cardExpirationYear" required maxlength="4"/>
                </div>
              </div>
            </div>

            <div class="col-md-6">

              <strong>Código de Segurança: </strong><input id="cardCvv" type="text" class="form-control cardDatainput" autocomplete="off" name="cardCvv" required maxlength="3"/>

            </div>

          </div>
          <br/>

        </div>

        <div class="col-md-12">

          <div class="" id="installmentsWrapper">
            <strong>Parcelamento: </strong>
            <select class="form-control cardDatainput" name="installmentQuantity" id="installmentQuantity"></select>
            <input type="hidden" name="installmentValue" id="installmentValue" />
            <input type="hidden" name="totalAmount" id="totalAmount" />
          </div>

        </div>

        <div class="col-md-12">

          <div id="holderDataChoice">

            <div class="checkbox">
              <input type="radio" name="holderType" id="sameHolder" value="sameHolder"/><label for="sameHolder">mesmo que o comprador</label>
            </div>

            <div class="checkbox">
              <input checked type="radio" name="holderType" id="otherHolder" value="otherHolder"/><label for="otherHolder">outro</label>
            </div>

          </div>

        </div>

        <div class="col-md-12">

          <strong>Data de Nascimento do Titular do Cartão: </strong>
          <input id="creditCardHolderBirthDate" type="text" class="form-control cardDatainput" autocomplete="off" name="creditCardHolderBirthDate" required maxlength="10"/>
          <br/>

        </div>

        <div class="col-md-12">

          <strong>Nome (Como está impresso no cartão): </strong>
          <input id="creditCardHolderName" type="text" class="form-control cardDatainput" autocomplete="off" name="creditCardHolderName" required/>
          <br/>

        </div>

        <div class="col-md-12">

          <strong>CPF (somente n&uacute;meros): </strong>
          <input id="creditCardHolderCPF" type="text" class="form-control cardDatainput" autocomplete="off" name="creditCardHolderCPF" required/>
          <br/>

        </div>

        <div class="col-md-12">

          <strong>Telefone: </strong>

          <div class="row">
            <div class="col-md-2">
                <input id="creditCardHolderAreaCode" type="text" class="form-control cardDatainput" placeholder="DDD" autocomplete="off" name="creditCardHolderAreaCode" required maxlength="2"/>
            </div>
            <div class="col-md-10" style="padding-left:0">
                <input id="creditCardHolderPhone" type="text" class="form-control cardDatainput" placeholder="Número" autocomplete="off" name="creditCardHolderPhone" required maxlength="9"/>
            </div>
          </div>

        </div>

        <div class="col-md-12">

        </div>

      </div>


    </div>

    <div class="col-md-3">

      <p class="lead">Boleto</p>

      <div class="col-md-12">

        <div id="boletoData" name="boletoData" class="paymentMethodGroup" dataMethod="boleto">
          <button id="boletoButton" class="btn btn-primary btn-block" />Gerar Boleto e Finalizar Compra</button>
        </div>

      </div>

    </div>

  </div>

  <!-- this row will not appear when printing -->
  <div class="row no-print">
    <div class="col-xs-12">
      <!--
      <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
    -->
      <input type="hidden" value="{{ $mensalidade->uuid }}" name="mensalidade">
      <button type="submit" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Comprar
      </button>
      <!--
      <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
        <i class="fa fa-download"></i> Generate PDF
      </button>
    -->
    </div>
  </div>
  </form>
</section>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
      $('.cpf').mask('000.000.000-00', {reverse: true, placeholder: "___.___.___-__"});
      $('.date').mask("00/00/0000", {placeholder: "__/__/____"})
      $('.phone').mask('(00) 00000-0000');
    </script>
@stop

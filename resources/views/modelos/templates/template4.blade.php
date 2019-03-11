<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>E-mails</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <script src="{{ asset('plugins/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/html2canvas.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/promise.min.js') }}"></script>
    <style type="text/css">
      body {margin: 0; padding: 0; min-width: 100%!important;font-weight: bold;}
      .content {width: 100%; max-width: 600px;}
      .font-title { font-family: 'Roboto', sans-serif; font-size: 30px; color: #0330B5;}
      .font-roboto { font-family: 'Roboto', sans-serif; font-size: 30px; color: #000000;}
      .font {font-family: 'Open Sans', sans-serif; font-size: 20px; color: #000000;}
  		.center {text-align: center;}

  		.release-label {
  			font-family: Helvetica, Arial;
  			padding: 8px 8px;
  			font-size: 14px;
  			font-weight: 600;
  			color: #6a737d;
  			background-color: #fff;
  			border: 1px solid #6a737d;
  			border-top-color: rgb(106, 115, 125);
  			border-right-color: rgb(106, 115, 125);
  			border-bottom-color: rgb(106, 115, 125);
  			border-left-color: rgb(106, 115, 125);
  			border-radius: 3px;
  		}
  		.release-label.prerelease {
  			color: #f66a0a;
  			background-color: #fff;
  			border-color: #f66a0a;
  			cursor: pointer;
  		}

  		.align-div {
  			padding: 10px 10px;
  			float: left;
  			width: 100%;
  			text-align: center;
  		}

  		.container-all {
  			width: 100%;
  			float: left;
  			position: relative;
  			margin-top: 10px;
  		}

  		.container {
  			margin: 0 auto;
  			background-color: #000;
  			width: 900px;
  			height: auto;
  		}

  		.div-title {
  			width: 100%;
  			height: 200px;
  		}

  			.alert-maxxxx {
  				min-width: 100%;
  				min-height: 100%;
  				width: 100%;
  				height: 100%;
  				background-color: rgba(0, 0, 0, .9);
  				position: absolute;
  				z-index: 9999999;
  			}

  			.paragrafo {
  				font-size: 20px;
  				width: 100%;
  				float: left;
  				margin-top: 200px;
  				text-align: center;
  				color: #FFF;
  			}
      </style>
    </head>
    <body yahoo bgcolor="#FFFFFF">
		<div class="alert-maxxxx" style='display: none;'>
			<p class='paragrafo'>
				Aguarde, salvando o template ...
			</p>
		</div>
		<div class="container-all">
			<div class="align-div">
				<input type="text" id='nomePropaganda' placeholder='Digite o nome da propaganda' value='{{$name}}' />
				<button class="salvar-mod4 release-label prerelease">SALVAR TEMPLATE</button>
			</div>
		</div>
    	<table width="100%" bgcolor="#FFFFFF" border="0" cellpadding="0" cellspacing="0">
	        <table id='top0' width="902" height="200" align="center" bgcolor="#FFFFFF" background="{{ asset('images/campanha_digital_1.jpg') }}" style='border-left: 1px solid #0138b9; border-right: 1px solid #0138b9' cellpadding="0" cellspacing="0">
	            <tr>
	                <td>
	                    <table class="content" align="center" cellpadding="0" cellspacing="0" border="0">
	                        <tr>
	                            <td style="padding: 20px" class="font-title center">
	                                {{$text1}}
	                            </td>
	                        </tr>
	                        <tr>
	                            <td style="padding-bottom: 10px" class="font-title center">
	                                {{$text2}}
	                            </td>
	                        </tr>
	                    </table>
	                </td>
	            </tr>
	        </table>
	        <table width="900" align="center" bgcolor="#FFFFFF" style='border-top: 1px solid #0138b9; border-left: 1px solid #0138b9; border-right: 1px solid #0138b9' cellpadding="0" cellspacing="0">
	            <tr>
	            	<td>
						<table id='top1' bgcolor="#FFFFFF" width="900" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td width="450" style="border-right: 1px solid #0138b9;">
									<img src="{{ route('external_images', ['link'=> $d5]) }}" width="450" height="250" />
								</td>
								<td width="450">
									<table cellpadding="0" cellspacing="0" border="0" class="font" style="padding-left: 40px; padding-top: 5px; font-family: 'Roboto', sans-serif; font-size: 14px;">
										<tr><td width="450" style="text-align: center;">&nbsp;{{$d37}}</td></tr>
										<tr><td width="450" style="text-align: center;">&nbsp;{{$d33}}</td></tr>
									</table>
									<table cellpadding="0" cellspacing="0" border="0" class="font" style="padding-left: 40px; padding-top: 5px; font-family: 'Roboto', sans-serif; font-size: 14px;">
										<td width="22"><img align="left" src="{{ asset('images/icons/cama.png') }}" class="padding-right" height="20"></td>
										<td width="428" style="text-align: left;">&nbsp;{{$d1}}</td>
									</table>
									<table cellpadding="0" cellspacing="0" border="0" class="font" style="padding-left: 40px; padding-top: 5px; font-family: 'Roboto', sans-serif; font-size: 14px;">
										<td width="22"><img align="left" src="{{ asset('images/icons/chuveiro.png') }}" class="padding-right" height="20"></td>
										<td width="428" style="text-align: left;">&nbsp;{{$d2}}</td>
									</table>
									<table cellpadding="0" cellspacing="0" border="0" class="font" style="padding-left: 40px; padding-top: 5px; font-family: 'Roboto', sans-serif; font-size: 14px;">
										<td width="22"><img align="left" src="{{ asset('images/icons/carro.png') }}" class="padding-right" height="20"></td>
										<td width="428" style="text-align: left;">&nbsp;{{$d3}}</td>
									</table>
									<table cellpadding="0" cellspacing="0" border="0" class="font" style="padding-left: 40px; padding-top: 5px; font-family: 'Roboto', sans-serif; font-size: 14px;">
										<td width="22"><img align="left" src="{{ asset('images/icons/area.png') }}" class="padding-right" height="20"></td>
										<td width="428" style="text-align: left;">&nbsp;{{$d4}}</td>
									</table>
									<p class="font" style="padding-left: 40px; font-family: 'Roboto', sans-serif; font-size: 14px;">{{$d6}}</p>
									<p class="font" style="padding-left: 40px; font-family: 'Roboto', sans-serif; font-size: 14px;">{{$d7}}</p>
								</td>
							</tr>
						</table>
	            	</td>
	            </tr>
	            <tr>
	            	<td>
						<table id='top2' bgcolor="#FFFFFF" width="900" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td width="449" style="border-right: 1px solid #0138b9; ">
									<table cellpadding="0" cellspacing="0" border="0" class="font" style="padding-left: 40px; padding-top: 5px; font-family: 'Roboto', sans-serif; font-size: 14px;">
										<tr><td width="449" style="text-align: center;">&nbsp;{{$d38}}</td></tr>
										<tr><td width="449" style="text-align: center;">&nbsp;{{$d34}}</td></tr>
									</table>

									<table cellpadding="0" cellspacing="0" border="0" class="font" style="padding-left: 40px; padding-top: 5px; font-family: 'Roboto', sans-serif; font-size: 14px;">
										<td width="22"><img align="left" src="{{ asset('images/icons/cama.png') }}" class="padding-right" height="20"></td>
										<td width="428" style="text-align: left;">&nbsp;{{$d8}}</td>
									</table>

									<table cellpadding="0" cellspacing="0" border="0" class="font" style="padding-left: 40px; padding-top: 5px; font-family: 'Roboto', sans-serif; font-size: 14px;">
										<td width="22"><img align="left" src="{{ asset('images/icons/chuveiro.png') }}" class="padding-right" height="20"></td>
										<td width="428" style="text-align: left;">&nbsp;{{$d9}}</td>
									</table>

									<table cellpadding="0" cellspacing="0" border="0" class="font" style="padding-left: 40px; padding-top: 5px; font-family: 'Roboto', sans-serif; font-size: 14px;">
										<td width="22"><img align="left" src="{{ asset('images/icons/carro.png') }}" class="padding-right" height="20"></td>
										<td width="428" style="text-align: left;">&nbsp;{{$d10}}</td>
									</table>

									<table cellpadding="0" cellspacing="0" border="0" class="font" style="padding-left: 40px; padding-top: 5px; font-family: 'Roboto', sans-serif; font-size: 14px;">
										<td width="22"><img align="left" src="{{ asset('images/icons/area.png') }}" class="padding-right" height="20"></td>
										<td width="428" style="text-align: left;">&nbsp;{{$d11}}</td>
									</table>
									<p class="font" style="padding-left: 40px; font-family: 'Roboto', sans-serif; font-size: 14px;">{{$d13}}</p>
									<p class="font" style="padding-left: 40px; font-family: 'Roboto', sans-serif; font-size: 14px;">{{$d14}}</p>
								</td>
								<td width="449">
									<img src="{{ route('external_images', ['link'=> $d12]) }}" width="449" height="250" />
								</td>
							</tr>
						</table>
	            	</td>
	            </tr>
	            <tr style="border-top: 1px solid #0138b9;">
	            	<td>
						<table id='top3' bgcolor="#FFFFFF" width="900" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td width="450" style="border-right: 1px solid #0138b9;">
									<img src="{{ route('external_images', ['link'=> $d19]) }}" width="450" height="250" />
								</td>
								<td width="449">
									<table cellpadding="0" cellspacing="0" border="0" class="font" style="padding-left: 40px; padding-top: 5px; font-family: 'Roboto', sans-serif; font-size: 14px;">
										<tr><td width="449" style="text-align: center;">&nbsp;{{$d39}}</td></tr>
										<tr><td width="449" style="text-align: center;">&nbsp;{{$d35}}</td></tr>
									</table>
									<table cellpadding="0" cellspacing="0" border="0" class="font" style="padding-left: 40px; padding-top: 5px; font-family: 'Roboto', sans-serif; font-size: 14px;">
										<td width="22"><img align="left" src="{{ asset('images/icons/cama.png') }}" class="padding-right" height="20"></td>
										<td width="428" style="text-align: left;">&nbsp;{{$d15}}</td>
									</table>

									<table cellpadding="0" cellspacing="0" border="0" class="font" style="padding-left: 40px; padding-top: 5px; font-family: 'Roboto', sans-serif; font-size: 14px;">
										<td width="22"><img align="left" src="{{ asset('images/icons/chuveiro.png') }}" class="padding-right" height="20"></td>
										<td width="428" style="text-align: left;">&nbsp;{{$d16}}</td>
									</table>

									<table cellpadding="0" cellspacing="0" border="0" class="font" style="padding-left: 40px; padding-top: 5px; font-family: 'Roboto', sans-serif; font-size: 14px;">
										<td width="22"><img align="left" src="{{ asset('images/icons/carro.png') }}" class="padding-right" height="20"></td>
										<td width="428" style="text-align: left;">&nbsp;{{$d17}}</td>
									</table>

									<table cellpadding="0" cellspacing="0" border="0" class="font" style="padding-left: 40px; padding-top: 5px; font-family: 'Roboto', sans-serif; font-size: 14px;">
										<td width="22"><img align="left" src="{{ asset('images/icons/area.png') }}" class="padding-right" height="20"></td>
										<td width="428" style="text-align: left;">&nbsp;{{$d18}}</td>
									</table>
									<p class="font" style="padding-left: 40px; font-family: 'Roboto', sans-serif; font-size: 14px;">{{$d20}}</p>
									<p class="font" style="padding-left: 40px; font-family: 'Roboto', sans-serif; font-size: 14px;">{{$d21}}</p>
								</td>
							</tr>
						</table>
	            	</td>
	            </tr>
	            <tr style="border-top: 1px solid #0138b9;">
	            	<td>
						<table id='top4' bgcolor="#FFFFFF" width="900" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td width="450" style="border-right: 1px solid #0138b9;">
									<table cellpadding="0" cellspacing="0" border="0" class="font" style="padding-left: 40px; padding-top: 5px; font-family: 'Roboto', sans-serif; font-size: 14px;">
										<tr><td width="450" style="text-align: center;">&nbsp;{{$d40}}</td></tr>
										<tr><td width="450" style="text-align: center;">&nbsp;{{$d36}}</td></tr>
									</table>

									<table cellpadding="0" cellspacing="0" border="0" class="font" style="padding-left: 40px; padding-top: 5px; font-family: 'Roboto', sans-serif; font-size: 14px;">
										<td width="22"><img align="left" src="{{ asset('images/icons/cama.png') }}" class="padding-right" height="20"></td>
										<td width="428" style="text-align: left;">&nbsp;{{$d22}}</td>
									</table>

									<table cellpadding="0" cellspacing="0" border="0" class="font" style="padding-left: 40px; padding-top: 5px; font-family: 'Roboto', sans-serif; font-size: 14px;">
										<td width="22"><img align="left" src="{{ asset('images/icons/chuveiro.png') }}" class="padding-right" height="20"></td>
										<td width="428" style="text-align: left;">&nbsp;{{$d23}}</td>
									</table>

									<table cellpadding="0" cellspacing="0" border="0" class="font" style="padding-left: 40px; padding-top: 5px; font-family: 'Roboto', sans-serif; font-size: 14px;">
										<td width="22"><img align="left" src="{{ asset('images/icons/carro.png') }}" class="padding-right" height="20"></td>
										<td width="428" style="text-align: left;">&nbsp;{{$d24}}</td>
									</table>

									<table cellpadding="0" cellspacing="0" border="0" class="font" style="padding-left: 40px; padding-top: 5px; font-family: 'Roboto', sans-serif; font-size: 14px;">
										<td width="22"><img align="left" src="{{ asset('images/icons/area.png') }}" class="padding-right" height="20"></td>
										<td width="428" style="text-align: left;">&nbsp;{{$d25}}</td>
									</table>
									<p class="font" style="padding-left: 40px; font-family: 'Roboto', sans-serif; font-size: 14px;">{{$d27}}</p>
									<p class="font" style="padding-left: 40px; font-family: 'Roboto', sans-serif; font-size: 14px;">{{$d28}}</p>
								</td>
								<td width="449">
									<img src="{{ route('external_images', ['link'=> $d26]) }}" width="449" height="250" />
								</td>
							</tr>
						</table>
	            	</td>
	            </tr>
	            <tr id='top5'>
	                <td>
	                    <img src="{{ asset('images/campanha_digital.jpg') }}" width="900" height="200" />
	                </td>
	            </tr>
	        </table>
		</table>

    <input type="hidden" id="route-store-images" value="{{ route('template_store_images') }}"/>
    <input type="hidden" id="route-modelos" value="{{ route('propagandas.index') }}"/>
    <input type="hidden" id="modelo" value="{{ $modelo }}"/>

    <div class="nada"></div>

    <script type="text/javascript" src="{{ asset('js/render.js?v1.1') }}"></script>
    </body>
</html>

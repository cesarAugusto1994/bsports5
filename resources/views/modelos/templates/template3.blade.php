	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
        .font {font-family: 'Open Sans', sans-serif; font-size: 14px; color: #000000;}
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
				height: 100%;
			}

			.tudo {
				border: 1px solid #0138b9;
				float: left;
				width: 900px;
				height: 100%;
			}
			.div-title {
				float: left;
				width: 100%;
				height: 200px;
			}

			.div-title {
				float: left;
				background-image: url("{{ asset('images/campanha_digital_1.jpg') }}");
				height: 200px;
				width: 100%;
			}

			.div-footer {
				float: left;
				height: 200px;
				width: 100%;
			}

			.metade {
				width: 449px;
				float: left;
			}

			.metade > .img {
				float: left;
			}

			.metade > .info {
				width: 100%;
				float: left;
			}

			.metade > .tipologia {
				width: 100%;
				float: left;
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
				<button class="salvar-mod3 release-label prerelease">SALVAR TEMPLATE</button>
			</div>
			<div class='container'>
				<div class='tudo'>
					<div id='top0' class="div-title">
						<p class='font-title center'>{{$text1}}</p>
						<p class='font-title center'>{{$text2}}</p>
					</div>
					<div id='top1' class="metade" style='border-right: 1px solid #0138b9;'>
						<div class='img'>
							<img style="display:block" src="{{ route('external_images', ['link'=> $d5]) }}" width="449" height="250" />
						</div>
						<div class='info'>
							<p class="font" style="text-align: center;height: 10px;">{{$d6}}</p>
							<p class="font" style="text-align: center;height: 10px;">{{$d43}}</p>
						</div>
						<div class='tipologia'>
							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td width="50%" class="font" style="padding: 5px">
										<table cellpadding="0" cellspacing="0" border="0">
											<td width="22"><img style="display:block" align="left" src="{{ asset('images/icons/cama.png') }}" class="padding-right" height="20"></td>
											<td width="428" style="text-align: left;">&nbsp;{{$d1}}</td>
										</table>
									</td>
									<td width="50%" class="font" style="padding: 5px">
										<table cellpadding="0" cellspacing="0" border="0">
											<td width="22"><img style="display:block" align="left" src="{{ asset('images/icons/chuveiro.png') }}" class="padding-right" height="20"></td>
											<td width="428" style="text-align: left;">&nbsp;{{$d2}}</td>
										</table>
									</td>
								</tr>
								<tr>
									<td width="50%" class="font" style="padding: 5px">
										<table cellpadding="0" cellspacing="0" border="0">
											<td width="22"><img style="display:block" align="left" src="{{ asset('images/icons/carro.png') }}" class="padding-right" height="20"></td>
											<td width="428" style="text-align: left;">&nbsp;{{$d3}}</td>
										</table>
									</td>
									<td width="50%" class="font" style="padding: 5px">
										<table cellpadding="0" cellspacing="0" border="0">
											<td width="22"><img style="display:block" align="left" src="{{ asset('images/icons/area.png') }}" class="padding-right" height="20"></td>
											<td width="428" style="text-align: left;">&nbsp;{{$d4}}</td>
										</table>
									</td>
								</tr>
							</table>
						</div>
					</div>
					<div id='top2' class="metade">
						<div class='img'>
							<img style="display:block" src="{{ route('external_images', ['link'=> $d11]) }}" width="449" height="250" />
						</div>
						<div class='info'>
							<p class="font" style="text-align: center;height: 10px;">{{$d12}}</p>
							<p class="font" style="text-align: center;height: 10px;">{{$d44}}</p>
						</div>
						<div class='tipologia'>
							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td width="50%" class="font" style="padding: 5px">
										<table cellpadding="0" cellspacing="0" border="0">
											<td width="22"><img style="display:block" align="left" src="{{ asset('images/icons/cama.png') }}" class="padding-right" height="20"></td>
											<td width="428" style="text-align: left;">&nbsp;{{$d7}}</td>
										</table>
									</td>
									<td width="50%" class="font" style="padding: 5px">
										<table cellpadding="0" cellspacing="0" border="0">
											<td width="22"><img style="display:block" align="left" src="{{ asset('images/icons/chuveiro.png') }}" class="padding-right" height="20"></td>
											<td width="428" style="text-align: left;">&nbsp;{{$d8}}</td>
										</table>
									</td>
								</tr>
								<tr>
									<td width="50%" class="font" style="padding: 5px">
										<table cellpadding="0" cellspacing="0" border="0">
											<td width="22"><img style="display:block" align="left" src="{{ asset('images/icons/carro.png') }}" class="padding-right" height="20"></td>
											<td width="428" style="text-align: left;">&nbsp;{{$d9}}</td>
										</table>
									</td>
									<td width="50%" class="font" style="padding: 5px">
										<table cellpadding="0" cellspacing="0" border="0">
											<td width="22"><img style="display:block" align="left" src="{{ asset('images/icons/area.png') }}" class="padding-right" height="20"></td>
											<td width="428" style="text-align: left;">&nbsp;{{$d10}}</td>
										</table>
									</td>
								</tr>
							</table>
						</div>
					</div>
					<div id='top3' class="metade" style='border-right: 1px solid #0138b9;'>
						<div class='img'>
							<img style="display:block" src="{{ route('external_images', ['link'=> $d17]) }}" width="449" height="250" />
						</div>
						<div class='info'>
							<p class="font" style="text-align: center;height: 10px;">{{$d18}}</p>
							<p class="font" style="text-align: center;height: 10px;">{{$d45}}</p>
						</div>
						<div class='tipologia'>
							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td width="50%" class="font" style="padding: 5px">
										<table cellpadding="0" cellspacing="0" border="0">
											<td width="22"><img style="display:block" align="left" src="{{ asset('images/icons/cama.png') }}" class="padding-right" height="20"></td>
											<td width="428" style="text-align: left;">&nbsp;{{$d13}}</td>
										</table>
									</td>
									<td width="50%" class="font" style="padding: 5px">
										<table cellpadding="0" cellspacing="0" border="0">
											<td width="22"><img style="display:block" align="left" src="{{ asset('images/icons/chuveiro.png') }}" class="padding-right" height="20"></td>
											<td width="428" style="text-align: left;">&nbsp;{{$d14}}</td>
										</table>
									</td>
								</tr>
								<tr>
									<td width="50%" class="font" style="padding: 5px">
										<table cellpadding="0" cellspacing="0" border="0">
											<td width="22"><img style="display:block" align="left" src="{{ asset('images/icons/carro.png') }}" class="padding-right" height="20"></td>
											<td width="428" style="text-align: left;">&nbsp;{{$d15}}</td>
										</table>
									</td>
									<td width="50%" class="font" style="padding: 5px">
										<table cellpadding="0" cellspacing="0" border="0">
											<td width="22"><img style="display:block" align="left" src="{{ asset('images/icons/area.png') }}" class="padding-right" height="20"></td>
											<td width="428" style="text-align: left;">&nbsp;{{$d16}}</td>
										</table>
									</td>
								</tr>
							</table>
						</div>
					</div>
					<div id='top4' class="metade">
						<div class='img'>
							<img style="display:block" src="{{ route('external_images', ['link'=> $d23]) }}" width="449" height="250" />
						</div>
						<div class='info'>
							<p class="font" style="text-align: center;height: 10px;">{{$d24}}</p>
							<p class="font" style="text-align: center;height: 10px;">{{$d46}}</p>
						</div>
						<div class='tipologia'>
							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td width="50%" class="font" style="padding: 5px">
										<table cellpadding="0" cellspacing="0" border="0">
											<td width="22"><img style="display:block" align="left" src="{{ asset('images/icons/cama.png') }}" class="padding-right" height="20"></td>
											<td width="428" style="text-align: left;">&nbsp;{{$d19}}</td>
										</table>
									</td>
									<td width="50%" class="font" style="padding: 5px">
										<table cellpadding="0" cellspacing="0" border="0">
											<td width="22"><img style="display:block" align="left" src="{{ asset('images/icons/chuveiro.png') }}" class="padding-right" height="20"></td>
											<td width="428" style="text-align: left;">&nbsp;{{$d20}}</td>
										</table>
									</td>
								</tr>
								<tr>
									<td width="50%" class="font" style="padding: 5px">
										<table cellpadding="0" cellspacing="0" border="0">
											<td width="22"><img style="display:block" align="left" src="{{ asset('images/icons/carro.png') }}" class="padding-right" height="20"></td>
											<td width="428" style="text-align: left;">&nbsp;{{$d21}}</td>
										</table>
									</td>
									<td width="50%" class="font" style="padding: 5px">
										<table cellpadding="0" cellspacing="0" border="0">
											<td width="22"><img style="display:block" align="left" src="{{ asset('images/icons/area.png') }}" class="padding-right" height="20"></td>
											<td width="428" style="text-align: left;">&nbsp;{{$d22}}</td>
										</table>
									</td>
								</tr>
							</table>
						</div>
					</div>
					<div id='top5' class="metade" style='border-right: 1px solid #0138b9;'>
						<div class='img'>
							<img style="display:block" src="{{ route('external_images', ['link'=> $d29]) }}" width="449" height="250" />
						</div>
						<div class='info'>
							<p class="font" style="text-align: center;height: 10px;">{{$d30}}</p>
							<p class="font" style="text-align: center;height: 10px;">{{$d47}}</p>
						</div>
						<div class='tipologia'>
							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td width="50%" class="font" style="padding: 5px">
										<table cellpadding="0" cellspacing="0" border="0">
											<td width="22"><img style="display:block" align="left" src="{{ asset('images/icons/cama.png') }}" class="padding-right" height="20"></td>
											<td width="428" style="text-align: left;">&nbsp;{{$d25}}</td>
										</table>
									</td>
									<td width="50%" class="font" style="padding: 5px">
										<table cellpadding="0" cellspacing="0" border="0">
											<td width="22"><img style="display:block" align="left" src="{{ asset('images/icons/chuveiro.png') }}" class="padding-right" height="20"></td>
											<td width="428" style="text-align: left;">&nbsp;{{$d26}}</td>
										</table>
									</td>
								</tr>
								<tr>
									<td width="50%" class="font" style="padding: 5px">
										<table cellpadding="0" cellspacing="0" border="0">
											<td width="22"><img style="display:block" align="left" src="{{ asset('images/icons/carro.png') }}" class="padding-right" height="20"></td>
											<td width="428" style="text-align: left;">&nbsp;{{$d27}}</td>
										</table>
									</td>
									<td width="50%" class="font" style="padding: 5px">
										<table cellpadding="0" cellspacing="0" border="0">
											<td width="22"><img style="display:block" align="left" src="{{ asset('images/icons/area.png') }}" class="padding-right" height="20"></td>
											<td width="428" style="text-align: left;">&nbsp;{{$d28}}</td>
										</table>
									</td>
								</tr>
							</table>
						</div>
					</div>
					<div id='top6' class="metade">
						<div class='img'>
							<img style="display:block" src="{{ route('external_images', ['link'=> $d35]) }}" width="449" height="250" />
						</div>
						<div class='info'>
							<p class="font" style="text-align: center;height: 10px;">{{$d36}}</p>
							<p class="font" style="text-align: center;height: 10px;">{{$d48}}</p>
						</div>
						<div class='tipologia'>
							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td width="50%" class="font" style="padding: 5px">
										<table cellpadding="0" cellspacing="0" border="0">
											<td width="22"><img style="display:block" align="left" src="{{ asset('images/icons/cama.png') }}" class="padding-right" height="20"></td>
											<td width="428" style="text-align: left;">&nbsp;{{$d31}}</td>
										</table>
									</td>
									<td width="50%" class="font" style="padding: 5px">
										<table cellpadding="0" cellspacing="0" border="0">
											<td width="22"><img style="display:block" align="left" src="{{ asset('images/icons/chuveiro.png') }}" class="padding-right" height="20"></td>
											<td width="428" style="text-align: left;">&nbsp;{{$d32}}</td>
										</table>
									</td>
								</tr>
								<tr>
									<td width="50%" class="font" style="padding: 5px">
										<table cellpadding="0" cellspacing="0" border="0">
											<td width="22"><img style="display:block" align="left" src="{{ asset('images/icons/carro.png') }}" class="padding-right" height="20"></td>
											<td width="428" style="text-align: left;">&nbsp;{{$d33}}</td>
										</table>
									</td>
									<td width="50%" class="font" style="padding: 5px">
										<table cellpadding="0" cellspacing="0" border="0">
											<td width="22"><img style="display:block" align="left" src="{{ asset('images/icons/area.png') }}" class="padding-right" height="20"></td>
											<td width="428" style="text-align: left;">&nbsp;{{$d34}}</td>
										</table>
									</td>
								</tr>
							</table>
						</div>
					</div>
					<div id='top7' class="div-footer">
						<img src="{{ asset('images/campanha_digital.jpg') }}" width="900" height="200" />
					</div>
				</div>
			</div>
		</div>

		<input type="hidden" id="route-store-images" value="{{ route('template_store_images') }}"/>
		<input type="hidden" id="route-modelos" value="{{ route('propagandas.index') }}"/>
		<input type="hidden" id="modelo" value="{{ $modelo }}"/>

		<div class="nada"></div>

		<script type="text/javascript" src="{{ asset('js/render.js?v1.1') }}"></script>
    </body>
</html>

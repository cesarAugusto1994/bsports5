<!DOCTYPE html>
<html>
  <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>E-mail</title>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <script src="{{ asset('plugins/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/html2canvas.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/promise.min.js') }}"></script>

        <style type="text/css">
			body {margin: 0; padding: 0; min-height: 100%; min-width: 100%!important;font-weight: bold;}
			.content {width: 100%; max-width: 600px;}
			.font-title { font-family: 'Roboto', sans-serif; font-size: 30px; color: #ffffff;}
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
    <body bgcolor="#FFFFFF">
		<div class="alert-maxxxx" style='display: none;'>
			<p class='paragrafo'>
				Aguarde, salvando o template ...
			</p>
		</div>
		<div class="container-all">
			<div class="align-div">
				<input type="text" id='nomePropaganda' placeholder='Digite o nome da propaganda' value='{{$name}}' />
				<button class="salvar-mod1 release-label prerelease">SALVAR TEMPLATE</button>
			</div>
		</div>
		<div class="container-all">

				<table id="table-all" style="width: 900px;" bgcolor="#FFFFFF" align="center" border="0" cellpadding="0" cellspacing="0">
					<table id='top0' width="902" height="200" align="center" bgcolor="#FFFFFF" background="{{ asset('images/top-emails.png') }}" style="border-left: 1px solid #033AB9; border-right: 1px solid #033AB9;" cellpadding="0" cellspacing="0">
						<tr>
							<td>
								<table class="content" align="center" cellpadding="0" cellspacing="0" border="0">
									<tr>
										<td style="padding: 20px" class="font-title center">
											{{ $text1 }}
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
					<table id='top1' width="900" align="center" bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" style="border-left: 1px solid #033AB9; border-right: 1px solid #033AB9;">
						<tr>
							<td>
								<table class="content" align="center" cellpadding="0" cellspacing="0" border="0">
									<tr>
										<td>
											<img src="{{ route('external_images', ['link'=> $imgUrl1]) }}"height="400" width="900"/>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					<table id='top2' bgcolor="#FFFFFF" width="902" align="center" cellpadding="0" cellspacing="0" border="0" style="border-left: 1px solid #033AB9; border-right: 1px solid #033AB9;">
						<tr>
							<td width="50%">
								<table cellpadding="0" cellspacing="0" border="0">
									<tr>
										<td class="font" style="padding: 5px">
											<table cellpadding="0" cellspacing="0" border="0">
												<td width="22"><img align="left" src="{{ asset('images/icons/cama.png') }}" class="padding-right" height="20"></td>
												<td width="428" style="text-align: left;">&nbsp;{{ $dorms }}</td>
											</table>
										</td>
									</tr>
									<tr>
										<td class="font" style="padding: 5px">
											<table cellpadding="0" cellspacing="0" border="0">
												<td width="22"><img align="left" src="{{ asset('images/icons/chuveiro.png') }}" class="padding-right" height="20"></td>
												<td width="428" style="text-align: left;">&nbsp;{{$suites}}</td>
											</table>
										</td>
									</tr>
									<tr>
										<td class="font" style="padding: 5px">
											<table cellpadding="0" cellspacing="0" border="0">
												<td width="22"><img align="left" src="{{ asset('images/icons/carro.png') }}" class="padding-right" height="20"></td>
												<td width="428" style="text-align: left;">&nbsp;{{$vagas}}</td>
											</table>
										</td>
									</tr>
									<tr>
										<td class="font" style="padding: 5px">
											<table cellpadding="0" cellspacing="0" border="0">
												<td width="22"><img align="left" src="{{ asset('images/icons/area.png') }}" class="padding-right" height="20"></td>
												<td width="428" style="text-align: left;">&nbsp;{{$metragem}}</td>
											</table>
										</td>
									</tr>
								</table>
							</td>
							<td width="50%">
								<table cellpadding="0" cellspacing="0" border="0">
									<tr>
										<td class="font" style="padding: 5px">
											{{$edit1}}
										</td>
									</tr>
									<tr>
										<td class="font" style="padding: 5px">
											{{$edit2}}
										</td>
									</tr>
									<tr>
										<td class="font" style="padding: 5px">
											{{$edit3}}
										</td>
									</tr>
									<tr>
										<td class="font" style="padding: 5px">
											{{$edit4}}
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					<table id='top3' width="902" align="center" bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" style="border-left: 1px solid #033AB9; border-right: 1px solid #033AB9;">
						{!!$video!!}
					</table>
					<table id='top4' width="900" align="center" bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" style="border-left: 1px solid #033AB9; border-right: 1px solid #033AB9;">
						<tr>
							<td>
								<table width="100%" cellpadding="0" cellspacing="0" border="0">
									<tr>
										<td>
											<table cellpadding="0" cellspacing="0" border="0">
												<tr>
													<td>
														<img src="{{ route('external_images', ['link'=> $img1]) }}" width="450px" height="250px" />
													</td>
												</tr>
											</table>
										</td>
										<td>
											<table cellpadding="0" cellspacing="0" border="0">
												<tr>
													<td>
														<img src="{{ route('external_images', ['link'=> $img2]) }}" width="450px" height="250px" />
													</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr style="border: 5px solid #000000">
										<td width="100%" style="border-top: 3px solid #000000">
										</td>
										<td width="100%" style="border-top: 3px solid #000000">
										</td>
									</tr>
									<tr>
										<td>
											<table cellpadding="0" cellspacing="0" border="0">
												<tr>
													<td>
														<img src="{{ route('external_images', ['link'=> $img3]) }}" width="450px" height="250px" />
													</td>
												</tr>
											</table>
										</td>
										<td>
											<table cellpadding="0" cellspacing="0" border="0">
												<tr>
													<td>
														<img src="{{ route('external_images', ['link'=> $img4]) }}" width="450px" height="250px" />
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>
								<table class="content" align="center" cellpadding="0" cellspacing="0" border="0">
									<tr>
										<td style="padding: 20px" class="font center">
											Localização: {{$local}}
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>
								<table class="content" align="center" cellpadding="0" cellspacing="0" border="0">
									<tr>
										<td class="font center">
											<img src="{{$mapa}}" width="900" height="450">
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>
								<img src="{{ asset('images/rodape-emails.png') }}" width="900px" height="200px" />
							</td>
						</tr>
					</table>
				</table>
		</div>

    <input type="hidden" id="route-store-images" value="{{ route('template_store_images') }}"/>
    <input type="hidden" id="route-modelos" value="{{ route('propagandas.index') }}"/>
    <input type="hidden" id="modelo" value="{{ $modelo }}"/>

		<div class="nada"></div>

		<script type="text/javascript" src="{{ asset('js/render.js?v1.1') }}"></script>
    </body>
</html>

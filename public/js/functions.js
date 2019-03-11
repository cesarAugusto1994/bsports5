var getInfoDormsImovel  =  function ( id, preencher ) {
    $.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: $("#route-imoveis-dormitorios").val(),
        data: 'id=' + id,
        dataType: 'json',
        success: function (data) {
			$( '#dorms' + btnSelected ).val( data["dorms"] );
			$( '#suites' + btnSelected ).val( data["suite"] );
			$( '#vagas' + btnSelected ).val( data["vagas"] );
			$( '#metragem' + btnSelected ).val( data["area"] );
			$( '#bairro' + btnSelected ).val( data["bairro"] );
			$( '#publicidade' + btnSelected ).val( data["publicidade"] );
        },error: function(request, status, error){
            alert(request.responseText);
        }
    });
}

var preview  =  function ( text1, text2, d1, d2, d3, d4, d5, d6, d7, d8, d9, d10, d11, d12, d13, d14, d15, d16, d17, d18, d19, d20, d21, d22, d23, d24, d25, d26, d27, d28, d29, d30, d31, d32, d33, d34, d35, d36, d37, d38, d39, d40, d41, d42, d43, d44, d45, d46, d47, d48, idModelo ) {

  var nameProp = $('#salvar').val();
  var modelo = $("#modelo").val();
  var chamado = $("#chamado").val();

  var link = 'nameProp=' + nameProp + '&modelo=' + modelo + '&chamado=' + chamado + '&id=' + idModelo + '&text1=' + text1 + '&text2=' + text2 + '&d1=' + d1 + '&d2=' + d2 + '&d3=' + d3 + '&d4=' + d4 + '&d5=' + d5 + '&d6=' + d6 + '&d7=' + d7 + '&d8=' + d8 + '&d9=' + d9 + '&d10=' + d10 + '&d11=' + d11 + '&d12=' + d12 + '&d13=' + d13 + '&d14=' + d14 + '&d15=' + d15 + '&d16=' + d16 + '&d17=' + d17 + "&d18=" + d18 + '&d19=' + d19 + '&d20=' + d20 + '&d21=' + d21 + '&d22=' + d22 + '&d23=' + d23 + "&d24=" + d24 + "&d25=" + d25 + '&d26=' + d26 + '&d27=' + d27 + '&d28=' + d28 + '&d29=' + d29 + '&d30=' + d30 + "&d31=" + d31 + '&d32=' + d32 + "&d33=" + d33 + "&d34=" + d34 + '&d35=' + d35 + '&d36=' + d36 + '&d37=' + d37 + '&d38=' + d38 + '&d39=' + d39 + '&d40=' + d40 + '&d41=' + d41 + '&d42=' + d42 + '&d43=' + d43 + '&d44=' + d44 + '&d45=' + d45 + '&d46=' + d46 + '&d47=' + d47 + '&d48=' + d48;

	$.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: $("#route-preview").val(), //setPreview3
        data: link,
        dataType: 'json',
        success: function (data) {
        	var newtab = window.open( String( data["url"]  + '?' + link ), '_blank' );
        },error: function(request, status, error){
            alert(request.responseText);
        }
    });
}

var sendEmail  =  function ( text1, text2, imgUrl1, dorms, suites, vagas, metragem, edit1, edit2, edit3, edit4, img1, img2, img3, img4, local, mapa ) {
    $.ajax({
        type: 'POST',
        url: baseUrl + 'ajax/imoveis/sendEmail',
        data: 'text1=' + text1 + '&text2=' + text2 + '&imgUrl1=' + imgUrl1 + '&dorms=' + dorms + '&suites=' + suites + '&vagas=' + vagas + '&metragem=' + metragem + '&edit1=' + edit1 + '&edit2=' + edit2 + '&edit3=' + edit3 + '&edit4=' + edit4 + '&img1=' + img1 + '&img2=' + img2 + '&img3=' + img3 + '&img4=' + img4 + '&local=' + local + '&mapa=' + mapa,
        dataType: 'json',
        success: function (data) {
        	alert( data );
        },error: function(request, status, error){
            alert(request.responseText);
        }
    });
}

var serializeTabs  =  function ( isPreview, idModelo ) {

	//Tab 1
	var text1     =   $( '#text1' ).val();
	var text2     =   $( '#text2' ).val();

	//Tab 2
	var d1   =   $( '#dorms1' ).val();
	var d2   =   $( '#suites1' ).val();
	var d3   =   $( '#vagas1' ).val();
	var d4   =   $( '#metragem1' ).val();
	var d5   =   $( '.imgimovel1' ).attr( "src" );
	var d6   =   $( '#bairro1' ).val();

	var d7   =   $( '#dorms2' ).val();
	var d8   =   $( '#suites2' ).val();
	var d9   =   $( '#vagas2' ).val();
	var d10  =   $( '#metragem2' ).val();
	var d11  =   $( '.imgimovel2' ).attr( "src" );
	var d12  =   $( '#bairro2' ).val();

	var d13  =   $( '#dorms3' ).val();
	var d14  =   $( '#suites3' ).val();
	var d15  =   $( '#vagas3' ).val();
	var d16  =   $( '#metragem3' ).val();
	var d17  =   $( '.imgimovel3' ).attr( "src" );
	var d18  =   $( '#bairro3' ).val();

	var d19  =   $( '#dorms4' ).val();
	var d20  =   $( '#suites4' ).val();
	var d21  =   $( '#vagas4' ).val();
	var d22  =   $( '#metragem4' ).val();
	var d23  =   $( '.imgimovel4' ).attr( "src" );
	var d24  =   $( '#bairro4' ).val();

	var d25  =   $( '#dorms5' ).val();
	var d26  =   $( '#suites5' ).val();
	var d27  =   $( '#vagas5' ).val();
	var d28  =   $( '#metragem5' ).val();
	var d29  =   $( '.imgimovel5' ).attr( "src" );
	var d30  =   $( '#bairro5' ).val();

	var d31  =   $( '#dorms6' ).val();
	var d32  =   $( '#suites6' ).val();
	var d33  =   $( '#vagas6' ).val();
	var d34  =   $( '#metragem6' ).val();
	var d35  =   $( '.imgimovel6' ).attr( "src" );
	var d36  =   $( '#bairro6' ).val();

    var d37  =   $( '#link1' ).val();
    var d38  =   $( '#link2' ).val();
    var d39  =   $( '#link3' ).val();
    var d40  =   $( '#link4' ).val();
    var d41  =   $( '#link5' ).val();
    var d42  =   $( '#link6' ).val();

    var d43  =   $( '#publicidade1' ).val();
    var d44  =   $( '#publicidade2' ).val();
    var d45  =   $( '#publicidade3' ).val();
    var d46  =   $( '#publicidade4' ).val();
    var d47  =   $( '#publicidade5' ).val();
	var d48  =   $( '#publicidade6' ).val();

	if( isPreview ){
		preview( text1, text2, d1, d2, d3, d4, d5, d6, d7, d8, d9, d10, d11, d12, d13, d14, d15, d16, d17, d18, d19, d20, d21, d22, d23, d24, d25, d26, d27, d28, d29, d30, d31, d32, d33, d34, d35, d36, d37, d38, d39, d40, d41, d42, d43, d44, d45, d46, d47, d48, idModelo );
	}else {
		var name = $( '#salvar' ).val();
		salvar( name, text1, text2, d1, d2, d3, d4, d5, d6, d7, d8, d9, d10, d11, d12, d13, d14, d15, d16, d17, d18, d19, d20, d21, d22, d23, d24, d25, d26, d27, d28, d29, d30, d31, d32, d33, d34, d35, d36, d37, d38, d39, d40, d41, d42, idModelo );
	}

}

var salvar  =  function ( name, text1, text2, d1, d2, d3, d4, d5, d6, d7, d8, d9, d10, d11, d12, d13, d14, d15, d16, d17, d18, d19, d20, d21, d22, d23, d24, d25, d26, d27, d28, d29, d30, d31, d32, d33, d34, d35, d36, d37, d38, d39, d40, d41, d42, idModelo ) {
    $.ajax({
        type: 'POST',
        url: baseUrl + 'templates/salvar',
        data: 'name=' + name + '&id=' + idModelo + '&modelo=' + idModelo  + "&idTemplate=" + idTemplate + '&text1=' + text1 + '&text2=' + text2 + '&d1=' + d1 + '&d2=' + d2 + '&d3=' + d3 + '&d4=' + d4 + '&d5=' + d5 + '&d6=' + d6 + '&d7=' + d7 + '&d8=' + d8 + '&d9=' + d9 + '&d10=' + d10 + '&d11=' + d11 + '&d12=' + d12 + '&d13=' + d13 + '&d14=' + d14 + '&d15=' + d15 + '&d16=' + d16 + '&d17=' + d17 + "&d18=" + d18 + '&d19=' + d19 + '&d20=' + d20 + '&d21=' + d21 + '&d22=' + d22 + '&d23=' + d23 + "&d24=" + d24 + "&d25=" + d25 + '&d26=' + d26 + '&d27=' + d27 + '&d28=' + d28 + '&d29=' + d29 + '&d30=' + d30 + "&d31=" + d31 + '&d32=' + d32 + "&d33=" + d33 + "&d34=" + d34 + '&d35=' + d35 + '&d36=' + d36 + '&d37=' + d37 + '&d38=' + d38 + '&d39=' + d39 + '&d40=' + d40 + '&d41=' + d41 + '&d42=' + d42,
        dataType: 'json',
        success: function (data) {
            alert( data["message"] );

            if( data["code"] == 100 )
                location.href = baseUrl + 'templates';
        },error: function(request, status, error){
            alert(request.responseText);
        }
    });
}

var serializeTabsModelo4  =  function ( isPreview, idModelo ) {

	//Tab 1
	var text1     =   $( '#text1' ).val();
	var text2     =   $( '#text2' ).val();

	//Tab 2
	var d1   =   $( '#dorms1' ).val();
	var d2   =   $( '#suites1' ).val();
	var d3   =   $( '#vagas1' ).val();
	var d4   =   $( '#metragem1' ).val();
	var d5   =   $( '.imgimovel1' ).attr( "src" );
	var d6   =   $( '#linhaEdit11' ).val();
	var d7   =   $( '#linhaEdit12' ).val();


	var d8   =   $( '#dorms2' ).val();
	var d9   =   $( '#suites2' ).val();
	var d10  =   $( '#vagas2' ).val();
	var d11  =   $( '#metragem2' ).val();
	var d12  =   $( '.imgimovel2' ).attr( "src" );
	var d13  =   $( '#linhaEdit21' ).val();
	var d14  =   $( '#linhaEdit22' ).val();

	var d15  =   $( '#dorms3' ).val();
	var d16  =   $( '#suites3' ).val();
	var d17  =   $( '#vagas3' ).val();
	var d18  =   $( '#metragem3' ).val();
	var d19  =   $( '.imgimovel3' ).attr( "src" );
	var d20  =   $( '#linhaEdit31' ).val();
	var d21  =   $( '#linhaEdit32' ).val();

	var d22  =   $( '#dorms4' ).val();
	var d23  =   $( '#suites4' ).val();
	var d24  =   $( '#vagas4' ).val();
	var d25  =   $( '#metragem4' ).val();
	var d26  =   $( '.imgimovel4' ).attr( "src" );
	var d27  =   $( '#linhaEdit41' ).val();
	var d28  =   $( '#linhaEdit42' ).val();

    var d29  =   $( '#link1' ).val();
    var d30  =   $( '#link2' ).val();
    var d31  =   $( '#link3' ).val();
    var d32  =   $( '#link4' ).val();

	var d33  =   $( '#publicidade1' ).val();
    var d34  =   $( '#publicidade2' ).val();
    var d35  =   $( '#publicidade3' ).val();
	var d36  =   $( '#publicidade4' ).val();

	var d37  =   $( '#bairro1' ).val();
    var d38  =   $( '#bairro2' ).val();
    var d39  =   $( '#bairro3' ).val();
    var d40  =   $( '#bairro4' ).val();

	if( isPreview ) {
		previewModelo4( text1, text2, d1, d2, d3, d4, d5, d6, d7, d8, d9, d10, d11, d12, d13, d14, d15, d16, d17, d18, d19, d20, d21, d22, d23, d24, d25, d26, d27, d28, d29, d30, d31, d32, d33, d34, d35, d36, d37, d38, d39, d40, idModelo );
	}else {
		var name = $( '#salvar' ).val();
		salvarModelo4( name, text1, text2, d1, d2, d3, d4, d5, d6, d7, d8, d9, d10, d11, d12, d13, d14, d15, d16, d17, d18, d19, d20, d21, d22, d23, d24, d25, d26, d27, d28, d29, d30, d31, d32, idModelo );
	}

}

var previewModelo4  =  function ( text1, text2, d1, d2, d3, d4, d5, d6, d7, d8, d9, d10, d11, d12, d13, d14, d15, d16, d17, d18, d19, d20, d21, d22, d23, d24, d25, d26, d27, d28, d29, d30, d31, d32, d33, d34, d35, d36, d37, d38, d39, d40, idModelo ) {
	var nameProp = $('#salvar').val();

  var link='nameProp=' + nameProp + '&id=' + idModelo + '&text1=' + text1 + '&text2=' + text2 + '&d1=' + d1 + '&d2=' + d2 + '&d3=' + d3 + '&d4=' + d4 + '&d5=' + d5 + '&d6=' + d6 + '&d7=' + d7 + '&d8=' + d8 + '&d9=' + d9 + '&d10=' + d10 + '&d11=' + d11 + '&d12=' + d12 + '&d13=' + d13 + '&d14=' + d14 + '&d15=' + d15 + '&d16=' + d16 + '&d17=' + d17 + "&d18=" + d18 + '&d19=' + d19 + '&d20=' + d20 + '&d21=' + d21 + '&d22=' + d22 + '&d23=' + d23 + "&d24=" + d24 + "&d25=" + d25 + '&d26=' + d26 + '&d27=' + d27 + '&d28=' + d28 + '&d29=' + d29 + '&d30=' + d30 + '&d31=' + d31 + '&d32=' + d32 + '&d33=' + d33 + '&d34=' + d34 + '&d35=' + d35 + '&d36=' + d36 + '&d37=' + d37 + '&d38=' + d38 + '&d39=' + d39 + '&d40=' + d40;

	$.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: $("#route-preview").val(),
        data: link,
        dataType: 'json',
        success: function (data) {
        	var newtab = window.open( String( data["url"] + '?' + link  ), '_blank' );
        },error: function(request, status, error){
            alert(request.responseText);
        }
    });
}

var salvarModelo4  =  function ( name, text1, text2, d1, d2, d3, d4, d5, d6, d7, d8, d9, d10, d11, d12, d13, d14, d15, d16, d17, d18, d19, d20, d21, d22, d23, d24, d25, d26, d27, d28, d29, d30, d31, d32, idModelo ) {
    $.ajax({
        type: 'POST',
        url: baseUrl + 'templates/salvar',
        data: 'name=' + name + '&id=' + idModelo + "&idTemplate=" + idTemplate + '&text1=' + text1 + '&text2=' + text2 + '&d1=' + d1 + '&d2=' + d2 + '&d3=' + d3 + '&d4=' + d4 + '&d5=' + d5 + '&d6=' + d6 + '&d7=' + d7 + '&d8=' + d8 + '&d9=' + d9 + '&d10=' + d10 + '&d11=' + d11 + '&d12=' + d12 + '&d13=' + d13 + '&d14=' + d14 + '&d15=' + d15 + '&d16=' + d16 + '&d17=' + d17 + "&d18=" + d18 + '&d19=' + d19 + '&d20=' + d20 + '&d21=' + d21 + '&d22=' + d22 + '&d23=' + d23 + "&d24=" + d24 + "&d25=" + d25 + '&d26=' + d26 + '&d27=' + d27 + '&d28=' + d28 + '&d29=' + d29 + '&d30=' + d30 + '&d31=' + d31 + '&d32=' + d32,
        dataType: 'json',
        success: function (data) {
            alert( data["message"] );


            if( data["code"] == 100 )
                location.href = baseUrl + 'templates';
        },error: function(request, status, error){
            alert(request.responseText);
        }
    });
}

var getFilesModels  =  function () {
    $.ajax({
        type: 'POST',
        url: baseUrl + 'templates/getFilesModels',
        dataType: 'json',
        success: function (data) {
        	if( data.hasOwnProperty('files') && data["files"].length > 0 ) {
        		$( '.tbodyAllImoveis' ).find( 'tr' ).hide().not( ':first' ).remove();
        		for (var i = 0; i < data["files"].length; i++) {
        			var $tr    =  $( '<tr></tr>' );
        			var $td1   =  $( "<td class='text-center'></td>" ).text( (i+1) );
        			var $td2   =  $( "<td class='text-center'></td>" ).text( data["files"][i]["name"] );
        			var $td3   =  $( "<td class='text-center'></td>" ).text( data["files"][i]["date"] );
        			var $td4   =  $( "<td class='text-center'></td>" );
                    var $td5   =  $( "<td class='text-center'></td>" ).text( data["files"][i]["model"] );
        			var $del   =  $( '<i class="glyphicon glyphicon-remove deletar" />' ).attr({'data-id' : data["files"][i]["id"], 'title' : 'Deletar esse arquivo' }).css({'color' : '#f44e42', 'font-size' : '17px', 'cursor' : 'pointer'});
        			var $view  =  $( '<i class="glyphicon glyphicon-ok-sign visualizar" />' ).attr({'data-id' : 'templates/visualizar/' + data["files"][i]["id"], 'title' : 'Visualizar' }).css({'color' : '#41f444', 'font-size' : '17px', 'cursor' : 'pointer'});
                    var $edit  =  $( '<i class="glyphicon glyphicon-wrench editar" />' ).attr({'data-template' : data["files"][i]["modelo"], 'data-id' : data["files"][i]["id"], 'title' : 'Editar' }).css({'color' : '#847901', 'font-size' : '17px', 'cursor' : 'pointer', 'margin-right' : '6px'});
        			$td4.append($del).append("&nbsp;&nbsp;").append($edit).append($view);
        			$( '.tbodyAllImoveis' ).append( $tr.append( $td1 ).append( $td5 ).append( $td2 ).append( $td3 ).append( $td4 ) );
        		}
        	}else {
        		$( '.tbodyAllImoveis' ).find( 'tr' ).not( ':first' ).remove();
                $( '.tbodyAllImoveis' ).find( 'tr' ).show();
        	}
        },error: function(request, status, error){
            alert(request.responseText);
        }
    });
}

var deletarFileModels  =  function ( id ) {
    $.ajax({
        type: 'POST',
        url: baseUrl + 'templates/deletarFileModels',
        data: 'id='+id,
        dataType: 'json',
        success: function (data) {
        	getFilesModels();
        	alert( data["message"] );
        	$( '.closeModalDeleteArquivo' ).trigger( 'click' );
        },error: function(request, status, error){
            alert(request.responseText);
        }
    });
}

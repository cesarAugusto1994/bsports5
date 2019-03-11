var optAgenda = {

    success:   responseAdicionarEvento,

    dataType:  'json'

};

$( '.formMapaGoogle' ).ajaxForm( optAgenda );

$(":file").filestyle();

$( '.nodata' ).show();

$( '.bodyImovelModal' ).find( "tr" ).not(":first").remove();

hideShowTableAndButton( false );

hideShowContainerIMG( true );

var pOffset = 0;

var imgOffset = 0;

var idImg = 0;

var callFunction = 0;

var selectImage = 0;

var $html  =  "<div style='position: relative; margin-top: 10px'>";
$html +=  "<button class='btn btn-danger sendImage'>";
$html +=  "Enviar imagem";
$html +=  "</button>";
$html +=  "</div>";

setTimeout( function () {

	//$( 'div.bootstrap-filestyle' ).after( $html );

	$( 'label[for=filestyle-0]' ).html("<span class='glyphicon glyphicon-folder-open'></span>&nbsp;&nbsp;Selecione o arquivo");

}, 300);

$( '.btn-next' ).click( function () {

	$( this ).prop("disabled", true);

	$( ".btn-prev" ).prop("disabled", true);

	pOffset += 10;

	consultaImoveis( pOffset, $( '#keySearch' ).val() );

});

$( '.btn-prev' ).click( function () {

	$( ".btn-next" ).prop("disabled", true);

	$( this ).prop("disabled", true);

	pOffset -= 10;

	consultaImoveis( pOffset, $( '#keySearch' ).val() );

});

$( ".selectImageImovel" ).click( function () {

	pOffset = 0;
	callFunction = 0;
	selectImage = 0;

	hideShowTableAndButton( false );
	hideShowContainerIMG( true );
	consultaImoveis( pOffset, $( '#keySearch' ).val() );

});

$( '#keySearch' ).keyup( function () {

	var search  =   $( this ).val();

	pOffset     =   0;

	if( search.length > 2 ) {

		$( '.btn-next' ).prop("disabled", true);

		$( '.btn-prev' ).prop("disabled", true);

		consultaImoveis( pOffset, search );

	}

});

$( '.btn-img-next' ).click( function () {

	$( this ).prop("disabled", true);

	$( ".btn-img-prev" ).prop("disabled", true);

	imgOffset += 10;

	getImagesImoveis( imgOffset, idImg );

});

$( '.btn-img-prev' ).click( function () {

	$( ".btn-img-next" ).prop("disabled", true);

	$( this ).prop("disabled", true);

	imgOffset -= 10;

	getImagesImoveis( imgOffset, idImg );

});

$( document ).on( 'click', 'tr.tr-imovel', function() {

	idImg      =   $( this ).attr( 'data-tr' );

	imgOffset  =   0;

	hideShowTableAndButton( true );
	hideShowContainerIMG( false );

	if( callFunction == 0 ) {

		getImagesImoveis( imgOffset, idImg );

	}else if( callFunction == 1 ) {

		getInfoDormsImovel( idImg );

	}else if( callFunction == 2 ) {

		getInfoGeral( idImg );

	}

});

$( document ).on( 'click', 'img.img-select', function() {

	var src  =  $( this ).attr( "src" );

	if( selectImage == 0 ) {
		$( '.selected-img' ).attr({ "src" : src, "id" : $( this ).attr( "data-id" ) }).show();
		$( ".message-image" ).text("");
	}else if( selectImage == 1 ) {
		$( '#img1' ).attr( "src", src ).show();
	}else if( selectImage == 2 ) {
		$( '#img2' ).attr( "src", src ).show();
	}else if( selectImage == 3 ) {
		$( '#img3' ).attr( "src", src ).show();
	}else if( selectImage == 4 ) {
		$( '#img4' ).attr( "src", src ).show();
	}

	$( '.closeModalSelectImovel' ).trigger( 'click' );
	hideShowTableAndButton( true );
	hideShowContainerIMG( true );
});

$( '.selectImovelInfo' ).click( function () {

	pOffset = 0;
	callFunction = 1;
	hideShowTableAndButton( false );
	hideShowContainerIMG( true );
	consultaImoveis( pOffset, $( '#keySearch' ).val() );

});

$( '.btn-img1' ).click( function () {
	pOffset = 0;
	callFunction = 0;
	selectImage = 1;

	hideShowTableAndButton( false );
	hideShowContainerIMG( true );
	consultaImoveis( pOffset, $( '#keySearch' ).val() );
});

$( '.btn-img2' ).click( function () {
	pOffset = 0;
	callFunction = 0;
	selectImage = 2;

	hideShowTableAndButton( false );
	hideShowContainerIMG( true );
	consultaImoveis( pOffset, $( '#keySearch' ).val() );
});

$( '.btn-img3' ).click( function () {
	pOffset = 0;
	callFunction = 0;
	selectImage = 3;

	hideShowTableAndButton( false );
	hideShowContainerIMG( true );
	consultaImoveis( pOffset, $( '#keySearch' ).val() );
});

$( '.btn-img4' ).click( function () {
	pOffset = 0;
	callFunction = 0;
	selectImage = 4;

	hideShowTableAndButton( false );
	hideShowContainerIMG( true );
	consultaImoveis( pOffset, $( '#keySearch' ).val() );
});

$( '.btn-localidade' ).click( function () {
	pOffset = 0;
	callFunction = 2;

	hideShowTableAndButton( false );
	hideShowContainerIMG( true );
	consultaImoveis( pOffset, $( '#keySearch' ).val() );
});

$( '.preview' ).click( function () {

	var id  =  $( this ).attr( 'data-id' );

	if( id != 5 ) {
		serializeTabs( true, id );
	}else {
		serializeTabs5( true, id )
	}

});

$( '.salvar' ).click( function () {

	var id  =  $( '.preview' ).attr( 'data-id' );

	if( id != 5 ) {
		serializeTabs( false, id );
	}else {
		serializeTabs5( false, id )
	}

});

function serializeTabs5( isPreview, idModelo ) {

	//Tab 1
	var d1   =   $( '#text1' ).val();
	var d2   =   $( '#text2' ).val();

	//Tab 2
	var d3   =   $( '#img1' ).attr( "src" );
	var d4   =   $( '#img2' ).attr( "src" );
	var d5   =   $( '#img3' ).attr( "src" );
	var d6   =   $( '#img4' ).attr( "src" );

	//Tab 3
	var d7   =   $( '#linhaEdit1' ).val();
	var d8   =   $( '#linhaEdit2' ).val();
	var d9   =   $( '#linhaEdit3' ).val();
	var d10  =   $( '#linhaEdit4' ).val();
	var d11  =   $( '#linhaEdit5' ).val();

	//Tab 4
	var d12  =   $( '#localidade' ).val();
	var d13  =   $( '.imageGoogle' ).attr( "src" );
	var d14  =   $( '#video' ).val();
	var d15  =   $( '#linkGeral' ).val();

	if( isPreview ) {
		previewModelo5( d1, d2, d3, d4, d5, d6, d7, d8, d9, d10, d11, d12, d13, d14, d15, idModelo );
	}else {
		var name = $( '#salvar' ).val();
		salvarModelo5( name, d1, d2, d3, d4, d5, d6, d7, d8, d9, d10, d11, d12, d13, d14, d15, idModelo );
	}

}

function serializeTabs( isPreview, id ) {

	//Tab 1
	var text1     =   $( '#text1' ).val();
	var text2     =   $( '#text2' ).val();

	//Tab 2
	var imgUrl1   =   $( '.selected-img' ).attr( "src" );

	//Tab 3
	var dorms     =   $( '#dorms' ).val();
	var suites    =   $( '#suites' ).val();
	var vagas     =   $( '#vagas' ).val();
	var metragem  =   $( '#metragem' ).val();

	var edit1     =   $( '#editavel1' ).val();
	var edit2     =   $( '#editavel2' ).val();
	var edit3     =   $( '#editavel3' ).val();
	var edit4     =   $( '#editavel4' ).val();

	//Tab4
	var img1      =   $( '#img1' ).attr( 'src' );
	var img2      =   $( '#img2' ).attr( 'src' );
	var img3      =   $( '#img3' ).attr( 'src' );
	var img4      =   $( '#img4' ).attr( 'src' );

	//Tab 5
	var local     =   $( '#localidade' ).val();
	var mapa      =   $( '.imageGoogle' ).attr( "src" );
	var video     =   $( '#video' ).val();

	var link      =   $('#linkGeral').val();

	if( isPreview ) {
		preview( text1, text2, imgUrl1, dorms, suites, vagas, metragem, edit1, edit2, edit3, edit4, img1, img2, img3, img4, local, mapa, id, video, link );
	}else {
		var name = $( '#salvar' ).val();
		salvar( name, text1, text2, imgUrl1, dorms, suites, vagas, metragem, edit1, edit2, edit3, edit4, img1, img2, img3, img4, local, mapa, id, video, link );
	}

}

var preview  =  function ( text1, text2, imgUrl1, dorms, suites, vagas, metragem, edit1, edit2, edit3, edit4, img1, img2, img3, img4, local, mapa, id, video, link ) {

    if($("#nomePropaganda").val() == ''){
      alert('Informe o nome do template');
      return false;
    }

    var nameProp = $('#salvar').val();
    var modelo = $("#modelo").val();
    var chamado = $("#chamado").val();

    var link = 'nameProp=' + nameProp + '&modelo=' + modelo + '&chamado=' + chamado + '&linkGeral=' + link + '&video=' + video + '&text1=' + text1 + '&text2=' + text2 + '&imgUrl1=' + imgUrl1 + '&dorms=' + dorms + '&suites=' + suites + '&vagas=' + vagas + '&metragem=' + metragem + '&edit1=' + edit1 + '&edit2=' + edit2 + '&edit3=' + edit3 + '&edit4=' + edit4 + '&img1=' + img1 + '&img2=' + img2 + '&img3=' + img3 + '&img4=' + img4 + '&local=' + local + '&mapa=' + mapa + "&id=" + id;

    $.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: $("#route-preview").val(),
        data: link,
        dataType: 'json',
        success: function (data) {
        	var newtab = window.open( String( data["url"] + '?' + link ), '_blank' );
        },error: function(request, status, error){
            alert(request.responseText);
        }
    });
}

var salvar  =  function ( name, text1, text2, imgUrl1, dorms, suites, vagas, metragem, edit1, edit2, edit3, edit4, img1, img2, img3, img4, local, mapa, id, video, link ) {

    $.ajax({

        type: 'POST',

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        url: 'templates/salvar',

        data: 'idTemplate=' + idTemplate + '&linkGeral=' + link + '&video=' + video + '&name=' + name + '&text1=' + text1 + '&text2=' + text2 + '&imgUrl1=' + imgUrl1 + '&dorms=' + dorms + '&suites=' + suites + '&vagas=' + vagas + '&metragem=' + metragem + '&edit1=' + edit1 + '&edit2=' + edit2 + '&edit3=' + edit3 + '&edit4=' + edit4 + '&img1=' + img1 + '&img2=' + img2 + '&img3=' + img3 + '&img4=' + img4 + '&local=' + local + '&mapa=' + mapa + "&id=" + id,

        dataType: 'json',

        success: function (data) {

        	alert( data["message"] );

        	if( data["code"] == 100 )
        		location.href = 'templates';

        },error: function(request, status, error){
            alert(request.responseText);
        }

    });

}

var salvarModelo5  =  function ( name, d1, d2, d3, d4, d5, d6, d7, d8, d9, d10, d11, d12, d13, d14, d15, idModelo ) {

    $.ajax({

        type: 'POST',

        url: 'templates/salvar',

        data: 'idTemplate=' + idTemplate + '&name=' + name + '&id=' + idModelo + '&modelo=' + idModelo + '&d1=' + d1 + '&d2=' + d2 + '&d3=' + d3 + '&d4=' + d4 + '&d5=' + d5 + '&d6=' + d6 + '&d7=' + d7 + '&d8=' + d8 + '&d9=' + d9 + '&d10=' + d10 + '&d11=' + d11 + '&d12=' + d12 + '&d13=' + d13 + '&d14=' + d14 + '&d15=' + d15,

        dataType: 'json',

        success: function (data) {

        	alert( data["message"] );

        	if( data["code"] == 100 )
        		location.href = 'templates';

        },error: function(request, status, error){
            alert(request.responseText);
        }

    });

}

var previewModelo5  =  function ( d1, d2, d3, d4, d5, d6, d7, d8, d9, d10, d11, d12, d13, d14, d15, idModelo ) {
	var nameProp = $('#salvar').val();

  var link='nameProp=' + nameProp + '&id=' + idModelo + '&d1=' + d1 + '&d2=' + d2 + '&d3=' + d3 + '&d4=' + d4 + '&d5=' + d5 + '&d6=' + d6 + '&d7=' + d7 + '&d8=' + d8 + '&d9=' + d9 + '&d10=' + d10 + '&d11=' + d11 + '&d12=' + d12 + '&d13=' + d13 + '&d14=' + d14 + '&d15=' + d15;
    $.ajax({

        type: 'POST',

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        url: $("#route-preview").val(),

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

        url: 'ajax/imoveis/sendEmail',

        data: 'text1=' + text1 + '&text2=' + text2 + '&imgUrl1=' + imgUrl1 + '&dorms=' + dorms + '&suites=' + suites + '&vagas=' + vagas + '&metragem=' + metragem + '&edit1=' + edit1 + '&edit2=' + edit2 + '&edit3=' + edit3 + '&edit4=' + edit4 + '&img1=' + img1 + '&img2=' + img2 + '&img3=' + img3 + '&img4=' + img4 + '&local=' + local + '&mapa=' + mapa,

        dataType: 'json',

        success: function (data) {

        	alert( data );

        },error: function(request, status, error){
            alert(request.responseText);
        }

    });

}

var consultaImoveis  =  function ( offset, search ) {

    $.ajax({

        type: 'POST',

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        url: $("#route-imoveis").val(),

        data: 'offset=' + offset + '&search=' + search,

        dataType: 'json',

        success: function (data) {

            if( data["imoveis"].length > 0 ) {

            	$( '.nodata' ).hide();

            	$( '.bodyImovelModal' ).find( "tr" ).not(":first").remove();

            	$( ".btn-next" ).prop("disabled", false);

            	if( offset > 0 ) {
            		$( ".btn-prev" ).prop("disabled", false);
            	}else {
            		$( ".btn-prev" ).prop("disabled", true);
            	}

            	if( data["count"] == ( offset + data["imoveis"].length ) ) {
            		$( ".btn-next" ).prop("disabled", true);

            		if( offset > 0 )
            			$( ".btn-prev" ).prop("disabled", false);
            		else
            			$( ".btn-prev" ).prop("disabled", true);
            	}

            	for( var i = 0; i < data.imoveis.length; i++) {

					var $id    = null;
					var $title = null;
					var $ref   = null;
					var $ofe   = null;
					var $tr    = null;

            		$id     =   data.imoveis[i].id;

            		$title  =   $( '<td></td>' ).text( data.imoveis[i].title ).css({ "width" : "70%" });

            		$ref    =   $( '<td></td>' ).text( data.imoveis[i].ref ).css({ "width" : "20%" });

            		$ofe    =   $( '<td></td>' ).text( data.imoveis[i].oferta ).css({ "width" : "10%" });

            		$tr     =   $( '<tr class="tr-imovel"></tr>' ).attr({ "data-tr" : $id });

            		$tr.append( $title ).append( $ref ).append( $ofe );

            		$( '.bodyImovelModal' ).append( $tr );

            	}

            }else {

            	$( '.nodata' ).show();

            	$( '.bodyImovelModal' ).find( "tr" ).not(":first").remove();

            	$( ".btn-next" ).prop("disabled", true);

            	$( ".btn-prev" ).prop("disabled", true);

            }

            $( '#selectImovelModal' ).modal();

        },error: function(request, status, error){

            alert( "Ocorreu um erro inesperado" );

        }

    });

}

var getImagesImoveis  =  function ( offset, id ) {

    $.ajax({

        type: 'POST',

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        url: $("#route-imoveis-imagens").val(),

        data: 'offset=' + offset + '&id=' + id,

        dataType: 'json',

        success: function (data) {

        	if( data["imoveis"].length > 0 ) {

        		$( '.container-img' ).find("img, p").remove();

            	$( ".btn-img-next" ).prop("disabled", false);

            	if( offset > 0 ) {
            		$( ".btn-img-prev" ).prop("disabled", false);
            	}else {
            		$( ".btn-img-prev" ).prop("disabled", true);
            	}

            	if( data["count"] == ( offset + data["imoveis"].length ) ) {
            		$( ".btn-img-next" ).prop("disabled", true);

            		if( offset > 0 )
            			$( ".btn-img-prev" ).prop("disabled", false);
            		else
            			$( ".btn-img-prev" ).prop("disabled", true);
            	}

            	for( var i = 0; i < data.imoveis.length; i++) {

            		$img  =   $( '<img class="img-select" />' ).attr({ "title" : "Selecione essa imagem", "src" : data.imoveis[i].img, "data-id" : data.imoveis.id  }).css({ "width" : "140px", "height" : "140px", "padding" : "10px" });

            		$( '.container-img' ).append( $img );

            	}
        	}else {
        		$( '.container-img' ).find("img, p").remove();
        		$( '.container-img' ).append("<p style='text-align: center;'>Nenhuma imagem encontrada</p>")
        	}

        },error: function(request, status, error){
            alert(request.responseText);
        }

    });

}

var getInfoDormsImovel  =  function ( id ) {

    $.ajax({

        type: 'POST',

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        url: $("#route-imoveis-dormitorios").val(),

        data: 'id=' + id,

        dataType: 'json',

        success: function (data) {
        	$( '.closeModalSelectImovel' ).trigger( 'click' );
			$( '#dorms' ).val( data["dorms"] )
			$( '#suites' ).val( data["suite"] )
			$( '#vagas' ).val( data["vagas"] )
			$( '#metragem' ).val( data["area"] )
        },error: function(request, status, error){
            alert(request.responseText);
        }

    });

}

var getInfoGeral  =  function ( id ) {

    $.ajax({

        type: 'POST',

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        url: $("#route-imoveis-informacoes").val(),

        data: 'id=' + id,

        dataType: 'json',

        success: function (data) {
        	$( '.closeModalSelectImovel' ).trigger( 'click' );
			$( '#localidade' ).val( "Localidade: " + data["local"] )
			$( '#video' ).val( data["video"] )
        },error: function(request, status, error){
            alert(request.responseText);
        }

    });

}

function hideShowTableAndButton( hide ) {

	if( hide ) {
		$( '.btn-prev' ).hide();
		$( '.btn-next' ).hide();
		$( '.table-imoveis' ).hide();
	}else {
		$( '.btn-prev' ).show();
		$( '.btn-next' ).show();
		$( '.table-imoveis' ).show();
	}

}

function hideShowContainerIMG( hide ) {

	if( hide ) {
		$( '.btn-img-prev' ).hide();
		$( '.btn-img-next' ).hide();
		$( '.container-img' ).hide();
	}else {
		$( '.btn-img-prev' ).show();
		$( '.btn-img-next' ).show();
		$( '.container-img' ).show();
	}

	$( '.container-img' ).find( 'img, p' ).remove();

}

//response form enviar
function responseAdicionarEvento(data, statusText, xhr, $form)  {

    if( data["code"] == 100 ) {

    	$( ".textoImgGoogle" ).text( "Imagem selecionada: " );

    	$( '.imageGoogle' ).attr( "src", data["urlimg"] ).show();

    }else {

    	alert( data["message"] );

    }

}
/*
if( isEdit == '1' ) {

	$( '.message-image' ).text("");
	$( '.selected-img' ).show();

	$( '#img1' ).show();
	$( '#img2' ).show();
	$( '#img3' ).show();
	$( '#img4' ).show();

	$( '.imageGoogle' ).show();

}*/

$(document).ready(function() {
    function salvarModelos(element, item, nameProp, page, template) {

        let demo = $(element);

        html2canvas(demo, {
            allowTaint: false,
            useCORS: true,
            logging: false,
            onrendered: function(canvas) {
                try {
                    var modelo = $("#modelo").val();
                    var img = canvas.toDataURL();
                    var output = encodeURIComponent(img);
                    var param = window.location.search + "&image=" + output + "&modelo=" + modelo + '&item=' + item + '&nomeProp=' + nameProp + '&template_id=' + template;
                    var route = $("#route-store-images").val();
                    var modelosRoute = $("#route-modelos").val();
                    $.ajax({
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: route,
                        data: param,
                        dataType: 'json',
                        success: function(response) {
                            //console.log(response.code);
                            if (template == 1 && item == 4) {
                                $('.alert-maxxxx').hide();
                                //alert(response.message)
                                if (response.code == 100) {
                                    setTimeout(function() {
                                        location.href = modelosRoute;
                                    }, 2000);
                                }
                            } else if (template == 2 && item == 3) {
                                $('.alert-maxxxx').hide();
                                //alert(response.message)
                                if (response.code == 100) {
                                    setTimeout(function() {
                                        location.href = modelosRoute;
                                    }, 2000);
                                }
                            } else if (template == 3 && item == 7) {
                                $('.alert-maxxxx').hide();
                                //alert(response.message)
                                if (response.code == 100) {
                                    setTimeout(function() {
                                        location.href = modelosRoute;
                                    }, 2000);
                                }
                            } else if (template == 4 && item == 5) {
                                $('.alert-maxxxx').hide();
                                //alert(response.message)
                                if (response.code == 100) {
                                    setTimeout(function() {
                                        location.href = modelosRoute;
                                    }, 2000);
                                }
                            } else if (template == 5 && item == 3) {
                                $('.alert-maxxxx').hide();
                                //alert(response.message)
                                if (response.code == 100) {
                                    setTimeout(function() {
                                        location.href = modelosRoute;
                                    }, 2000);
                                }
                            }
                            console.log('salvo com sucesso');
                        },
                        error: function(request, status, error) {
                            console.log('erro: ' + error);
                        }
                    });
                } catch (e) {
                    alert(e);
                }
            }
        });
    }

    $('.salvar-mod1').click(function(e) {
        var nameProp = $('#nomePropaganda').val();
        var page = "save_modelo1";
        var template = 1;
        $('.alert-maxxxx').show();

        salvarModelos('#top0', 0, nameProp, page, template);
        salvarModelos('#top1', 1, nameProp, page, template);
        salvarModelos('#top2', 2, nameProp, page, template);
        salvarModelos('#top3', 3, nameProp, page, template);
        salvarModelos('#top4', 4, nameProp, page, template);
    });

    $('.salvar-mod2').click(function(e) {
        var nameProp = $('#nomePropaganda').val();
        var page = "save_modelo2";
        var template = 2;
        $('.alert-maxxxx').show();
        salvarModelos('#top0', 0, nameProp, page, template);
        salvarModelos('#top1', 1, nameProp, page, template);
        salvarModelos('#top2', 2, nameProp, page, template);
        salvarModelos('#top3', 3, nameProp, page, template);
    });

    $('.salvar-mod3').click(function(e) {
        var nameProp = $('#nomePropaganda').val();
        var page = "save_modelo3";
        var template = 3;
        $('.alert-maxxxx').show();

        setTimeout(function() {
            salvarModelos('#top0', 0, nameProp, page, template);
        }, 5000);

        setTimeout(function() {
          salvarModelos('#top1', 1, nameProp, page, template);
        }, 10000);

        setTimeout(function() {
          salvarModelos('#top2', 2, nameProp, page, template);
        }, 15000);

        setTimeout(function() {
          salvarModelos('#top3', 3, nameProp, page, template);
        }, 20000);

        setTimeout(function() {
          salvarModelos('#top4', 4, nameProp, page, template);
        }, 25000);

        setTimeout(function() {
          salvarModelos('#top5', 5, nameProp, page, template);
        }, 30000);

        setTimeout(function() {
          salvarModelos('#top6', 6, nameProp, page, template);
        }, 35000);

        setTimeout(function() {
          salvarModelos('#top7', 7, nameProp, page, template);
        }, 45000);

    });

    $('.salvar-mod4').click(function(e) {
        var nameProp = $('#nomePropaganda').val();
        var page = "save_modelo4";
        var template = 4;
        $('.alert-maxxxx').show();

        setTimeout(function() {
            salvarModelos('#top0', 0, nameProp, page, template);
        }, 5000);

        setTimeout(function() {
          salvarModelos('#top1', 1, nameProp, page, template);
        }, 10000);

        setTimeout(function() {
          salvarModelos('#top2', 2, nameProp, page, template);
        }, 15000);

        setTimeout(function() {
          salvarModelos('#top3', 3, nameProp, page, template);
        }, 20000);

        setTimeout(function() {
          salvarModelos('#top4', 4, nameProp, page, template);
        }, 25000);

        setTimeout(function() {
          salvarModelos('#top5', 5, nameProp, page, template);
        }, 30000);
    });

    $('.salvar-mod5').click(function(e) {
        var nameProp = $('#nomePropaganda').val();
        var page = "save_modelo5";
        var template = 5;
        $('.alert-maxxxx').show();

        setTimeout(function() {
          salvarModelos('#top0', 0, nameProp, page, template);
        }, 5000);

        setTimeout(function() {
          salvarModelos('#top1', 1, nameProp, page, template);
        }, 10000);

        setTimeout(function() {
          salvarModelos('#top2', 2, nameProp, page, template);
        }, 15000);

        setTimeout(function() {
          salvarModelos('#top3', 3, nameProp, page, template);
        }, 20000);

    });
});

/**
 * Created by thiago on 23/07/2018.
 */
var baseUrl = $('meta[name=base-url]').attr("content");
$(function () {



    $('#carrageMais').click(function () {
        page += 1
        carrega()
    })



    var $formAposta   = $('#Aposta-form');
    var $formNegado   = $('#negado-form');
    var $formApostar  = $('#Apostar-form');
    var $formApostado = $('#Apostado-form');
    var status = false;

    var $divForms1        = $('#div-forms1');
    var $modalAnimateTime = 300;
    var $msgAnimateTime   = 50;
    var $msgShowTime      = 3000;

    $('#carrageMais').click(function () {
        page += 1
        carrega()
    })

    $('#aposta-modal').on('hidden.bs.modal', function (e) {
        // do something...
        location.reload();
        console.warn("fui chamado");
    })

    $('#escolha_numero_continuar').click(function () {

        // var numeroescolhido = $('#numeroescolhido').val();

        console.log(numeroEscolido)
        var id_assinante    = $('#id_assinante').val();
        var id_rifa         = $('#id_rifa').val();
        var valor_rifa      = $('#valor_rifa').val();

        var valor_Total = $('#valor_aposta').val();

        $.ajax({
            url    : baseUrl+"/items/store",
            type   : "post",
            data   : "id_assinante=" + id_assinante + "&valor_Total=" + valor_Total + "&id_numero=" + numeroEscolido + "&id_rifa=" + id_rifa + "&valor_rifa=" + valor_rifa+"&_token="+currentToken,
            success: function (data) {
                if (data > 0) {
                    modalAnimate($formAposta, $formApostar);

                }
                else {
//					$('#aposta-modal').modal('hide');
                    status = true
                    //                    $('#negado-form').css('display', 'block');
                    //                    parar_contagem();
                }
            }
        })
        $formAposta.hide();

        $formApostado.show();

    });

    $('#btn_final_aposta1').click(function () {
        $formApostado.hide();
        //        location.reload();
    });
    $('#btn_final_aposta2').click(function () {
        $formApostado.hide();
//		location.reload();
        $('#aposta-modal').modal('hide');
    });
    $('#btn_final_aposta3').click(function () {

        zera_contagem();
        $formApostado.hide();

    });


})

$(document).ready(function () {
    carrega();

    $("a[data-toggle=modal]").click(function () {
        var $numeroescolhido = $(this).attr('id');
        var $liberado        = $('#liberado').val();
        $('#numeroescolhido').val($numeroescolhido);
        $('#numeroescolhido1').text($numeroescolhido);

        if ($liberado == 0) {
            $formNegado.show();
            $formAposta.hide();
            $formApostado.hide();
        }
        if ($liberado == 1) {
            $formNegado.hide();
            $formAposta.show();
            $formApostado.hide();
        }
    });
});
var isEmpty = function(data) {
    if(typeof(data) === 'object'){
        if(JSON.stringify(data) === '{}' || JSON.stringify(data) === '[]'){
            return true;
        }else if(!data){
            return true;
        }
        return false;
    }else if(typeof(data) === 'string'){
        if(!data.trim()){
            return true;
        }
        return false;
    }else if(typeof(data) === 'undefined'){
        return true;
    }else{
        return false;
    }
}
var pause   = 0;
var count   = 30;
var counter = setInterval(timer, 1000);

var stoped = 0
var page = 1
var totalPage = 1;

var currentToken = $('meta[name="csrf-token"]').attr('content');

var idRifa = $('input[name="idItem"]').val();

function carrega(){


    $('#loading').html("<img src='"+baseUrl+"/assets/imagem/loader.gif'/> Carregando Bilhetes...").fadeIn('fast');
    if(page <= totalPage){

        $.ajax({
            type   : "POST",
            url    : baseUrl+"/items/lista/"+ idRifa,
            data   :{_token: currentToken, page: page},
            success: function (data) {


                $('#loading').fadeOut('fast');
                totalPage = data.total_page

                $.each(data.dados, function( index, item ) {

                    if (item.status_logado == true){



                        if(item.thumb != ""){
                            $("#container-avatar").append("<button type='button' " +
                                "class='btn btn-success btn-circle btn-xl radius-number'" +
                                "title='teste'" +
                                "style='background-repeat:  no-repeat;" +
                                " background-size: cover;" +
                                "background-image: url("+item.thumb+");'></button>");
                        }else{
                            $("#container-avatar").append("<button type='button'" +
                                "id= '"+item.numero+"'"+
                                "name= '"+item.numero+"'"+
                                "class='btn btn-success btn-circle btn-xl radius-number checkboxTamanho'>"+item.numero+"</button>");

                        }
                    }else{
                        if(item.thumb != ""){
                            $("#container-avatar").append("<button type='button' " +
                                "class='btn btn-success btn-circle btn-xl radius-number'" +
                                "title='teste'" +
                                "style='background-repeat:  no-repeat;" +
                                " background-size: cover;" +
                                "background-image: url("+item.thumb+");'></button>");
                        }else{
                            $("#container-avatar").append("<div class='radius-number'>"+ item.numero+"</div>")

                        }


                    }

                });

            }
        });
    }else{
        $('#carrageMais').fadeOut('fast');
        $('#loading').fadeOut('fast');

    }

}


function timer() {
    count                                      = count - 1;
    document.getElementById("timer").innerHTML = count + " segs";

    var valor_rifa  = $('#valor_rifa').val();
    var valor_Total = 0;


    var numero_rifa = $(this).attr('id');
    var nome        = $(this).attr('name');

    if (count < 1) {

        StopFunction();
        $.ajax({
            type   : "POST",
            url    : baseUrl+"/items/store",
            data   : "id_rifa=" + idRifa +"&numero_rifa=" + numero_rifa + "&acao=excluir&_token="+currentToken,
            success: function (data) {

                $("#" + numero_rifa).addClass('btn-success');
                $("#" + numero_rifa).attr('name', +numero_rifa);
                $("#NumerosEscolhidos").html("Números escolhidos: " + data);
                $("#NumerosEscolhidos1").html("Números escolhidos:<br> " + data);
                $("#caixaEscolhidos").css("display", "block");
                $("#btnComprar").css("display", "none");
                $("#timer").css("display", "none");
                //					$("#quadro-cinza").css("display", "none");
                location.reload();

            }
        });

    }
}

function StopFunction() {
    clearInterval(counter);
    window.count                               = 30;
    window.stoped                              = 30
    document.getElementById("timer").innerHTML = count + " segs";
}

function ReStartFunction() {
    if (counter) {
        clearInterval(counter);
        window.count                               = 30;
        window.counter                             = setInterval(timer, 1000);
        document.getElementById("timer").innerHTML = count + " segs";
    }
}

/*
 *
 */
$('.checkboxTamanho1').click(function () {
    // alert("wwwwwwwwwwwwww");
    MostraErro('<p>Seus cr&eacute;ditos s&atilde;o insuficientes&nbsp;para adquirir numero!</p>', 'Créditos insuficientes', '0');
});
var quantidade_bilhetes = 0;
var numeroEscolido = [];
$("#container-avatar").on("click", "button.checkboxTamanho", function() {


    var numero_rifa = $(this).attr('id');
    var nome        = $(this).attr('name');
    quantidade_bilhetes = $('#quantidade_bilhetes').val();
    var valor_rifa          = $('#valor_rifa').val();
    var valor_saldo         = $('#valor_saldo').val();


    if(quantidade_bilhetes <= 1 ){
        ReStartFunction();
    }


    if (numero_rifa == nome) {

        $('.comprar-status').fadeIn('fast');
        quantidade_bilhetes = parseInt(quantidade_bilhetes) + parseInt(1);
        $('#quantidade_bilhetes').val(quantidade_bilhetes);
        var valor_aposta = (quantidade_bilhetes * valor_rifa);
        $('#valor_aposta').val(valor_aposta);
        var n = valor_aposta.toFixed(2);
        $("#Valor_Aposta_formatado").html("Sua aposta: " + n);

        if (valor_aposta < valor_saldo) {
            $("#laber_continuar").css("display", "none");
            $("#escolha_numero_continuar").css("display", "block");
        }
        else {
            $("#laber_continuar").css("display", "block");
            $("#escolha_numero_continuar").css("display", "none");
        }

        numeroEscolido.push(numero_rifa)
        $("#" + numero_rifa).removeClass('btn-success');
                $("#" + numero_rifa).attr('name', "d" + numero_rifa);
                $("#NumerosEscolhidos").html("Números escolhidos: " + numeroEscolido);
                $("#NumerosEscolhidos1").html("Números escolhidos:<br> " + numeroEscolido);
                $("#timer").css("display", "block");
                $("#caixaEscolhidos").css("display", "block");
                $("#btnComprar").css("display", "block");
                $("#quadro-cinza").css("display", "block");

    }
    else {
        var numero_rifa = $(this).attr('id');


        quantidade_bilhetes = quantidade_bilhetes - 1
                $('#quantidade_bilhetes').val(quantidade_bilhetes );
                var valor_aposta = (quantidade_bilhetes * valor_rifa);
                $('#valor_aposta').val(valor_aposta);
                var n = valor_aposta.toFixed(2);

                $("#Valor_Aposta_formatado").html("Sua aposta: " + n);
                if (quantidade_bilhetes == 0 ){
                    StopFunction()
                    $('.comprar-status').fadeOut('fast');

                }
                var index = numeroEscolido.indexOf(numero_rifa);
                if (index > -1) {
                    numeroEscolido.splice(index, 1);
                }


                $("#" + numero_rifa).addClass('btn-success');
                $("#" + numero_rifa).attr('name', +numero_rifa);
                $("#NumerosEscolhidos").html("Números escolhidos: " + numeroEscolido);
                $("#NumerosEscolhidos1").html("Números escolhidos:<br> " + numeroEscolido);

                $("#caixaEscolhidos").css("display", "block");
                $("#timer").css("display", "block");
                $("#btnComprar").css("display", "block");
                $("#quadro-cinza").css("display", "block");
    }
})

$('.checkboxTamanho').click(function () {

    var numero_rifa = $(this).attr('id');
    var nome        = $(this).attr('name');
    ReStartFunction();

    var quantidade_bilhetes = $('#quantidade_bilhetes').val();
    var valor_rifa          = $('#valor_rifa').val();
    var valor_saldo         = $('#valor_saldo').val();

    quantidade_bilhetes = parseInt(quantidade_bilhetes) + parseInt(1);
    $('#quantidade_bilhetes').val(quantidade_bilhetes);

    var valor_aposta = (quantidade_bilhetes * valor_rifa);
    $('#valor_aposta').val(valor_aposta);
    $("#btnComprar").css("display", "block");
    var n = valor_aposta.toFixed(2);

    $("#Valor_Aposta_formatado").html("Sua aposta: " + n);

    if (valor_aposta < valor_saldo) {
        $("#laber_continuar").css("display", "none");
        $("#escolha_numero_continuar").css("display", "block");
    }
    else {
        $("#laber_continuar").css("display", "block");
        $("#escolha_numero_continuar").css("display", "none");
    }


    if (numero_rifa == nome) {



    }
    else {
        var numero_rifa = $(this).attr('id');

        $.ajax({
            type   : "POST",
            url    : baseUrl+"/items/store",
            data   : "id_rifa=" + idRifa +"&numero_rifa=" + numero_rifa + "&acao=parcial&_token="+currentToken,
            success: function (data) {


                $("#" + numero_rifa).addClass('btn-success');
                $("#" + numero_rifa).attr('name', +numero_rifa);
                $("#NumerosEscolhidos").html("Números escolhidos: " + data);
                $("#NumerosEscolhidos1").html("Números escolhidos:<br> " + data);

                $("#caixaEscolhidos").css("display", "block");
                $("#timer").css("display", "block");
                $("#btnComprar").css("display", "block");
                $("#quadro-cinza").css("display", "block");
            }
        });
    }
});
StopFunction();

$('#quantidade_bilhetes').val(0);
$("#btnComprar").css("display", "none");
$("#timer").css("display", "none");
$("#quadro-cinza").css("display", "none");
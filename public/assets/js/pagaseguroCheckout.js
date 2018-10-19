/**
 * Created by thiago on 28/07/2018.
 */
var baseUrl = $('meta[name=base-url]').attr("content");
var token = $('meta[name=csrf-token]').attr("content");
var root = baseUrl+"/";

var orderID  = null
var status  = null
var _data = null

paypal.Button.render({
    // Configure environment
    env: 'sandbox',
    client: {
        sandbox: 'ARaqrV5S94jkd2cf5_225Mz1ohJB7KNaBJoQDiXEHdPwyG596reOOBtZoqTL13PPt0rZdPSJhcpmoOIi',
        production: '<insert production client id>'

    },
    // Customize button (optional)

    // Set up a payment
    payment: function(data, actions) {
        return actions.payment.create({
            transactions: [{
                amount: {
                    total: '0.01',
                    currency: 'USD'
                }
            }]
        });
    },
    // Execute the payment
    onAuthorize: function(data, actions) {
        return actions.payment.execute().then(function() {
            // Show a confirmation message to the buyer
            window.alert('Thank you for your purchase!');
        });
    }
}, "#paypal-button-container");

function iniciarSessao() {


    $.ajax({
        type: "POST",
        url: root+'api/pagseguro/salvar',
        data:_data,
        success: function (xml) {
            console.log(xml)

            if(xml.error == false){

                orderID = xml.orderID
                PagSeguroLightbox({
                    code: xml.code[0]
                }, {
                    success : function(transactionCode) {
                        status = 2
                        salvarTransacao()
                    },
                    abort : function() {
                        status = 7
                        salvarTransacao()
                        alert("abort");
                    }
                });
            }else if(xml.orderID == null){
                salvarTransacao(7)
            }

        }

    });

    
}

function salvarTransacao() {
    $.ajax({
        type: "POST",
        url: root+'pagseguro/salvar/'+orderID,
        data:{
            status:status,
            _token:token
        },
        success: function (data) {
            console.log(data)
            location.reload()
        },
        error: function (data) {
            console.log(data)
        }


    });
}

function listaMeioPagamento() {

    PagSeguroDirectPayment.getPaymentMethods({
        amount: 1.00,
        success: function(data) {
            //meios de pagamento disponíveis\
            var url = "https://stc.pagseguro.uol.com.br"

            $.each(data.paymentMethods.CREDIT_CARD.options, function (i, obj) {

                var urlFinal = url+obj.images.SMALL.path
               $(".cartaoCredito").append("<div class='img-pag'><img src='"+urlFinal+"'> "+obj.displayName+"</div>");
            });

            var urlBoleto = url+data.paymentMethods.BOLETO.options.BOLETO.images.SMALL.path;

            $(".boleto").append("<div class='img-pag'><img src= '"+urlBoleto+"'> "+data.paymentMethods.BOLETO.options.BOLETO.displayName+"</div>");

            $.each(data.paymentMethods.ONLINE_DEBIT.options, function (i, obj) {

                var urlFinal = url+obj.images.SMALL.path

                $(".debito").append("<div class='img-pag'><img src='"+urlFinal+"'> "+obj.displayName+"</div>");
            });


        },
        error: function(response) {
            //tratamento do erro
        },
        complete: function(response) {
            //tratamento comum para todas chamadas
        }
    });
    
}
$("#numero").keyup(function( event ) {
    var numeroCartao = $(this).val();
    var qtdCaracter = numeroCartao.length;

    if(qtdCaracter == 6){
        PagSeguroDirectPayment.getBrand({
            cardBin: numeroCartao,

            success: function (data) {
                var bandeiraCartao = data.brand.name
                var url = "https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/42x20/"+bandeiraCartao+".png"
                // $(".bandeira").html("<img src='"+url+"'>");
                name = data.brand.name
                $("#bandeira").val(name)
            },
            error: function (error) {
                // $(".bandeira").empty();
                $("#bandeira").val()
                alert("Cartão invalido");
            }

        });
    }

})
$(function () {

    var valorTotal   = $("#valorTotal").val();

    // iniciarSessao

    $('.btn-radio').click(function(e) {
        $('.btn-radio').not(this).removeClass('active')
            .siblings('input').prop('checked',false)
            .siblings('.img-radio').css('opacity','0.5');
        $(this).addClass('active')
            .siblings('input').prop('checked',true)
            .siblings('.img-radio').css('opacity','1');
    });


    $("#checkoutForm").validate();

    $("#editJogado").validate({
        rules: {
            name: {
                required: true
            },
            numero: {
                required: true,
                maxlength:16

            },
            bandeira:{
                required: true,
            },
            cvv:{
                required: true,
                minlength: 3
            },
            validacao:{
                required: true,
                minlength: 7,

            },
            accet:"required",
            topic: "required"

        },
        messages:{
            name:{
                required: "Campo Nome obrigatório"
            },
            numero:{
                required: "Campo numero do cartão e obrigatório",
                maxlength:"Numero maximo de caracter são 16"
            },
            bandeira:{
                required: "Bandeira e obrigatório",

            },
            cvv:{
                required: "Campo cvv e  obrigatório",
                maxlength:"Numero maximo de caracter são 3"
            },
            validacao:{
                required: "Campo validade e  obrigatório",
                maxlength:"Numero maximo de caracter são 7"
            },
            cpf:{
                required: "CPF obrigatório ",

            }

        },

        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });
    $('#code_user').on('blur', function(){
        if($.trim($("#code_user").val()) != ""){
            $("#code").val($(this).val());
        }
    });

        $('#cep').on('blur', function(){
        if($.trim($("#cep").val()) != ""){
            $("#mensagem").html('(Aguarde, consultando CEP ...)');
            $.getJSON( "http://cep.republicavirtual.com.br/web_cep.php?formato=json&cep="+$("#cep").val(), function(data) {
                if(data.resultado){
                    $("#endereco").val(data.tipo_logradouro +" "+data.logradouro);
                    $("#bairro").val(data.bairro);
                    $("#cidade").val(data.cidade);
                    $("#estado").val(data.uf);
                }

                $("#mensagem").html('');
            });

        }
    });

    $("#btn_cart").click(function (event) {
        var validator = $("#editJogado").validate();
        console.log(validator)
        validator.resetForm();
        $( ".appen-card").slideToggle("slow");
        event.preventDefault();
    })



    $("#finalizarComprar").validate({
        submitHandler: function(form) {
            // some other code
            // maybe disabling submit button
            // then:

            var type = $('#formPagamento').val();
           var data = {
               cupom: $('#code').val(),
               type: type,
               _token:token
            }

            _data = data

            if(type == 1){
                iniciarSessao()
            }else{
                form.submit();

            }


        },
        rules: {
            form: {
                required: true
            },


        },
        messages:{
            form:{
                required: "Campo Forma de pagamento obrigatório"
            }



        },

        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });



    $("#button_finalizar").click(function (event) {
        var form = $("#finalizarComprar");

        form.find('input, textarea, select').each(function(i, field) {
            // var input = $("#form_id :input[name='"+field+"']")
            console.log(field.name)
        });

        form.submit();
        event.preventDefault();
    });

    $("input[name=forma]:radio").click(function() {

        var idCard = $("#idCard");
        var tokencard = $("#tokencard");
        var typePagamento = $("#typePagamento");
        var id = $(this).attr( "id" );
        var hasCard = $("#hasCard");
        var qtdParcela = $("#qtdParcela");
        var valorParcela = $("#valorParcela");

        idCard.val(id);

        if ($(this).attr( "label" ) == "card"){
            var cvv = $(this).attr( "cvv" );
            var expirationMonth = $(this).attr( "expirationMonth" );
            var expirationYear = $(this).attr( "expirationYear" );
            var brand = $(this).attr( "brand" );

            var valor = $(this).val();

            console.log(valor)

            PagSeguroDirectPayment.createCardToken({
                cardNumber: valor,
                brand: brand,
                cvv: cvv,
                expirationMonth: expirationMonth,
                expirationYear: expirationYear,
                success: function (data) {
                    tokencard.val(data.card.token);
                    typePagamento.val("card");

                },
                error:function(error){
                    console.log(error)
                }

            });

            PagSeguroDirectPayment.onSenderHashReady(function(response){
                if(response.status == 'error') {
                    console.log(response.message);
                    hasCard.val("");
                    return false;
                }


                var hash = response.senderHash; //Hash estará disponível nesta variável.

                hasCard.val(hash)
            });

            console.log(valorTotal)
            PagSeguroDirectPayment.getInstallments({
                amount: valorTotal,
                maxInstallmentNoInterest:2,
                brand:  brand,
                success: function (data) {

                    $.each(data.installments, function (i ,obj) {

                        $("#qtdParcelaSect").show().empty();
                        $("#qtdParcelaSect").show().append("<option value=''>Selecione uma parcela</option>")
                        $.each(obj, function(i, obj2){
                            var value = obj2.installmentAmount.toFixed(2);
                            var valueString = "R$ "+obj2.installmentAmount.toFixed(2).replace(".", ",");
                            var label = obj2.installmentAmount.toFixed(2);

                            $("#qtdParcelaSect").show().append("<option value='"+obj2.quantity+"' label='"+label+"'>"+valueString+"</option>");
                        })
                    });

                },
                error:function (error) {
                    $("#qtdParcelaSect").hide();
                }

            });
        }else{
            typePagamento.val("boleto");
            tokencard.val("");
            hasCard.val("");
        }


    });

    $("#qtdParcelaSect").on("change", function () {
        var ValueSelected=document.getElementById('qtdParcelaSect');
        $("#valorParcela").val(ValueSelected.options[ValueSelected.selectedIndex].label);

        console.log(ValueSelected.options[ValueSelected.selectedIndex].label)
        $("#qtdParcela").val(ValueSelected.options[ValueSelected.selectedIndex].value);
    })
})

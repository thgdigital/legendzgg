/**
 * Created by thiago on 28/07/2018.
 */
var root = "http://"+document.location.hostname+":8000/";

function iniciarSessao() {

    $.ajax({
        url: root+"pagseguro",
        type: "GET",
        dataType: "json",
        success:function (data) {
            console.log(data.id)
            PagSeguroDirectPayment.setSessionId(data.id);
        },
        error: function (request, status, error) {
         console.warn(error)
        },
        complete: function () {
            listaMeioPagamento()
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

$(function () {
    iniciarSessao()

})

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
        }
    });
    
}
var name = ""



$("#numero").keyup(function( event ) {
    var numeroCartao = $(this).val();
    var qtdCaracter = numeroCartao.length;

    if(qtdCaracter == 6){
        PagSeguroDirectPayment.getBrand({
            cardBin: numeroCartao,

            success: function (data) {
                var bandeiraCartao = data.brand.name
                var url = "https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/42x20/"+bandeiraCartao+".png"
                $(".bandeira_cartao").html("<img src='"+url+"'>");
                name = data.brand.name
                $("#bandeira").val(name)
            },
            error: function (error) {
                $(".bandeira_cartao").empty();
                $("#bandeira").val()
                alert("Cartão invalido");
            }

        });
    }

})
$(function () {
    iniciarSessao()



})

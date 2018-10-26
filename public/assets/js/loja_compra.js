/**
 * Created by thiago on 26/10/18.
 */
$(function () {
    var baseUrl = $('meta[name=base-url]').attr("content");

    $(".compras-loja").click(function (event) {

        console.log("fui chamado")
        var creditoID = $(this).attr("compra-id");
        window.location.href = baseUrl+"/loja/loja-compra/credito/"+creditoID

        event.preventDefault;
    });

    $(".compras-essencia").click(function (event) {
        var creditoID = $(this).attr("compra-essencia");
        window.location.href = baseUrl+"/loja/loja-compra/essencia/"+creditoID

        event.preventDefault;
    });
})
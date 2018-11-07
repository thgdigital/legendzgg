/**
 * Created by thiago on 26/10/18.
 */
$(function () {
    var baseUrl = $('meta[name=base-url]').attr("content");

    $(".compras-loja").click(function (event) {

        console.log("fui chamado")
        var creditoID = $(this).attr("compra-id");
        window.location.href = baseUrl+"/inventario/credito/"+creditoID

        event.preventDefault;
    });


    $(".compras-resgate").click(function (event) {
        var creditoID = $(this).attr("compra-resgate");
        window.location.href = baseUrl+"/inventario/resgate/"+creditoID

        event.preventDefault;
    });

})
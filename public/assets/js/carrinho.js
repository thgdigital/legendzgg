/**
 * Created by thiago on 28/07/2018.
 */


$(function () {
    var total = 1
    var qtd = 1

    $("#butto_decremento").click(function (event) {

        if(qtd > 1){
            --qtd;
            --total;

            var real = (qtd).toFixed(2).replace(".", ",");

            $(".qtd_carrinho").text(qtd);

            $(".valor_credito").text(qtd+" credito");

            $(".valor_total").text("R$ "+ real);
            $("#form_qtd").val(qtd);
            $("#form_unitario").val(1);
        }

        event.preventDefault();
    });

    $("#butto_incremento").click(function (event) {
            ++qtd;
            ++total;

        var real = (qtd).toFixed(2).replace(".", ",");

        $(".qtd_carrinho").text(qtd);

        $(".valor_credito").text(qtd+" credito");

        $(".valor_total").text("R$ "+ real);

        $("#form_qtd").val(qtd);
        $("#form_unitario").val(1);

        event.preventDefault();
    })

    $.ajax({

    })
})

/**
 * Created by thiago on 17/07/2018.
 */



$(function () {

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
    $("#cadastroEndereco").validate({
        rules: {
            cep:{
                required: true
            },
            endereco:{
                required: true
            },
            bairro:{
                required: true
            },
            cidade:{
                required: true
            },
            estado:{
                required: true
            },

        },
        messages:{
            cep:{
                required: "Campo cep obrigatório"
            },
            endereco:{
                required: "Campo endereço obrigatório"
            },
            bairro:{
                required: "Campo bairro obrigatório"
            },
            cidade:{
                required: "Campo cidade obrigatório"
            },
            estado:{
                required: "Campo estado obrigatório"
            },
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

});
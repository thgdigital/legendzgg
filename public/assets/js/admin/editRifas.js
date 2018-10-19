/**
 * Created by thiago on 25/09/2018.
 */
$(function () {
$("#formEditRifas").validate({
        rules: {
            name: {
                required: true
            },
            categoria: {

                required: true
            },
            date_inico: {

                required: true
            },
            date_fim: {
                required: true
            }

        },
        messages:{
            name:{
                required: "Campo Nome obrigatório"
            },
            date_fim:{
                required: "Campo Categoria obrigatório"
            },
            date_inico:{
                required: "Campo Data de inico obrigatório"
            },
            date_fim:{
                required: "Campo Data de fim obrigatório",
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

});

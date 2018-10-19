/**
 * Created by thiago on 25/09/2018.
 */
$(function () {
$("#formEditUser").validate({
        rules: {
            name: {
                required: true
            },
            email: {

                email: true
            },
            username: {

                required: true
            },
            nascimento: {

                required: true
            }

        },
        messages:{
            name:{
                required: "Campo Nome obrigatório"
            },
            username:{
                required: "Campo NickName obrigatório"
            },
            email:{
                required: "Email obrigatório",
                email:  "Precisa ser um e-mail  verdadeiro"
            },
            nascimento:{
                required: "Campo data de nascimento obrigatório"
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

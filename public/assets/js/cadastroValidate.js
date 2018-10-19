/**
 * Created by thiago on 17/07/2018.
 */

function PreviewImage() {
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

    oFReader.onload = function (oFREvent) {
        document.getElementById("uploadPreview").src = oFREvent.target.result;
    };
}

$(function () {


    $("#editJogado").validate({
        rules: {
            name: {
                required: true
            },
            email: {

                email: true
            },
            password_confirmation:{

                equalTo:"#senha"
            },


        },
        messages:{
            name:{
                required: "Campo Nome obrigatório"
            },
            nickName:{
                required: "Campo NickName obrigatório"
            },
            emailCadastro:{
                required: "Email obrigatório",
                email:  "Precisa ser um e-mail  verdadeiro"
            },
            nascimento:{
                required: "Campo data de nascimento obrigatório"
            },
            senha:{

                minlength:  "Sua senha precisar ser maior que 6"
            },
            password_confirmation:{

                equalTo: "Sua senha estão diferente"

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
    $("#cadastroJogado").validate({
        rules: {
            name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            nickName:{
                maxlength:6
            },
            senha:{
                required: true,
                minlength: 6
            },
            password_confirmation:{
                required: true,
                minlength: 6,
                equalTo:"#senha"
            },
            accet:"required",
            topic: "required"

        },
        messages:{
            name:{
                required: "Campo Nome obrigatório"
            },
            nickName:{
                required: "Campo NickName obrigatório",
                maxlength:"Numero maximo de caracter são 6"
            },
            emailCadastro:{
                required: "Email obrigatório",
                email:  "Precisa ser um e-mail  verdadeiro"
            },
            nascimento:{
                required: "Campo data de nascimento obrigatório"
            },
            senha:{
                required: "Senha obrigatório ",
                minlength:  "Sua senha precisar ser maior que 6"
            },
            password_confirmation:{
                required: "Campo confirma Senha obrigatório",
                minlength:  "Sua senha precisar ser maior que 6",
                equalTo: "Sua senha estão diferente"

            },
            accet:{
                required: "Voce precisar aceitar os termos",
            },
            topic: {
                required: "Precisar ser maior de idade",
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
/**
 * Created by thiago on 24/09/2018.
 */
$(function () {

    var baseUrl = $('meta[name=base-url]').attr("content");



    $("#formCredit").submit(function (event) {
        event.preventDefault();
        var url = baseUrl+'/'

        console.log($("#idAdmin").val())
        var dados = {
            id: $("#idTansacao").val(),
            valor: $("#credit").val(),
            admin: $("#idAdmin").val(),
            idUser:$("#idUser").val()

        }
        window.axios.post('/api/transacao/salve-credito',dados).then(({ data }) => {
               if(data.status == true){
                    location.reload()
               }else{
                    alert('Error ao inserir crédito')
            }
        })
    })
});
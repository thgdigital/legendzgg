/**
 * Created by thiago on 23/07/2018.
 */
var baseUrl = $('meta[name=base-url]').attr("content");

function myFunction() {
    /* Get the text field */
    var copyText = document.getElementById("myInput");


    /* Select the text field */
    copyText.select();

    /* Copy the text inside the text field */
    document.execCommand("copy");

    /* Alert the copied text */
    alert("Codigo copiado com sucesso: " + copyText.value);
}
$(function () {

});
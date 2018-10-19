/**
 * Created by thiago on 28/07/2018.
 */
var root = "http://"+document.location.hostname+":8000/";

$(function () {
    $('#cadList').DataTable({
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
        }
    });

})

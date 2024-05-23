let id_stazione = getQueryParameter('id');

function popola_campi_stazione() {
    // popolo i campi con i dati della stazinoe
    
    // prendo l'id dal link
    if (id_stazione) {
        $.get("../AJAX/popola_campi_stazione.php", {id:id_stazione}, function (data) {
            if (data["status"] == "ok") {
                $("#nome_stazione").val(data["nome"]);
                $("#numero_slot").val(data["n_slot"]);
            }
            else {
                alert(data["message"]);
            }
        }, "json");
    }
    
}
function aggiorna_info(){
    let nome_stazione = $("#nome_stazione").val();
    let numero_slot = $("#numero_slot").val();

    $.get("../AJAX/modifica_stazione.php", {
        id_stazione: id_stazione,
        nome_stazione:nome_stazione,
        numero_slot: numero_slot
    }, function(data){
        if(data["status"] == "ok"){
            window.location.href = "../pages/gestione_stazioni.php";
        }
        else{
            alert(data["message"]);
        }
    });

}
$(document).ready(function () {
    popola_campi_stazione();
    $("#admin").click(function () {
        window.location.href = "admin.php";
    });
    $("#conferma").click(function () {
        aggiorna_info();
    });
});


function getQueryParameter(param) {
    let queryString = window.location.search;
    let urlParams = new URLSearchParams(queryString);
    return urlParams.get(param);
}

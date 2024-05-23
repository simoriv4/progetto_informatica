$(document).ready(function () {
    gestione_stazioni();

    $("#logout").click(function () {
        logout();
    });

    $("#admin").click(function () {
        window.location.href = "admin.php";
    });

    // Delego l'evento click al documento per gestire i pulsanti dinamici
    $(document).on("click", ".remove", function () {
        let id = $(this).attr("id");
        $.post("../AJAX/rimuovi_stazione.php", { id_stazione: id }, function (data) {
            if (data["status"] == "ok") {
                // Ricarico la tabella
                gestione_stazioni();
            } else if (data["status"] == "ko") {
                alert(data["message"]);
            }
        }, 'json');
    });
});

function gestione_stazioni() {
    $.get("../AJAX/gestione_stazioni.php", {}, function (data) {
        if (data["status"] == "ok") {
            $("#myTable").html(data["message"]);
        } else if (data["status"] == "ko") {
            alert(data["message"]);
        }
    }, 'json');
}

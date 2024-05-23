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
        $.get("../AJAX/rimuovi_stazione.php", { id_stazione: id }, function (data) {
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
            // Distruggi la DataTable esistente se esiste
            if ($.fn.DataTable.isDataTable('#myTable')) {
                $('#myTable').DataTable().destroy();
            }

            // Rimuovi tutti i dati precedenti dalla tabella
            $('#myTable').empty();
            $("#myTable").html(data["message"]);
            // Inizializza DataTable
            $('#myTable').DataTable({
                // Opzioni personalizzate di DataTable
                paging: true,
                searching: true,
                ordering: true,
                info: true
            });
        } else if (data["status"] == "ko") {
            alert(data["message"]);
        }
    }, 'json');
}

function logout() {
    $.get("../AJAX/logout.php", {}, function (data) {
        if (data["status"] == "ok") {
            window.location.href = "login.php";
        } else if (data["status"] == "ko") {
            alert(data["message"]);
        }
    }, 'json');
}

function riepilogo() {
    $.get("../AJAX/riepilogo.php", {}, function (data) {
        if (data["status"] == "ok") {
            // svuoto gli altri div
            $("#tratte").empty();
            $("#profilo_content").empty();
            $("#riepilogo").html(data["message"]);
        } else if (data["status"] == "ko") {
            alert(data["message"]);
        }
    }, 'json');
}

function profilo() {
    $.get("../AJAX/profilo.php", {}, function (data) {
        if (data["status"] == "ok") {
            // svuoto gli altri div
            $("#myTable").empty();
            $("#riepilogo").empty();
            $("#profilo_content").html(data["html"]);
        } else if (data["status"] == "ko") {
            alert(data["message"]);
        }
    }, 'json');
}

function mostra_tratte() {
    $.get("../AJAX/tratte.php", {}, function (data) {
        if (data["status"] == "ok") {
            // svuoto gli altri div
            $("#profilo_content").empty();
            $("#riepilogo").empty();
            $("#myTable").html(data["message"]);
        } else if (data["status"] == "ko") {
            alert(data["message"]);
        }
    }, 'json');
}

$(document).ready(function () {
    $("#logout").click(function () {
        logout();
    });
    $("#tratte_percorse").click(function () {
        mostra_tratte();
    });
    $("#riepiloghi").click(function () {
        riepilogo();
    });
    $("#profilo").click(function () {
        profilo();
    });
});


function logout() {
    $.get("../AJAX/logout.php", {}, function (data) {
        if (data["status"] == "ok") {
            window.location.href = "login.php";
        }
        else if (data["status"] == "ko") {
            alert(data["message"]);
        }
    }, 'json');
}
$(document).ready(function () {
    $("#logout").click(function () {
        logout();
    });
    $("#signup_button").click(function () {
        window.location.href = "signup.php";
    });
    $("#gestione_stazioni").click(function () {
        window.location.href = "gestione_stazioni.php";
    });
    $("#gestione_bici").click(function () {
        window.location.href = "gestione_bici.php";
    });
});
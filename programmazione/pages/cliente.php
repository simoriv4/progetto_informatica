<?php
if (!isset($_SESSION))
    session_start();

if (isset($_SESSION["is_admin"]) && ($_SESSION["is_admin"])) {
    header("Location : index.php");
    die;
} else if ($_SESSION["is_admin"]) {
    // utente non loggato
    header("Location: admin.php");
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <!-- Includi Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Includi jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function show_rides() {
            $.get("../AJAX/show_rides.php", {}, function (data) {
                if (data["status"] == "ok") {
                    $("#rides").html(data["html"]);
                } else if (data["status"] == "ko") {
                    alert(data["message"]);
                }
            }, 'json');
        }
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
            show_rides();
            $("#logout").click(function () {
                logout();
            });
        });
    </script>
</head>

<body>
    <button type="button" class="btn btn-secondary" id="logout">logout</button>

    <div class="rides"></div>
</body>

</html>
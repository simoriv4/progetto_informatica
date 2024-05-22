<?php
if (!isset($_SESSION)) {
    session_start();
}
// echo $_SESSION["is_admin"];
if (isset($_SESSION['is_admin']) && $_SESSION["is_admin"]) {
    header("Location: admin.php");
    exit();
} else if (isset($_SESSION['is_admin']) && !$_SESSION["is_admin"]) {
    header("Location: cliente.php");
    exit();
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
    <!-- Includi il CSS personalizzato -->
    <link rel="stylesheet" type="text/css" href="../style/style_login.css">

    <script>
        function check_login() {
            $.get("../AJAX/login.php", {
                username: $("#username").val(),
                password: $("#password").val()
            }, function (data) {
                // alert(data["message"]);
                if (data["status"] == "ok") {
                    if (data["message"] == "admin")
                        window.location.href = "admin.php";
                    else if (data["message"] == "cliente")
                        window.location.href = "cliente.php";
                    else
                        window.location.href = "index.php";
                } else if (data["status"] == "ko") {
                    alert(data["message"]);
                }
            }, 'json');
        }

        $(document).ready(function () {
            $("#login_button").click(function () {
                check_login();
            });
        });
    </script>
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="login-container text-center">
            <h1 class="mb-4">Login</h1>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control" placeholder="Inserisci il tuo username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Inserisci la tua password">
            </div>
            <button type="button" class="btn btn-primary btn-block" id="login_button">Login</button>
            <p class="register-link mt-3">Non hai un account? <a href="signUp.php">Registrati</a></p>
        </div>

    </div>
</body>

</html>

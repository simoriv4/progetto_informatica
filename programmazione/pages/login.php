<?php
if (!isset($_SESSION))
    session_start();
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
        function check_login() {
            $.get("../AJAX/login.php", {
                username: $("#username").val(),
                password: $("#password").val()
            }, function (data) {
                if (data["status"] == "ok") {
                    console.log("qui");
                    if(data["message"] == "admin")
                        window.location.href = "admin.php";
                    else if(data["message"] == "cliente")
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
    <div class="container">
        <div id="login" class="mt-5">
            <h1 class="mb-4">Login</h1>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control"
                    placeholder="Inserisci il tuo username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control"
                    placeholder="Inserisci la tua password">
            </div>
            <button type="button" class="btn btn-primary" id="login_button">Login</button>
            <p class="register-link mt-3">Non hai un account? <a href="signUp.php">Registrati</a></p>
        </div>
    </div>


</body>

</html>
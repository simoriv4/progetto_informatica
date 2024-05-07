<?php
if (!isset($_SESSION))
    session_start();
?>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    function check_login() {
        $.get("../AJAX/login.php", { username: $("#username").val(), password: $("#password").val() }, function (data) {
            if (data["status"] == "ok") {
                console.log = "qui";
                window.location.href = "homepage.php";
            }
            else if(data["status"] == "ko") {
                alert(data["message"]);
            }
        }, 'json');
    }
    $("document").ready(function () {
        $("#login_button").click(function () {
            check_login();
        });
    });
</script>

<html>

<head>
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div id="login">
            <h1>Login</h1>
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Inserisci il tuo username">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Inserisci la tua password">
            <input type="button" value="Login" id="login_button">
            <p class="register-link">Non hai un account? <a href="signUp.php">Registrati</a></p>
        </div>
    </div>
</body>


</html>
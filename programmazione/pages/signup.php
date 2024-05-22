<?php
if (!isset($_SESSION))
    session_start();

if(isset($_SESSION["is_admin"]) && !($_SESSION["is_admin"]))
{
    echo("l'utente non ha i permessi per effettuare l'operazione");
    header("Location : index.php");
    die;
}
else if(($_SESSION["is_admin"])){
    // utente non loggato
    header("Location: login.php");
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
        $(document).ready(function() {
            $("#registra").click(function() {
                signUp();
            });

            $("#tornaIndietro").click(function() {
                window.location = "index.php";
            });
        });

        function signUp() {
            var nome = $('#nome').val().trim();
            var cognome = $('#cognome').val().trim();
            var email = $('#email').val().trim();
            var password = $('#password').val().trim();
            var numeroTessera = $('#numeroTessera').val().trim();
            var numeroCartaCredito = $('#numeroCartaCredito').val().trim();
            var stato = $('#stato').val().trim();
            var provincia = $('#provincia').val().trim();
            var paese = $('#paese').val().trim();
            var cap = $('#cap').val().trim();
            var via = $('#via').val().trim();

            if (!nome || !cognome || !email || !password || !numeroTessera || !numeroCartaCredito ||
                !stato || !provincia || !paese || !cap || !via) {
                alert("Tutti i campi sono obbligatori.");
                return false;
            }

            if (!/^[a-zA-Z ]+$/.test(nome) || !/^[a-zA-Z ]+$/.test(cognome)) {
                alert("Nome e cognome devono contenere solo lettere e spazi.");
                return false;
            }

            if (!/^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-zA-Z]{2,6}$/.test(email)) {
                alert("L'email inserita non è valida.");
                return false;
            }

            if (password.length < 8) {
                alert("La password deve contenere almeno 8 caratteri.");
                return false;
            }

            if (!/^\d{6}$/.test(numeroTessera)) {
                alert("Il numero di tessera deve essere di 6 cifre.");
                return false;
            }

            if (!/^\d{16}$/.test(numeroCartaCredito)) {
                alert("Il numero della carta di credito deve essere di 16 cifre.");
                return false;
            }

            if (!/^\d{5}$/.test(cap)) {
                alert("Il CAP deve essere di 5 cifre.");
                return false;
            }

            var dati = {
                nome: nome,
                cognome: cognome,
                email: email,
                password: password,
                numeroTessera:numeroTessera,
                numeroCartaCredito: numeroCartaCredito,
                stato: stato,
                provincia: provincia,
                paese: paese,
                cap: cap,
                via: via
            };

            $.get("../signup.php", dati, function(data) {
                if(status === false) {
                alert("Registrazione fallita");
            } else if(status === true) {
                window.location = "index.php";
            }            });

        }

        function printResponse(status) {
            if(status === false) {
                alert("Registrazione fallita");
            } else if(status === true) {
                window.location = "index.php";
            }
        }
    </script>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-center">Registra utente</h2>
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" id="nome">
                            </div>
                            <div class="form-group">
                                <label for="cognome">Cognome</label>
                                <input type="text" class="form-control" id="cognome">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password">
                            </div>
                            <div class="form-group">
                                <label for="numeroTessera">Numero tessera</label>
                                <input type="text" class="form-control" id="numeroTessera">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="numeroCartaCredito">Numero carta di credito</label>
                                <input type="number" class="form-control" id="numeroCartaCredito">
                            </div>
                            <div class="form-group">
                                <label for="stato">Stato</label>
                                <input type="text" class="form-control" id="stato">
                            </div>
                            <div class="form-group">
                                <label for="provincia">Provincia</label>
                                <input type="text" class="form-control" id="provincia">
                            </div>
                            <div class="form-group">
                                <label for="paese">Paese</label>
                                <input type="text" class="form-control" id="paese">
                            </div>
                            <div class="form-group">
                                <label for="cap">CAP</label>
                                <input type="number" class="form-control" id="cap">
                            </div>
                            <div class="form-group">
                                <label for="via">Via</label>
                                <input type="text" class="form-control" id="via">
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" id="registra">Registrati</button>
                    <button type="button" class="btn btn-secondary" id="tornaIndietro">Torna alla login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>


<?php
if (!isset($_SESSION))
    session_start();

if (isset($_SESSION["is_admin"]) && !($_SESSION["is_admin"])) {
    echo ("L'utente non ha i permessi per effettuare l'operazione");
    header("Location: index.php");
    die;
} else if (!isset($_SESSION["is_admin"])) {
    // utente non loggato
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Registrazione</title>
    <!-- Includi Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Includi jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Includi il CSS personalizzato -->
    <link rel="stylesheet" type="text/css" href="../style/style_login.css">
    <!-- Includi Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script src="../js/signup.js"></script>
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
                                <label for="conferma_password">Conferma Password</label>
                                <input type="password" class="form-control" id="conferma_password">
                            </div>
                            <div class="form-group">
                                <label for="numeroCartaCredito">Numero carta di credito</label>
                                <input type="number" class="form-control" id="numeroCartaCredito">
                            </div>
                            <div class="form-group">
                                <label for="is_admin">Admin</label>
                                <input class="form-check-input" type="checkbox" id="is_admin" name="is_admin">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="regione">Regione</label>
                                <input type="text" class="form-control" id="regione">
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
                            <div class="form-group">
                                <label for="n_civico">Numero Civico</label>
                                <input type="number" class="form-control" id="n_civico">
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" id="conferma">Conferma</button>
                    <button type="button" class="btn btn-secondary" id="admin">Admin</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
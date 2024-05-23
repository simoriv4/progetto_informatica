<?php
// faccio gli opportuni controlli se l'utente ha i permessi di accedere alla pagina
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['is_admin']) && !$_SESSION["is_admin"]) {
    header("Location: cliente.php");
    exit();
} else if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <title>Gestione Stazioni</title>
    <!-- Includi Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Includi jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Includi Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- DataTables CSS e JS -->
    <script src="https://cdn.datatables.net/2.0.6/js/dataTables.js"></script>
    <link rel="stylesheet" href="../style/style_table.css">
    <!-- Script personalizzato -->
    <script src="../js/gestione_stazioni.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button type="button" class="btn btn-secondary" id="admin">Admin</button>
    </nav>
    <div id="dataTableContainer" class="container mt-5">
        <table id='myTable' class='display'></table>
    </div>
</body>

</html>

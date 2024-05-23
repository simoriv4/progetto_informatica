<?php
if (!isset($_SESSION))
    session_start();

if (isset($_SESSION["is_admin"]) && ($_SESSION["is_admin"])) {
    header("Location: index.php");
    die;
} else if (!isset($_SESSION["is_admin"])) {
    // utente non loggato
    header("Location: admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Cliente</title>
    <!-- Includi Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <!-- DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../style/style_cliente.css">

</head>

<body>
    <button type="button" class="btn btn-secondary" id="logout">Logout</button>
    <button type="button" class="btn btn-secondary" id="tratte_percorse">Tratte percorse</button>
    <button type="button" class="btn btn-secondary" id="riepiloghi">Riepiloghi</button>
    <button type="button" class="btn btn-secondary" id="profilo">Profilo</button>

    <div id="dataTableContainer" class="container mt-5">
        <table id='myTable' class='display'></table>
    </div>
    <div id="profilo_content"></div>
    <div id="riepilogo"></div>

    <!-- Includi jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/cliente.js"></script>
</body>

</html>

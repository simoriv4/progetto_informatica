<?php
if (!isset($_SESSION))
    session_start();

if (isset($_SESSION["is_admin"]) && !($_SESSION["is_admin"])) {
    echo("L'utente non ha i permessi per effettuare l'operazione");
    header("Location: index.php");
    exit();
} else if (!isset($_SESSION["is_admin"])) {
    // utente non loggato
    header("Location: login.php");
    exit();
}
include_once("../classes/user.php");
$user = new user();

// creo un array per contenere i risultati
$response = array();

$nome = $_GET["nome"];
$cognome = $_GET["cognome"];
$email = $_GET["email"];
$password = $_GET["password"];
$conferma_password = $_GET["conferma_password"];
$numeroTessera = $_GET["numeroTessera"];
$numeroCartaCredito = $_GET["numeroCartaCredito"];
$stato = $_GET["stato"];
$provincia = $_GET["provincia"];
$paese = $_GET["paese"];
$cap = $_GET["cap"];
$via = $_GET["via"];
$is_admin = isset($_GET["is_admin"]) ? $_GET["is_admin"] : false;

// eseguo la funzione per la registrazione
$result = $user->signUp($nome, $cognome, $email, $password, $conferma_password, $numeroTessera, $numeroCartaCredito, $stato, $provincia, $paese, $cap, $via, $is_admin);

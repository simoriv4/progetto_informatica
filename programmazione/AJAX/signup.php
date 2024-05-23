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
$numeroCartaCredito = $_GET["numeroCartaCredito"];
$regione = $_GET["regione"];
$provincia = $_GET["provincia"];
$paese = $_GET["paese"];
$cap = $_GET["cap"];
$via = $_GET["via"];
$n_civico = $_GET["n_civico"];
$is_admin = $_GET['is_admin'];

$result = $user->signUp($nome, $cognome, $email, $password, $conferma_password, $numeroCartaCredito, $regione, $provincia, $paese, $cap, $via, $n_civico, $is_admin);

if($result){
    $response["status"] = "ok";
    $response["message"] = "utente registrato correttamente";
}
else if(!$result){
    $response["status"] = "ko";
    $response["message"] = "errore durante la registrazione";
}
else{
    $response["status"] = "ko";
    $response["message"] = $result;
}

echo json_encode($response);

?>
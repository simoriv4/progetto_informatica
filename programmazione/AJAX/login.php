<?php
if (!isset($_SESSION))
    session_start();
include_once("../classes/user.php");
$user = new user();

// creo un array per contenere i risultati
$response = array();
// controllo  se l'utente è loggato
if (isset($_SESSION["username"])) {
    $response["status"] = "ok";
    $response["message"] = "login già effettuato";
} else {
    // controlllo che le credenziali siano state inserite
    if(isset($_GET["username"]) && isset($_GET["password"]))
    {
        $username = $_GET["username"];
        $password = $_GET["password"];
        $result = $user->check_credential($username, $password);
        if ($result) {
            $_SESSION["username"] = $username;
            // utente presente nel db
            $response["status"] = "ok";
            $response["message"] = "login effettuato";
        } else {
            // errore nella ricerca dell'utente dal db
            $response["status"] = "ko";
            $response["message"] = "login non effettuato";
        }
    }
    else{
        // le credenziali non sono state inserite
        $response["status"] = "ko";
        $response["message"] = "credenziali non inserite";
    }
    
}
echo json_encode($response);
?>
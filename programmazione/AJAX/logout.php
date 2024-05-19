<?php
if(!isset($_SESSION)){
    session_start();
}

session_unset();
session_destroy();
$response["status"] = "ok";
$response["message"] = "logout effettuata correttamente";
// ritorno il json con il messaggio da stampare
echo json_encode($response);
?>
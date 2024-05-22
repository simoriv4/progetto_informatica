<?php
if (!isset($_SESSION))
    session_start();

if(isset($_SESSION["is_admin"]) && !($_SESSION["is_admin"]))
{
    echo("l'utente non ha i permessi per effettuare l'operazione");
    header("Location : index.php");
    die;
}
else if(!isset($_SESSION["is_admin"])){
    // utente non loggato
    header("Location: login.php");
}
?>

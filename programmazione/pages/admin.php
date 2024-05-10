<?php
// faccio gli opportuni controlli se l'utente ha i permessi di accedere alla pagina
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['is_admin']) && !$_SESSION["is_admin"]) {
    header("Location: cliente.php");
} else if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}
?>
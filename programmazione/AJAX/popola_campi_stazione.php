<?php
// Inizializzazione della sessione
if (!isset($_SESSION)) {
    session_start();
}

// Verifica dei permessi dell'utente
if (isset($_SESSION["is_admin"]) && !($_SESSION["is_admin"])) {
    echo json_encode(array("status" => "ko", "message" => "L'utente non ha i permessi per effettuare l'operazione"));
    header("Location: index.php");
    exit();
} else if (!isset($_SESSION["is_admin"])) {
    // utente non loggato
    header("Location: login.php");
    exit();
}

// Dati per la connessione al database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "noleggio_bici";

// Creo la connessione con il database
$conn = new mysqli($servername, $username, $password, $dbname);
$response = array();
// Controllo della connessione
if ($conn->connect_error) {
    $response["status"] = "ko";
    $response["message"] = "Connection failed: " . $conn->connect_error;
    echo json_encode($response);
    exit();
}
 if(isset($_GET["id"])){
    $id = $_GET["id"];
    $select = "SELECT nome, numero_slot
    FROM stazione
    WHERE ID='$id'";
    // eseguo la query
    $result = $conn->query($select);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // salvo il nome e il numero slot
        $response["status"] = "ok";

        $response["nome"] = $row["nome"];
        $response["n_slot"] = $row["numero_slot"];
    }
    else{
        $response["status"] = "ko";
        $response["message"] = "Stazione non trovata";
    }
 }
 else{
    $response["status"] = "ko";
    $response["message"] = "Errore nell'invio dei dati";
 }

echo json_encode($response);

?>
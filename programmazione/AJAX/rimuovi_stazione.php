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

// Controllo della connessione
if ($conn->connect_error) {
    $response["status"] = "ko";
    $response["message"] = "Connection failed: " . $conn->connect_error;
    echo json_encode($response);
    exit();
}

// Verifico se l'ID è stato passato come parametro
if (isset($_POST['id_stazione'])) {
    $id_stazione = $_POST['id_stazione'];

    // Preparo la query per eliminare la stazione
    $stmt = $conn->prepare("DELETE FROM stazione WHERE ID = ?");
    $stmt->bind_param("i", $id_stazione);

    // Eseguo la query
    if ($stmt->execute()) {
        $response["status"] = "ok";
        $response["message"] = "Stazione rimossa correttamente";
    } else {
        $response["status"] = "ko";
        $response["message"] = "Errore nell'esecuzione della query";
    }

    // Chiudo lo statement
    $stmt->close();
} else {
    $response["status"] = "ko";
    $response["message"] = "ID stazione non fornito";
}

// Chiudo la connessione
$conn->close();

// Invio la risposta JSON
echo json_encode($response);
?>

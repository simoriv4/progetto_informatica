<?php
if (!isset($_SESSION))
    session_start();

if (isset($_SESSION["is_admin"]) && !($_SESSION["is_admin"])) {
    header("Location: index.php");
    exit();
} else if (!isset($_SESSION["is_admin"])) {
    // utente non loggato
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "noleggio_bici";

// Creo la connessione con il db
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    if(isset($_GET["id_stazione"]) && isset($_GET["nome_stazione"]) && isset($_GET["numero_slot"])){
        $id_stazione = $_GET["id_stazione"];
        $nome_stazione = $_GET["nome_stazione"];
        $numero_slot = $_GET["numero_slot"];

        // query per update
        $sql = "UPDATE stazioni SET nome = ?, numero_slot = ? WHERE ID = ?";
        $stmt->bind_param("sii", $nome_stazione, $numero_slot, $id_stazione);

        if ($stmt->execute()) {
            $response["status"] = "ok";
            $response["message"] = "Stazione aggiornata correttamente";
        }
        else{
            $response["status"] = "ko";
            $response["message"] = "Errore nell'aggiornamento della stazione";
        }
    }

    // Chiudo la connessione
    $conn->close();
}
// Invio la risposta JSON
echo json_encode($response);
?>
<!-- 

// Verifico se l'ID è stato passato come parametro
    if (isset($_GET['id_stazione'])) {
        $id_stazione = $_GET['id_stazione'];

        // Parametri da ricevere dalla richiesta POST
        $nome = $_GET['nome'];
        $numero_slot = $_GET['n_slot'];

        // Preparo la query per aggiornare la stazione
        $UPDATE = "UPDATE stazione SET nome = ?, numero_slot = ? WHERE ID = ?";
        $stmt = $conn->prepare($UPDATE);
        $stmt->bind_param("sii", $nome, $numero_slot, $id_stazione);
        // Eseguo la query
        if ($stmt->execute()) {
            $response["status"] = "ok";
            $response["message"] = "Stazione aggiornata correttamente";
        } else {
            $response["status"] = "ko";
            $response["message"] = $stmt->error;
        }

        // Chiudo lo statement
        $stmt->close();
    } else {
        $response["status"] = "ko";
        $response["message"] = "ID stazione non fornito";
    } -->
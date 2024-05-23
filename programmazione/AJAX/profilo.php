<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION["is_admin"])) {
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
$response = array();
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // prendo le info dell'utente tramite select
    $sql = "SELECT * FROM user WHERE username ='" . $_SESSION["username"] . "'";
    $result = $conn->query($sql);
    $html = "";
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $response["status"] = "ok";
        // prendo l'indirizzo
        $sql2 = "SELECT * FROM indirizzo WHERE ID ='" . $row["ID_indirizzo"] . "'";
        $result2 = $conn->query($sql2);
        if ($result2->num_rows == 1) {
            $row2 = $result2->fetch_assoc();
            $html .= '<div class="container mt-5">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center">Profilo Utente</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Username:</strong> ' . $row["username"] . '</p>
                            <p><strong>Nome:</strong> ' . $row["nome"] . '</p>
                            <p><strong>Cognome:</strong> ' . $row["cognome"] . '</p>
                            <p><strong>Smart Card:</strong> ' . $row["smart_card"] . '</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Indirizzo:</strong></p>
                            <p>- Via: ' . $row2["via"] . '</p>
                            <p>- Numero Civico: ' . $row2["n_civico"] . '</p>
                            <p>- Paese: ' . $row2["paese"] . '</p>
                            <p>- Provincia: ' . $row2["provincia"] . '</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
            $response["html"] = $html;
        } else {
            $response["status"] = "ko";
            $response["message"] = "errore nella query";
        }
    } else {
        $response["status"] = "ko";
        $response["message"] = "Errore nella query";
    }
}
echo json_encode($response);
?>

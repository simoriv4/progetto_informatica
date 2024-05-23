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
    $sql = "SELECT * FROM operazione WHERE ID_user ='" . $_SESSION["ID_user"] . "' AND tipo = 'consegna'";
    $result = $conn->query($sql);
    $html = "";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $html .= "<thead><tr>
            <th>Data-Ora</th>
            <th>Tariffa</th>
        </tr></thead><tbody>";
    
        foreach ($data as $row) {
            $html .= "<tr>";
            $html .= "<td>" . $row['data_ora'] . "</td>";
            $html .= "<td>" . $row['tariffa'] . " €</td>";
            $html .= "</tr>";
        }
        $html .= "</tbody>";
        $response["status"] = "ok";
        $response["message"] = $html;

    } else {
        $response["status"] = "ko";
        $response["message"] = "Errore nella query";
    }
}
echo json_encode($response);
?>
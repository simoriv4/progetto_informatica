<?php
if (!isset($_SESSION))
    session_start();

if (isset($_SESSION["is_admin"]) && !($_SESSION["is_admin"])) {
    echo json_encode(array("status" => "ko", "message" => "L'utente non ha i permessi per effettuare l'operazione"));
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
}

// Query select
$query = "SELECT s.ID as id_stazione, s.nome as nome_stazione, s.numero_slot as numero_slot, i.via as via, i.paese as paese, i.n_civico as n_civico
FROM stazione as s
JOIN indirizzo as i on s.ID_indirizzo = i.ID";

$result = $conn->query($query);
$response = array();
$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $html = "<thead><tr>
        <th>ID Stazione</th>
        <th>Nome</th>
        <th>Numero Slot</th>
        <th>Indirizzo</th>
        <th></th>
        <th></th>
    </tr></thead><tbody>";

    foreach ($data as $row) {
        $html .= "<tr>";
        $html .= "<td>" . $row['id_stazione'] . "</td>";
        $html .= "<td>" . $row['nome_stazione'] . "</td>";
        $html .= "<td>" . $row['numero_slot'] . "</td>";
        $html .= "<td>" . $row['via'] . " " . $row['n_civico'] . ", " . $row['paese'] . "</td>";
        $html .= "<td><button class='remove' id='" . $row['id_stazione'] . "'>Rimuovi</button></td>";
        $html .= "<td><button class='modifica'>Modifica</button></td>";
        $html .= "</tr>";
    }
    $html .= "</tbody>";
    $response["status"] = "ok";
    $response["message"] = $html;
} else {
    $response["status"] = "ko";
    $response["message"] = "Nessuna stazione trovata";
}

echo json_encode($response);
?>

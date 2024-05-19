<?php
header('Content-Type: application/json');
if (!isset($_SESSION))
    session_start();
// creo connessione con il db
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "noleggio_bici";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);
// verifico la connessione
if ($conn->connect_error)
    die("Connection failed: " . $conn->connect_error);

// query per ottenere le stazioni
$query = 'SELECT s.ID, s.ID_indirizzo, i.lat, i.lon, i.via, i.n_civico 
            FROM stazione s 
            JOIN indirizzo i ON s.ID_indirizzo = i.ID';
$stmt = $conn->query($query);

$stazioni = [];
while ($row = $stmt->fetch_assoc()) {
    $stazioni[] = [
        'id' => $row['ID'],
        'lat' => $row['lat'],
        'lng' => $row['lon'], 
        'name' => $row['via'] . ' ' . $row['n_civico']
    ];
}

echo json_encode(['status' => 'ok', 'stations' => $stazioni]);

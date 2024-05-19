<?php
include_once ("../classes/station");
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "noleggio_bici";
// controllo se esiste un account con quello username
$mysqli = new mysqli($servername, $username_db, $password_db, $dbname);
// query select
$query = "SELECT s.ID as ID, i.lat as lat, i.lon as lon FROM stazione JOIN indirizzo as i ON i.ID = s.ID_indirizzo";
$result = $mysqli->query($query);
$stazioni = array();
$response = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $stazione = new station("stazione " . $row["ID"] . "", $row["lat"], $row["lon"]);
        $stazioni[] = $row;
    }
    $response["status"] = "ok";
    $response["stations"] = $stazioni;
}

$mysqli->close();
echo $response;
?>
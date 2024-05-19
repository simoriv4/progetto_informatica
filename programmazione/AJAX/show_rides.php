<?php
if (!isset($_SESSION))
    session_start();
if (!isset($_SESSION["ID"])) {
    $response["status"] = "ko";
} else {
    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $dbname = "noleggio_bici";
    // controllo se esiste un account con quello username
    $mysqli = new mysqli($servername, $username_db, $password_db, $dbname);
    // query select
    $id = $_SESSION['ID'];
    $query = "SELECT * FROM cliente as c JOIN user as u ON u.ID = c.ID_user WHERE u.ID ='$id'";
    $result = $mysqli->query($query);
    $response = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $stazioni[] = $row;
        }
    }

    $mysqli->close();
}
echo $response;
?>
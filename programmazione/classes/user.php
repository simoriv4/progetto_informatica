<?php
if (!isset($_SESSION))
    session_start();
class user
{

    public $id;
    public $username;
    public $password;
    public $servername = "localhost";
    public $username_db = "root";
    public $password_db = "";
    public $dbname = "noleggio_bici";

    public function __construct()
    {
        $this->id = 0;
        $this->username = "user";
        $this->password = "1234";

    }


    public function check_credential($user, $password)
    {
        // controllo se esiste un account con quello username
        $mysqli = new mysqli($this->servername, $this->username_db, $this->password_db, $this->dbname);
        // query select
        $query = "SELECT * FROM `user` WHERE  username='$user' AND password=MD5('$password')";

        $result = $mysqli->query($query);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            //controllo se è admin o meno
            $_SESSION["ID_user"] = $row["ID"];
            //query
            $id = $row["ID"];
            $query = "SELECT * FROM `admin` WHERE ID_user='$id'";
            $result = $mysqli->query($query);

            // imposto se l'utente è admin o no
            if ($result->num_rows > 0) {
                $_SESSION["is_admin"] = true;
            } else {
                $_SESSION["is_admin"] = false;
            }

            $mysqli->close();
            return true; // utente trovato
        }
        $mysqli->close();
        return false; // utente non esistente
    }

    public function check_credential_sign_up($user)
    {
        // controllo se esiste un account con quello username
        $mysqli = new mysqli($this->servername, $this->username_db, $this->password_db, $this->dbname);
        // query select
        $query = "SELECT * FROM `user` WHERE  username='$user'";
        $result = $mysqli->query($query);
        if ($result->num_rows == 0) {
            $mysqli->close();
            return true; // utente non presente nel db
        }
        $mysqli->close();
        return false; // utente già esistente
    }
    public function signUp($nome, $cognome, $email, $password, $conferma_password, $numeroCartaCredito, $regione, $provincia, $paese, $cap, $via, $n_civico, $is_admin)
    {
        // controllo che sia disponibile l'utente
        $is_free = $this->check_credential_sign_up($email);
        if (!$is_free) {
            return false;
        }

        if ($password !== $conferma_password) {
            return false;
        }

        $hashed_password = md5($password);
        $conn = new mysqli($this->servername, $this->username_db, $this->password_db, $this->dbname);
        $conn->autocommit(false);

        try {

            $address = "$n_civico $via, $paese";
            // ottengo lat e lon
            $coordinates = $this->getCoordinates($address);
            $lat = $coordinates["lat"];
            $lon = $coordinates["lng"];
            // prendo id dell'inidrizzo
            $id_indirizzo = $this->get_id_indirizzo($regione, $paese, $provincia, $cap, $via, $n_civico, $lat, $lon);
            // genero una nuova smart card per l'utente
            $smart_card = $this->smart_card();
            // inserisco l'utente
            $query = "INSERT INTO `user` (username, password,nome, cognome, smart_card, ID_indirizzo) VALUES ('$email', '$hashed_password','$nome','$cognome', '$smart_card', $id_indirizzo)";
            if (!$conn->query($query)) {
                throw new Exception("Errore durante l'inserimento dell'utente nella tabella 'user'");
            }

            $user_id = $conn->insert_id;

            if ($is_admin) {
                $query = "INSERT INTO `admin` (ID_user) VALUES ($user_id)";
                if (!$conn->query($query)) {
                    throw new Exception("Errore durante l'inserimento dell'utente nella tabella 'admin'");
                }
            } else {
                $query = "INSERT INTO `cliente` (ID_user, numero_carta, smart_card) VALUES ($user_id, $numeroCartaCredito, '$smart_card')";
                if (!$conn->query($query)) {
                    throw new Exception("Errore durante l'inserimento dell'utente nella tabella 'cliente'");
                }
            }

            $conn->commit();
            $conn->autocommit(true);
            $conn->close();
            return true;
        } catch (Exception $e) {
            $conn->rollback();
            $conn->autocommit(true);
            $conn->close();
            return false;
        }
    }


    public function smart_card()
    {
        // Connessione al database
        $conn = new mysqli($this->servername, $this->username_db, $this->password_db, $this->dbname);

        while (true) {
            // Genera una sequenza casuale di 6 cifre
            $smart_card = str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);

            // Controlla se la smart card generata è univoca
            $query = "SELECT * FROM `user` WHERE smart_card = '$smart_card'";
            $result = $conn->query($query);

            // Se non ci sono utenti con la stessa smart card, restituisci quella generata
            if ($result->num_rows == 0) {
                $conn->close();
                return $smart_card;
            }
        }

        // Chiudi la connessione solo quando il ciclo è terminato (che in questo caso non si verificherà mai)
        $conn->close();
    }

    public function get_id_indirizzo($regione, $paese, $provincia, $cap, $via, $n_civico, $lat, $lon)
    {
        $conn = new mysqli($this->servername, $this->username_db, $this->password_db, $this->dbname);

        $query = "SELECT ID FROM `indirizzo` WHERE regione='$regione' AND paese='$paese' AND provincia='$provincia' AND CAP='$cap' AND via='$via' AND n_civico='$n_civico' AND lat='$lat' AND lon='$lon'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id_indirizzo = $row['ID'];
        } else {
            $query_insert = "INSERT INTO `indirizzo` (regione, paese, provincia, CAP, via, n_civico, lat, lon) VALUES ('$regione', '$paese', '$provincia', '$cap', '$via', '$n_civico', '$lat', '$lon')";
            if ($conn->query($query_insert)) {
                $id_indirizzo = $conn->insert_id;
            } else {
                $id_indirizzo = null;
            }
        }

        $conn->close();
        return $id_indirizzo;
    }
    // funzione per ottenere da via paese e n civico --> lat e lng
    public function getCoordinates($address)
    {
        $apiKey = 'AIzaSyAr14sRK-gZQduBqjL4a6ioX0laYlu590A';
        $address = urlencode($address);
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key={$apiKey}";

        $response = file_get_contents($url);
        $json = json_decode($response, true);

        if (isset($json['results'][0])) {
            $lat = $json['results'][0]['geometry']['location']['lat'];
            $lng = $json['results'][0]['geometry']['location']['lng'];
            return array('lat' => $lat, 'lng' => $lng);
        } else {
            return null;
        }
    }




}
?>
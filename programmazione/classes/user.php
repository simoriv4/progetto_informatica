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
            //query
            $id = $row["ID"];
            $query = "SELECT * FROM `admin` WHERE ID_user='$id'";
            $result = $mysqli->query($query);

            // imposto se l'utente è admin o no
            if ($result->num_rows > 0) {
                $_SESSION["is_admin"] = true;
            }
            else{
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
    public function signUp($nome, $cognome, $email, $password, $conferma_password, $numeroTessera, $numeroCartaCredito, $stato, $provincia, $paese, $cap, $via, $is_admin)
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    
        // Controlla se l'utente esiste già
        if ($this->check_credential_sign_up($email)) {
            return false; // Utente già registrato
        }
    
        // Verifica se la password e la conferma della password corrispondono
        if ($password !== $conferma_password) {
            return false; // Le password non corrispondono
        }
    
        // Cripta la password
        $hashed_password = md5($password);
    
        // Connessione al database
        $conn = new mysqli($this->servername, $this->username_db, $this->password_db, $this->dbname);
        $conn->autocommit(false); // Abilita le transazioni
    
        try {
            // prendo l'id dell'indirizzo
            $id_indirizzo= $this->get_id_indirizzo($stato, $paese, $provincia, $cap, $via);
            // Inserisci l'utente nella tabella `user`
            $query = "INSERT INTO `user` (username, password, smart_cart, ID_indirizzo) VALUES ('$email', '$hashed_password', 'smart_cart_value', $id_indirizzo)";
            if (!$conn->query($query)) {
                throw new Exception("Errore durante l'inserimento dell'utente nella tabella 'user'");
            }
    
            // Ottieni l'ID dell'utente appena inserito
            $user_id = $conn->insert_id;
    
            // Se l'utente è un amministratore, aggiungi anche un record nella tabella `admin`
            if ($is_admin) {
                $query = "INSERT INTO `admin` (ID_user) VALUES ($user_id)";
                if (!$conn->query($query)) {
                    throw new Exception("Errore durante l'inserimento dell'utente nella tabella 'admin'");
                }
            } else {
                // Se l'utente non è un amministratore, aggiungi un record nella tabella `cliente`
                $query = "INSERT INTO `cliente` (ID_user, numero_carta, smart_card) VALUES ($user_id, $numeroCartaCredito, 'smart_card_value')";
                if (!$conn->query($query)) {
                    throw new Exception("Errore durante l'inserimento dell'utente nella tabella 'cliente'");
                }
            }
    
            // Esegui il commit delle transazioni
            $conn->commit();
            $conn->autocommit(true); // Ripristina l'autocommit
            $conn->close();
            return true; // Registrazione avvenuta con successo
        } catch (Exception $e) {
            // Rollback in caso di eccezione
            $conn->rollback();
            $conn->autocommit(true); // Ripristina l'autocommit
            $conn->close();
            return false; // Errore durante la registrazione
        }
    }
    

   
    public function get_id_indirizzo($stato, $paese, $provincia, $cap, $via)
    {
        // Connessione al database
        $conn = new mysqli($this->servername, $this->username_db, $this->password_db, $this->dbname);
        
        // Controllo se l'indirizzo esiste già nel database
        $query = "SELECT ID FROM `indirizzo` WHERE stato='$stato' AND paese='$paese' AND provincia='$provincia' AND CAP='$cap' AND via='$via'";
        $result = $conn->query($query);
        
        if ($result->num_rows > 0) {
            // L'indirizzo esiste già, ritorno l'ID dell'indirizzo
            $row = $result->fetch_assoc();
            $id_indirizzo = $row['ID'];
        } else {
            // L'indirizzo non esiste, lo creo
            $query = "INSERT INTO `indirizzo` (stato, paese, provincia, CAP, via) VALUES ('$stato', '$paese', '$provincia', '$cap', '$via')";
            if ($conn->query($query)) {
                // Recupero l'ID dell'indirizzo appena creato
                $id_indirizzo = $conn->insert_id;
            } else {
                // Errore durante l'inserimento dell'indirizzo
                $id_indirizzo = null;
            }
        }
        
        // Chiudo la connessione al database
        $conn->close();
    
        // Ritorno l'ID dell'indirizzo
        return $id_indirizzo;
    }
    

}
?>
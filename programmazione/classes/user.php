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

    public function signUp($user, $password, $mail, $smart_card, $ID_indirizzo)
    {
        // mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        // //  controllo che l'untente non esista
        // if (!$this->check_credential($user, $password)) {
        //     $conn = new mysqli($this->servername, $this->username_db, $this->password_db, $this->dbname);

        //     mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        //     try {

        //         // Inizio la transazione
        //         $conn->begin_transaction();
        //         // faccio l'md5 sulla password
        //         $hashed_password = md5($password);

        //         $is_studente = $this->is_studente($user);
        //         if ($is_studente) {
        //             // Preparazione dell'inserimento
        //             $insert = $conn->prepare("INSERT INTO `studenti` (username, password, email, ID_classe) VALUES (?, ?, ?, ?)");
        //             // prendo l'id della classe
        //             $id_class = $this->get_id_class($classes[0]);
        //             // Verifica se l'ID della classe è valido
        //             if ($id_class !== null) {
        //                 // Associazione dei parametri non ancora settati
        //                 $insert->bind_param("sssi", $user, $hashed_password, $mail, $id_class);
        //             }
        //             // Esecuzione della query
        //             if (!$insert->execute())
        //                 return false;
        //         } else {
        //             // Preparazione dell'inserimento professore
        //             $insert = $conn->prepare("INSERT INTO `professori` (username, password, email) VALUES (?, ?, ?)");
        //             // Associazione dei parametri non ancora settati
        //             $insert->bind_param("sss", $user, $hashed_password, $mail);

        //             // Esecuzione della query di inserimento professore indipendentemente dallo studente
        //             if (!$insert->execute()) {
        //                 throw new Exception("Errore durante l'inserimento del professore");
        //             }

        //             $classes_array = $this->get_id_class($classes);
        //             // creo tuple insegna  per ogni classe in cui insegna un prof
        //             if (!$this->assegna_classi($user, $conn, $classes_array)) {
        //                 throw new Exception("Errore durante l'assegnazione delle classi al professore");
        //             }
        //         }

        //         // Committo la transazione se tutte le operazioni sono avvenute con successo
        //         $conn->commit();
        //         $insert->close();
        //         $conn->close();
        //         return true;
        //     } catch (Exception $e) {
        //         // Rollback in caso di eccezione
        //         $conn->rollback();
        //         $insert->close();
        //         $conn->close();
        //         return false;
        //     }
        // }   
    }

   
    public function get_id_class($classes)
    {
        // controllo se esiste un account con quello username
        $mysqli = new mysqli($this->servername, $this->username_db, $this->password_db, $this->dbname);
        $classes_array = array();
        foreach ($classes as $class) {
            $query = "SELECT ID FROM `classe` WHERE  classe='$class'";

            $result = $mysqli->query($query);
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $classes_array[] = $row['ID'];
            } else {
                return null;
            }
        }
        $mysqli->close();
        return $classes_array;
    }

}
?>
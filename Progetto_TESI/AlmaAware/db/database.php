<?php 
class DatabaseHelper{
    private $db;
    
    // Creazione per la connessione al database
    public function __construct($servername, $username, $password, $dbname, $port){
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }        
    }

    // Funzioni sul DB

    // funzione che controlla il login degli utenti
    public function checkLogin($email, $password){
        $query = "SELECT * FROM user WHERE email = ? AND password = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss',$email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    } 

    // funzione che controlla se un utente è già registrato
    public function checkRegistration($email){
        $query = "SELECT * FROM user WHERE email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s',$username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    } 

    // funzione che inserisce i dati dell'utente alla registrazione
    public function registration($idUser, $email, $name, $campus, $password, $img_profile, $idMyFlower){
        $query = "INSERT INTO user(idUser, email, name, campus, password, img_profile, idMyFlower) values(?,?,?,?,?,?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('isssssi',$idUser, $email, $name, $campus, $password, $img_profile, $idMyFlower);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    } 

    // funzione che recupera l'ultimo idUser assegnato
    public function getLastIdUser(){
        $query = "SELECT MAX(`idUser`) as `idUser` FROM `user` ORDER BY `idUser`;"; 
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // funzione che recupera l'ultimo idMyFlower assegnato
    public function getLastIdMyFlower(){
        $query = "SELECT MAX(`idMyFlower`) as `idMyFlower` FROM `myflower` ORDER BY `idMyFlower`;"; 
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Funzioni di Update del profilo Utente

    public function getIdUser($email){
        $query = "SELECT `idUser` FROM `user` WHERE `email`=?"; 
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s',$email);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    // Update della password
    public function updatePass($password,$idUser) {
        $query = "UPDATE user SET password= ? WHERE idUser = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si',$password,$idUser);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }

    // Update del nome
    public function updateName($name,$idUser) {
        $query = "UPDATE user SET name= ? WHERE idUser = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si',$name,$idUser);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }

    // Update della email
    public function updateEmail($email,$idUser) {
        $query = "UPDATE user SET email= ? WHERE idUser = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si',$email,$idUser);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }

    // Update del campus
    public function updateCampus($campus,$idUser) {
        $query = "UPDATE user SET campus= ? WHERE idUser = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si',$campus,$idUser);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }

    // Update della foto
    public function updateIMG($img_profile,$idUser) {
        $query = "UPDATE user SET img_profile= ? WHERE idUser = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si',$img_profile,$idUser);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }


    // Funzione che prende tutti i parametri dei Sdg dal DB
    public function getAllSdg(){
        $query = "SELECT * FROM goalsdg ";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    } 

    // Funzione che prende tutti i parametri del Sdg SPECIFICO
    public function getSdg($idgoalsdg){
        $query = "SELECT * FROM goalsdg WHERE idgoalsdg=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$idgoalsdg);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    } 

    // Funzione che prende tutte le azioni utente del Sdg SPECIFICO
    public function getActionsSdg($idgoalsdg){
        $query = "SELECT * FROM useraction WHERE sdgId=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$idgoalsdg);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    } 

    // Funzione che prende i badge SDG
    public function getAllBadgeSdg(){
        $query = "SELECT * FROM badge_sdg";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    } 

    // Funzione che prende il badge richiesto
    public function getBadgeSdg($badgeName){
        $query = "SELECT * FROM badge_sdg WHERE badgeName=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s',$badgeName);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    } 

    // Funzione che prende i badge SDG di un utente
    public function getAllBadgeSdgOfUser($idUser){
        $query = "SELECT * FROM badgesusers WHERE idUser=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$idUser);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    } 

    // Funzione che prende i badge SDG di un utente con filtro valid/not valid
    public function getAllBadgeValidNot($isvalid, $userSessionID){
        $query = "SELECT * FROM badgesusers WHERE validated=? AND idUser=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$isvalid, $userSessionID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Funzione che prende i badge di un utente con filtro un determinato SDG
    public function getAllBadgeOneSdg($i, $userSessionID){
        $query = "SELECT * FROM badgesusers WHERE idSdg=? AND idUser=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$i, $userSessionID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
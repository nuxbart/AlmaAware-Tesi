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

    // Funzione che prende i badges di un Sdg
    public function getSdgBadges($idgoalsdg){
        $query = "SELECT * FROM badge_sdg WHERE idSdg=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$idgoalsdg);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    } 

    // funzione che inserisce un badge di un nuovo utente
    public function insertNewBadge($idbadge, $validated, $nameBadge, $idUser, $idSdg, $image){
        $query = "INSERT INTO badgesusers(idbadge, validated, nameBadge, idUser, idSdg, image) values(?,?,?,?,?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iisiis', $idbadge, $validated, $nameBadge, $idUser, $idSdg, $image);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    } 

    // funzione che recupera l'ultimo idBadge assegnato
    public function getLastIdBadge(){
        $query = "SELECT MAX(`idbadge`) as `idbadge` FROM `badgesusers` ORDER BY `idbadge`;"; 
        $stmt = $this->db->prepare($query);
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

    // Funzione che dato il nome di un badge e l'idUser ne seleziona il badge corrispondente
    public function getBadgeSDGUser($idUser, $nameBadge){
        $query = "SELECT * FROM badgesusers WHERE idUser=? AND nameBadge=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('is',$idUser, $nameBadge);
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

    // Funzione che aggiorna il conteggio counter di un sdg di un utente
    function updateBadgeCounter($type, $idbadge){
        $query = "UPDATE badgesusers SET type= ? WHERE idbadge = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$type, $idbadge);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }

    // MY FLOWER

    // funzione che inserisce un nuovo fiore
    public function insertNewFlower($idMyFlower, $nameFlower, $colorPot, $showInGreenhouse, $typeFlower1, $typeFlower2, $typeFlower3){
        $query = "INSERT INTO myflower(idMyFlower, nameFlower, colorPot, showInGreenhouse, typeFlower1, typeFlower2, typeFlower3) values(?,?,?,?,?,?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('isssiii', $idMyFlower, $nameFlower, $colorPot, $showInGreenhouse, $typeFlower1, $typeFlower2, $typeFlower3);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    } 

    // Funzione che prende l'idMyFlower dell utente in questione
    public function getIDFlower($emailUser){
        $query = "SELECT idMyFlower FROM user WHERE email=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s',$emailUser);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    } 

    // Funzione che dato un idMyFlower restituisce le sue caratteristiche
    public function getUserFlower($idMyFlower){
        $query = "SELECT * FROM myflower WHERE idMyFlower=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$idMyFlower);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    } 

    // Update TABLE MyFlower Update
    public function updateFlowerColorPot($colorPot, $idMyFlower) {
        $query = "UPDATE myflower SET colorPot= ? WHERE idMyFlower = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si',$colorPot, $idMyFlower);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }

    public function updateFlowerName($nameFlower, $idMyFlower) {
        $query = "UPDATE myflower SET nameFlower= ? WHERE idMyFlower = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $nameFlower, $idMyFlower);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }

    public function joinGreenhouse($yes, $idMyFlower) {
        $query = "UPDATE myflower SET showInGreenhouse= ? WHERE idMyFlower = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $yes, $idMyFlower);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }

    public function updateFlowerType1($boolType, $idMyFlower) {
        $query = "UPDATE myflower SET typeFlower1= ? WHERE idMyFlower = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$boolType, $idMyFlower);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }

    public function updateFlowerType2($boolType, $idMyFlower) {
        $query = "UPDATE myflower SET typeFlower2= ? WHERE idMyFlower = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$boolType, $idMyFlower);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }

    public function updateFlowerType3($boolType, $idMyFlower) {
        $query = "UPDATE myflower SET typeFlower3= ? WHERE idMyFlower = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$boolType, $idMyFlower);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }

    //Funzione che prende tutti gli elementi della Table MyFlower
    public function getAllFlowers(){
        $query = "SELECT * FROM myflower ";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    } 

    //Funzione prende i fiori della serra (che hanno consenso di essere mostrati)
    public function getAllFlowersGreenHouse($yes){
        $query = "SELECT * FROM myflower WHERE showInGreenhouse = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $yes);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    } 

    // Funzione che prende l'idMyFlower da idUser
    public function getIdFlowerFromIdUser($idUser){
        $query = "SELECT idMyFlower FROM user WHERE idUser=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$idUser);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    } 

    // PODIO
    public function getPodium(){
        $query = "SELECT u.idUser, COUNT(bu.idbadge) AS badgeCount 
        FROM user u 
        JOIN myflower mf ON u.idMyFlower = mf.idMyFlower 
        JOIN badgesusers bu ON u.idUser = bu.idUser 
        WHERE mf.showInGreenhouse = 'Y' 
        AND bu.validated = 1 
        GROUP BY u.idUser ORDER BY badgeCount DESC LIMIT 3";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // PODIO, Funzione che prende idUser con numero di badges completati più alto (1°)
   /* public function getFirstPodiumFlowerIdUser(){
        $query = "SELECT idUser FROM badgesUsers WHERE validated = 1 GROUP BY idUser ORDER BY COUNT(*) DESC LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }*/

    // PODIO, Funzione che prende idUser con numero di badges completati secondo più alto (2°)
   /* public function getSecondPodiumFlowerIdUser(){
        $query = "SELECT idUser FROM badgesUsers WHERE validated = 1 GROUP BY idUser ORDER BY COUNT(*) DESC LIMIT 2 OFFSET 1;";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }*/

    // PODIO, Funzione che prende idUser con numero di badges completati terzo più alto (3°)
    /*public function getThirdPodiumFlowerIdUser(){
        $query = "SELECT idUser FROM badgesUsers WHERE validated = 1 GROUP BY idUser ORDER BY COUNT(*) DESC LIMIT 3 OFFSET 2;";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }*/
}
?>
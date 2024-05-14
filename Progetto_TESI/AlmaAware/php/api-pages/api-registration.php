<?php
require "../../db/database.php";
require "../../db/bootstrap.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $name = $_POST["name"];
    $campus = $_POST["campus"];
    $password = $_POST["password"];
    $confirmpswd = $_POST["confirmpswd"];

    if (isset($email) && isset($name) && isset($campus) && isset($password) && isset($confirmpswd)){
        $result = $dbh-> checkRegistration($email);
        if ($result->num_rows > 0) {
            $msg= "Registration failed ! Someone already is using your email address!";
            $success = false;
        } else {
            $msg= "Registration done sucessfully";
            // id User
            $idUser=$dbh->getLastIdUser();
            $idUserCurr=$idUser[0]["idUser"]+1;
            // id MyFlower
            $idMyFlower=$dbh->getLastIdMyFlower(); 
            $idMyFlowerCurr=$idMyFlower[0]["idMyFlower"]+1;
            $dbh->insertNewFlower($idMyFlowerCurr, "name" , NULL, NULL, NULL, NULL);
            
            // registration
            $reg= $dbh->registration($idUserCurr, $email, $name, $campus, $password, "../images/medias/user.svg", $idMyFlowerCurr);

            // initialization sdg badges users
            $allbadges=$dbh->getAllBadgeSdg();
            foreach($allbadges as $badge){
                $idbadge=$dbh->getLastIdBadge();
                $idbadgeCurr=$idbadge[0]["idbadge"]+1;
                //var_dump($badge);
                $dbh->insertNewBadge($idbadgeCurr, 0, $badge["badgeName"], $idUserCurr, $badge["idSdg"], $badge["img_unvalid"]);
            }

            $success = true;
        }
    
    } else {
        $msg = "Failed! You didn't fill all the fields.";
        $success = false;
    }
} else {
    $msg = "Invalid request method!";
    $success = false;
}

header('Content-Type: application/json');
echo json_encode(["success" => $success, "message" => $msg]);
?>
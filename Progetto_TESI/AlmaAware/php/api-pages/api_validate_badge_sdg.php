<?php
require_once '../../db/bootstrap.php';
require_once '../../db/database.php';

if (isset($_GET['typeCurr']) && isset($_GET['badgeName']) && isset($_GET['idbadgecurr'])) {

    $idBadgeCurrUser = $_GET['idbadgecurr'];
    $typeCurr = $_GET['typeCurr'];
    $badgeName = $_GET['badgeName'];
    $success=false;

    $counter_times=$dbh->getBadgeSdg($badgeName)[0]['counter_times'];
    $typePopUP=$dbh->getBadgeSdg($badgeName)[0]['type'];
    
    if($typePopUP=="Counter"){
        if($counter_times==$typeCurr){
            $success=true;
            $dbh->setValidateBadgeUser(1, $idBadgeCurrUser);
        }

    }elseif($typePopUP=="Input"){
        if (isset($_GET['inputValue'])) {
            $inputValue = $_GET['inputValue'];
            if ($inputValue <= $counter_times) { 
                $success = true;
                $dbh->setValidateBadgeUser(1, $idBadgeCurrUser);
                $dbh->updateBadgeCounter($inputValue, $idBadgeCurrUser); // setto valore input nel db
            }
        }

    }elseif($typePopUP=="Checkbox"){
        if (isset($_GET['checkboxChecked']) && $_GET['checkboxChecked'] == 'true') {
            $success = true;
            $dbh->setValidateBadgeUser(1, $idBadgeCurrUser);
            $dbh->updateBadgeCounter(1, $idBadgeCurrUser); // setto 'true' nel db (cioè =1)
        }

    }elseif($typePopUP=="Quiz1" || $typePopUP=="Quiz2"){
        if ($typeCurr == 1) { // Indica che il quiz è stato superato
            $success = true;
            $dbh->setValidateBadgeUser(1, $idBadgeCurrUser);
        }
    }elseif($typePopUP=="QR-Code"){

    }elseif($typePopUP=="Timer"){
        if ($typeCurr >= $counter_times) {
            $success = true;
            $dbh->setValidateBadgeUser(1, $idBadgeCurrUser);
        }

    }elseif($typePopUP=="Link"){
        // devo guardare se utente è collegato alla serra
        $idUser=$dbh->getIdUserFromBadgesUsersTable($idBadgeCurrUser);
        $idMyFlower=$dbh->getIdFlowerFromIdUser($idUser);
        $isShown=$dbh->getUserFlower($idMyFlower)[0]['showInGreenhouse'];

        if($isShown=='Y'){
            $success = true;
            $dbh->setValidateBadgeUser(1, $idBadgeCurrUser);
        }
    }

    // Restituisci il nuovo valore come risposta JSON
    echo json_encode(['success' => $success]);
}
?>
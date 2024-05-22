<?php
require_once '../../db/bootstrap.php';
require_once '../../db/database.php';

if (isset($_GET['typeCurr']) && isset($_GET['badgeName'])) {
    $idBadgeCurrUser = $_GET['idbadgecurr'];
    $typeCurr = $_GET['typeCurr'];
    $badgeName = $_GET['badgeName'];
    $success=false;

    $counter_times=$dbh->getBadgeSdg($badgeName)[0]['counter_times'];
    
    // Caso del counter
    if($counter_times==$typeCurr){
        $success=true;
        $dbh->setValidateBadgeUser(1, $idBadgeCurrUser);
    }
    // Da gestire: CheckBox, Quiz, link, timer
    // ..

    // Restituisci il nuovo valore come risposta JSON
    echo json_encode(['success' => $success]);
}
?>
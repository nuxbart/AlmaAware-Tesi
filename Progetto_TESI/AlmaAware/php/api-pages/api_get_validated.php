<?php
require_once '../../db/bootstrap.php';
require_once '../../db/database.php';
    
    if (isset($_GET['userSessionID']) && is_numeric($_GET['userSessionID'])) {
        $userSessionID = $_GET['userSessionID'];
        $badgesValidated = $dbh->getAllBadgeValidNot(1, $userSessionID);

        foreach($badgesValidated as $key => $badge){
            $curr=$dbh->getBadgeSdg($badge['nameBadge']);
            $badgesValidated[$key]['image'] = $curr[0]['img_valid'];
        }
        // Restituisci i badge validati come JSON
        header('Content-Type: application/json');
        echo json_encode($badgesValidated);
    } else {
        // Se l'ID utente non è stato fornito o non è valido
        echo json_encode(array('error' => 'ID utente non valido.'));
    }
?>
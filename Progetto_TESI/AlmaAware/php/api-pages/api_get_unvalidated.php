<?php
require_once '../../db/bootstrap.php';
require_once '../../db/database.php';
    
    if (isset($_GET['userSessionID']) && is_numeric($_GET['userSessionID'])) {
        
        $userSessionID = $_GET['userSessionID'];
        $badgesUnvalidated = $dbh->getAllBadgeValidNot(0, $userSessionID);

        foreach($badgesUnvalidated as $key => $badge){
            $curr=$dbh->getBadgeSdg($badge['nameBadge']);
            $badgesUnvalidated[$key]['image'] = $curr[0]['img_unvalid'];
        }
        // Restituisci i badge non validati come JSON
        header('Content-Type: application/json');
        echo json_encode($badgesUnvalidated);
    } else {
        // Se l'ID utente non è stato fornito o non è valido
        echo json_encode(array('error' => 'ID utente non valido.'));
    }

?>
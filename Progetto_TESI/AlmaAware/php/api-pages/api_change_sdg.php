<?php
require_once '../../db/bootstrap.php';
require_once '../../db/database.php';

    if (isset($_GET['i']) && is_numeric($_GET['i']) && isset($_GET['userSessionID']) && is_numeric($_GET['userSessionID'])) {
       
        $userSessionID = $_GET['userSessionID'];
        $sdgID = $_GET['i'];
        
        if($sdgID!=0){
            $badgesBySdg = $dbh->getAllBadgeOneSdg($sdgID, $userSessionID);
            
        }else{
            $badgesBySdg = $dbh->getAllBadgeSdgOfUser($userSessionID);

        }
        
        foreach($badgesBySdg as $key => $badge){
            $curr=$dbh->getBadgeSdg($badge['nameBadge']);

            if($badgesBySdg[$key]['validated']==1){

                $badgesBySdg[$key]['image'] = $curr[0]['img_valid'];
            }else{

                $badgesBySdg[$key]['image'] = $curr[0]['img_unvalid'];
            }
        }
        
        // Restituisci i badge relativi all'SDG selezionato come JSON
        header('Content-Type: application/json');
        echo json_encode($badgesBySdg);
    } else {
        // Se i parametri non sono stati forniti o non sono validi
        echo json_encode(array('error' => 'Parametri non validi.'));
    }
?>
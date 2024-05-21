<?php
require_once '../../db/bootstrap.php';
require_once '../../db/database.php';

if (isset($_GET['badgeId']) && isset($_GET['currentCount'])) {
    $badgeId = $_GET['badgeId'];
    $newCount = $_GET['currentCount'];
   
    $success=$dbh->updateBadgeCounter($newCount, $badgeId);
    
    // Restituisci il nuovo valore come risposta JSON
    echo json_encode(['newCounter' => $newCount, 'success' => $badgeId]);
}
?>
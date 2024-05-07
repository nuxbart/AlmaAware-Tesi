<?php
require_once '../../db/bootstrap.php';
require_once '../../db/database.php';


if (isset($_GET['idSdg']) && isset($_GET['nameBadge'])) {
    $idSdg = $_GET['idSdg'];
    $nameBadge = $_GET['nameBadge'];
    
    $color = colorSdg($idSdg);
    $sdg=$dbh->getBadgeSdg($nameBadge);
    
    // Restituisci il colore e il sdg badge come JSON
    echo json_encode(['color' => $color, 'badgeSdg'=>$sdg]);
} else {
    // Se l'ID dell'SDG non è stato fornito, restituisci un errore
    echo json_encode(['error' => 'ID SDG not provided']);
}
?>
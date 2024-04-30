<?php
require_once '../../db/bootstrap.php';
require_once '../../db/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST["name"] ?? '';
    $color = $_POST['color'] ?? '';
    $type = $_POST['type'] ?? '';
    $email = $_SESSION['email']; 

    $idMyFlower=$dbh->getIDFlower($_SESSION["email"]); 
    
    $overallStatus = 'success'; // Stato complessivo
    
    if($name!=''){
        $resultName = $dbh->updateFlowerName($name, $idMyFlower[0]["idMyFlower"]);
        if (!$resultName) {
            $overallStatus = 'error';
        }
    }
    
    if($color!='undefined'){
        $resultPot = $dbh->updateFlowerColorPot($color, $idMyFlower[0]["idMyFlower"]);
        if (!$resultPot) {
            $overallStatus = 'error';
        }
    }
    
    if($type!='undefined'){
        if($type=="flower1"){
            $resultFlower = $dbh->updateFlowerType1(true, $idMyFlower[0]["idMyFlower"]);
        }elseif($type=="flower2"){
            $resultFlower = $dbh->updateFlowerType2(true, $idMyFlower[0]["idMyFlower"]);
        }else{
            $resultFlower = $dbh->updateFlowerType3(true, $idMyFlower[0]["idMyFlower"]);
        }
        
        if (!$resultFlower) {
            $overallStatus = 'error';
        }
    }
    
    header('Content-Type: application/json');
    if ($overallStatus === 'success') {
        echo json_encode(['status' => 'success', 'message' => 'Data updated successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update data']);
    }


} else {
    // Metodo non supportato
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
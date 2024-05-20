<?php
require_once '../../db/bootstrap.php';
require_once '../../db/database.php';

$result["JoinEseguito"] = false;

	if(isset($_POST["email"])) {
        $idMyFlower=$dbh->getIDFlower($_POST["email"]);
		$join_result = $dbh->joinGreenhouse("Y",$idMyFlower[0]["idMyFlower"]);
		
		if($join_result) {
			$result["JoinEseguito"] = true;
		}else{
            //Join alla serra fallito
            $result["error"] = "Email non presente nel DB!";
        }
	}
    
	header('Content-Type: application/json');
	echo json_encode($result["JoinEseguito"]);
?>
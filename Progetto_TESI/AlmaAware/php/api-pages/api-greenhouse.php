<?php
require_once '../../db/bootstrap.php';
require_once '../../db/database.php';

$result["JoinEseguito"] = false;

	if(isset($_POST["email"])) {
        $idMyFlower=$dbh->getIDFlower($_POST["email"]);
		
		if($idMyFlower){
			$join_result = $dbh->joinGreenhouse("Y",$idMyFlower[0]["idMyFlower"]);
		
			if($join_result) {
				$result["JoinEseguito"] = true;
			}else{
				//Join alla serra fallito
				$result["error"] = "Non riuscita join nella serra!";
			}
		}else{
			$result["error"] = "Email non presente nel DB!";
		}
		
	}
    
	header('Content-Type: application/json');
	echo json_encode($result);
?>
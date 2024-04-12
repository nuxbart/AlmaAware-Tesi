<?php
require_once '../../db/bootstrap.php';
require_once '../../db/database.php';

$result["logineseguito"] = false;

	if(isset($_POST["email"]) && isset($_POST["password"])) {
		$login_result = $dbh->checkLogin($_POST["email"], $_POST["password"]);
		
		if(count($login_result)!=0) {
            registerLoggedUser($login_result[0]);
			$result["logineseguito"] = true;
			$_SESSION["idUser"] = $login_result[0]["idUser"];
			$_SESSION["email"] = $login_result[0]["email"];
            $_SESSION["password"] = $login_result[0]["password"];
			$_SESSION["name"] = $login_result[0]["name"];
			$_SESSION["campus"] = $login_result[0]["campus"];
			$_SESSION["img_profile"] = $login_result[0]["img_profile"];
            
		}else{
            //Login fallito
            $result["error"] = "Email e/o Password errati";
        }
	}
    
	header('Content-Type: application/json');
	echo json_encode($result["logineseguito"]);
?>
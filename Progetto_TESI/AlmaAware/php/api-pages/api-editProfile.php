<?php
	require_once '../../db/bootstrap.php';
	require_once '../../db/database.php';

	// Recupero dei dati inviati tramite POST
	$name = $_POST['name'];
	$email = $_POST['email'];
	$campus = $_POST['campus'];
	$password = $_POST['password'];

	// Aggiornamento dati nel DB
	if($name != ""){
		$res['name'] = $dbh->updateName($name,$_SESSION['idUser']);
		$_SESSION["name"] = $name;
	}

	if($email != ""){
		$res['email'] = $dbh->updateEmail($email,$_SESSION['idUser']);
		$_SESSION["email"] = $email;
	}

	if($campus != ""){
		$res['campus'] = $dbh->updateCampus($campus,$_SESSION['idUser']);
		$_SESSION["campus"] = $campus;
	}

	if( $password != ""){
		$res['password'] = $dbh->updatePass($password,$_SESSION['idUser']);
		$_SESSION["password"] = $password;
	}

	if(isset($_FILES['img_profile']) && $_FILES['img_profile']['error'] == 0){
		$uploadDirectory = "C:/xampp/htdocs/almaAware/Progetto_TESI/AlmaAware/images/medias/profile_Pic/";
		$fileName = $_FILES['img_profile']['name'];
		$uploadDirectory2 = "../images/medias/profile_Pic/";
		$uploadFilePath = $uploadDirectory . $fileName;
		$uploadFilePathDB = $uploadDirectory2 . $fileName;
		
		// Sposta il file caricato nella cartella di destinazione
		if(move_uploaded_file($_FILES['img_profile']['tmp_name'], $uploadFilePath)){
			$res['img_profile'] = $dbh->updateIMG($uploadFilePathDB,$_SESSION['idUser']);
			$_SESSION["img_profile"] = $uploadFilePathDB;
		} else {
			$res['img_profile_error'] = "Failed to upload image";
		}
	}
	
	header('Content-Type: application/json');
	echo json_encode($res);
?>
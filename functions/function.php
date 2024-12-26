<?php

function upload($file,$destination,$maxsize=2097152,$legal_extensions=array("jpg", "jpeg", "png", "gif")) {
	$error = false;

	// On définit nos constantes
	$newName = uniqid();
	$maxsize = intval($maxsize);

	// On récupères les infos
	$actualName = $file['tmp_name'];
	$actualSize = $file['size'];
	$extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

	// On effectue nos vérifications réglementaires
	if(empty($actualName) || $actualSize == 0) $error = true;
	if(file_exists($destination.$newName.'.'.$extension)) $error = true;
	if($actualSize > $maxsize) $error = true;
	if(!empty($legal_extensions) && !in_array($extension, $legal_extensions)) $error = true;

	if($error === false) {
		if($tmp = move_uploaded_file($actualName, $destination.$newName.'.'.$extension))
			return $newName.'.'.$extension;
		else $error = true;
	}
  
	if($error === true){
	    // On supprime le fichier du serveur
	    @unlink($destination.'/'.$newName.'.'.$extension);
	    return false;
	}
}
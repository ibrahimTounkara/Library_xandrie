<?php


function startSession($login,$password){
	
	$valid = false;
	
	if(!isset($login) && !isset($password)){
		$valid = false;
	}
	else{
	
		$file = $_SERVER['DOCUMENT_ROOT'] .'xandrieAPIs/app/animationAPI/config/config.ini';
		$configfile = parse_ini_file($file,1);
	
		if($configfile['USER_ALLOWED']['login'] == $login && $configfile['USER_ALLOWED']['password'] == $password){
			$valid = true;
			$_SESSION['login'] = $login;
			$_SESSION['password'] = $password;
		}
		else{
			$valid = false;
		}
	}
	return $valid;
}



function endSession(){
	session_unset();
}



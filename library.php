<?php


/**
 * Check whether the credentials are correct
 * @param string $login
 * @param string $password
 * @return boolean
 */

function checkParameters($login,$password){
	$valid = false;
	 
	if(!isset($login) && !isset($password)){	
		$valid = false;
	}
	else{
		
		$file = $_SERVER['DOCUMENT_ROOT'] .'xandrieAPIs/app/animationAPI/config/config.ini';
		$configfile = parse_ini_file($file,1);
		
		if($configfile['CREDENTIALS_ANIMATION_WEBSERVICE']['name'] == $login && $configfile['CREDENTIALS_ANIMATION_WEBSERVICE']['password'] == $password){			
			$valid = true;
		}
		else{
			$valid = false;
		}
	}
	return $valid;
}




/**
 * Parse XML/RDF file located in a given directory
 * @param string $path (Path's directory)
 * @return array $arrayxml (array of SimpleXMLElement objects type)
 * @example RDFparser('C:/project/folder/')
 */

function RDFparser($path){
	$files    = glob($path.'*.{rdf}', GLOB_BRACE);
	$arrayxml = array();
	
	foreach ($files as $file){
		$RDF = file_get_contents($file);
		$RDF = str_replace('rdf:about="."', ' ', $RDF);
		$RDF = str_replace('rdf:', 'rdf_', $RDF);
		$RDF = str_replace('mp:', 'mp_', $RDF);

		$doc = new DOMDocument();
		$doc->loadXML($RDF);
		$string = $doc->saveXML();

		$xpath = new DOMXPath($doc);
		foreach( $xpath->query('//*[not(node())]') as $node ) {
			$node->parentNode->removeChild($node);
		}

		$string = $doc->saveXML();
		$XML    = simplexml_load_string($string);
		
		array_push($arrayxml, $XML);
	}
	return $arrayxml;
}





function isNull($array){
	$null == false;
	
	foreach ($array as $e){
		if(is_null($e)){
			$null == true;
			return $null;
		}
		 else{
		 	$null == false;
		 }
	}
	return $null;
}















/**
 * Use the native spl_autoload_register() function who is
 * called when a class is instanciated
 * @param string $class (Class name)
 * @param string $API_ROOT (targeted path)
 */
function autoloader($class){
	require_once $_SERVER['DOCUMENT_ROOT'] .'xandrieAPIs/app/'.$class.'.class.php';
}

spl_autoload_register("autoloader");
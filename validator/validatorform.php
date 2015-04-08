<?php

/**
 * Check whether data are well formated as expected
 * before to validate it as an objectable Product
 * 
 * @param array
 * @return boolean
 */
function validatorForm($product){

	$formarray = array( $this->validatorStatus($product->status),
			$this->validatorInteger($product->showcaseId),
			is_int($product->position),
			$this->validatorDateTime($product->start_dateTime),
			$this->validatorDateTime($product->end_dateTime),
			$this->validatorDate($product->created_date),
			//$this->validatorDateTime($product->timestamp)
	);

	foreach($formarray as $field){
		if($field == false){
			return false;
		}
	}
	return true;
}




/**
 * Check if a dateTime is well formated as expected
 * @param DateTime $date
 * @return boolean
 */
function validatorDateTime($date){
	$format = 'Y-m-d H:i:s';
		
	if(DateTime::createFromFormat($format, $date) == false){
		return false;
	}
	else
		return true;
}


/**
 * Check whether a date match with the expected format
 * @param unknown $date
 * @return boolean
 */
function validatorDate($date){
	$format = 'Y-m-d';

	if(DateTime::createFromFormat($format, $date) == false){
		return false;
	}
	else
		return true;
}




/**
 * Check whether the Product's status is Offline or Online
 * @param string $needle
 * @return boolean
 */
function validatorStatus($needle){
		
	if(!in_array($needle, array('Offline','Online')))
		return false;
	else
		return true;
}



/**
 * Check whether the parameter is an integer
 * @param unknown $needle
 * @return boolean
 */
function validatorInteger($needle){
	if(!is_int($needle))
		return false;
	else
		return true;
}


/**
 * Validate a decoded JSON object
 * @param JSON object $json
 * @throws Exception
 * @return array
 */
function validatorJsonDecode($json){
	if(json_decode($json) != TRUE){
		throw new Exception( json_last_error() );
	}
	else{
		$ob = json_decode($json);
	}
	return $ob;
}
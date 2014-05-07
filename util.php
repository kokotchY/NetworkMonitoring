<?php

function showQuery($query, $params)
{
	$keys = array();
	$values = array();

# build a regular expression for each parameter
	foreach ($params as $key=>$value)
	{
		if (is_string($key))
		{
			$keys[] = '/:'.$key.'/';
		}
		else
		{
			$keys[] = '/[?]/';
		}

		if(is_numeric($value))
		{
			$values[] = intval($value);
		}
		else
		{
			$values[] = '"'.$value .'"';
		}
	}

	$query = preg_replace($keys, $values, $query, 1, $count);
	return $query;
}

function displayMessage($msg) {
	$timestamp = @date('Y/m/d-H:i:s');
	echo '['.$timestamp.'] '.$msg."\n";
}

function displayErrror($mac, $ip) {
	displayMessage('!!!ALARM!!! Unknown mac address '.$mac.' for ip '.$ip);

}
function displayQuery($sql, $input) { 
	displayMessage(showQuery($sql, $input));
}

/*
IPv4 ip = 6 hex field
*/
function normalizeMac($mac) { 
	$mac = strtolower(trim($mac));	
	$pattern = '/([[:alnum:]]{2}).([[:alnum:]]{2}).([[:alnum:]]{2}).([[:alnum:]]{2}).([[:alnum:]]{2}).([[:alnum:]]{2})/';
	$result = preg_replace($pattern,
		'$1:$2:$3:$4:$5:$6',
		$mac);
	if (isset($result)) {
		return $result;
	}
	return null;
}

function hashPassword($password, $salt) {
	return sha1($salt.$password.$salt);
}

/*
Found here: http://stackoverflow.com/questions/4356289/php-random-string-generator
*/
function generateSalt() {
	$length = 30;
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, strlen($characters) - 1)];
	}
	return $randomString;
}

function hasLevelAccess($level) {
	if ($level == 0) {
		return true;
	}

	return isset($_SESSION['level']) && $_SESSION['level'] >= $level;
}

function getPostInput($fields) {
	return getInputFromArray($_POST, $fields);
}

function getGetInput($fields) {
	return getInputFromArray($_GET, $fields);
}

function getInputFromArray($array, $fields) {
	$result = array();
	foreach ($fields as $field) {
		if (isset($array[$field])) {
			$result[$field] = $array[$field];
		}
	}
	return $result;
}
?>

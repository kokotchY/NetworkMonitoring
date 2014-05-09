<?php



require '/home/kokotchy/public_html/networkMonitoring/databaseConnection.php';
require '/home/kokotchy/public_html/networkMonitoring/util.php';

$filename = '/tmp/output.xml';
$command = 'sudo nmap -oX '.$filename.' -sP -n 192.168.1.0/24';

displayMessage('Generating list of ip and mac address');
exec($command);

function getMacAddress($addresses) {
	foreach ($addresses as $address) {
		if (isset($address['addrtype']) && ($address['addrtype'] == 'mac')) {
			return normalizeMac($address['addr']);
		}
	}
}

function getIpAddress($addresses) {
	foreach ($addresses as $address) {
		if (isset($address['addrtype']) && ($address['addrtype'] == 'ipv4')) {
			return $address['addr'];
		}
	}
}

function needCreateAlert($dbh, $mac, $ip) {
	$sqlCheck = 'SELECT count(1) as `NB` FROM `alert` WHERE `mac` = :mac and `ip` = :ip';
	$stmt = $dbh->prepare($sqlCheck);
	$inputSelect = array('mac' => $mac, 'ip' => $ip);
	displayQuery($sqlCheck, $inputSelect);
	$execute = $stmt->execute($inputSelect);
	if ($execute && $stmt->rowCount() > 0) {
		$row = $stmt->fetch();
		if ($row && $row['NB'] == 0) {
			return true;
		} 
	}
	return false;
}

function createAlert($dbh, $mac, $ip) {
	$inputSelect = array('mac' => $mac, 'ip' => $ip);
	$sqlInsert = 'INSERT INTO `alert` (`id_alert`, `mac`, `ip`)
		VALUES (NULL, :mac, :ip)';
	$inputInsert = $inputSelect;
	$stmtInsert = $dbh->prepare($sqlInsert);
	displayQuery($sqlInsert, $inputInsert);
	$executeInsert = $stmtInsert->execute($inputInsert);
	if ($executeInsert) {
		displayMessage('Record created for '.$mac.' and '.$ip);
	} else {
		displayMessage('It\'s failling...');
	}

	return $inputSelect;
}

$sql = 'SELECT m.`name` AS `name`, o.`name` AS `owner`, t.`name` AS `type`
	FROM `mac` m
	LEFT JOIN `owner` o ON m.`id_owner` = o.`id_owner` 
	LEFT JOIN `typeConnection` t ON m.`type_connection` = t.`id_type` 
	WHERE m.`mac` = :mac';
$stmt = $dbh->prepare($sql);
$dbh->beginTransaction();

$alerts = array();

if (file_exists($filename)) {
	$nb_mac = 0;
	$statistics = array();
	$scan = simplexml_load_file($filename);
	foreach ($scan->host as $host) {
		$mac = getMacAddress($host->address);
		$ip = getIpAddress($host->address);
		$nb_mac++;
		$statistics[] = array('mac' => $mac, 'ip' => $ip);
		if (!empty($mac)) {
			$input = array('mac' => $mac);
			$execute = $stmt->execute($input);
			if ($execute && $stmt->rowCount() == 0) {
				if (needCreateAlert($dbh, $mac, $ip)) {
					displayErrror($mac, $ip);
					//$alerts[] = createAlert($dbh, $mac, $ip);
				}
			} else {
				displayMessage('Alert already created');
			}
		}
	}

	if (count($alerts) > 0) {
		$timestamp = date('H:i:s d/m/Y');
		$message = 'New devices just have been detected on the network ('.$timestamp.'):'."\n";
		foreach ($alerts as $alert) {
			$message .= '- '.$alert['mac'].' - '.$alert['ip']."\n";
		}

		displayMessage('Sending email with following message: '.$message);
		if (mail('kokotchy@gmail.com', '[Alert] New devices detected '.$timestamp, $message)) {
			displayMessage('Email successfully sent');
		} else {
			displayMessage('Error when trying to send message');
		}

	}
	$sql = 'INSERT INTO `statistics` (`nb`, `macs`)
		VALUES (:nb, :macs)';
	$macs = '';
	foreach ($statistics as $stat) {
		$macs .= $stat['mac'].','.$stat['ip']."\n";
	}
	$stmt = $dbh->prepare($sql);
	$input = array('nb' => $nb_mac, 'macs' => $macs);
	$stmt->execute($input);
	displayQuery($sql, $input);
	exec('sudo rm '.$filename);
}

$dbh->commit();
$dbh = null;

?>

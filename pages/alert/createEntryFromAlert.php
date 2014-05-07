<?php

function getOwners($dbh) {
	$sql = 'SELECT `id_owner`, `name` FROM `owner` ORDER BY `name` ASC';
	$stmt = $dbh->prepare($sql);
	$result = $stmt->execute();
	$options = [];
	if ($result && $stmt->rowCount() > 0) {
		while (($row = $stmt->fetch()) !== false) {
			$id = $row['id_owner'];
			$name = $row['name'];
			$options[$id] = $name;
		}
	}

	return $options;
}

function getData($dbh, $idAlert) {
	$sql = 'SELECT `mac`, `ip`
		FROM `alert`
		WHERE `id_alert` = :id';

	$stmt = $dbh->prepare($sql);
	$input = array('id' => $idAlert);
	$result = $stmt->execute($input);
	$mac = '';
	$ip = '';
	if ($result && $stmt->rowCount() == 1) {
		$row = $stmt->fetch();
		$mac = $row['mac'];
		$ip = $row['ip'];	
	}

	return array($mac, $ip);
}

function getTypes($dbh) {
	$sql = 'SELECT `id_type`, `name` FROM `typeConnection` ORDER BY `name` ASC';
	$stmt = $dbh->prepare($sql);
	$result = $stmt->execute();
	$types = [];
	if ($result && $stmt->rowCount() > 0) {
		while (($row = $stmt->fetch()) !== false) {
			$id = $row['id_type'];
			$name = $row['name'];
			$types[$id] = $name;
		}
	}

	return $types;
}

function insertEntry($dbh, $name, $mac, $ip, $owner, $type) {
	$sql = 'INSERT INTO `mac` (`mac`, `id_owner`, `name`, `type_connection`, `ip`)
		VALUES (:mac, :owner, :name, :type, :ip)';
	$stmt = $dbh->prepare($sql);
	$input = array('mac' => $mac, 'owner' => $owner, 'name' => $name, 'type' => $type, 'ip' => $ip);
	displayQuery($sql, $input);
	$result = $stmt->execute($input);
}

function deleteAlert($dbh, $idAlert) {
	$sql = 'DELETE FROM `alert` WHERE `id_alert` = :id';
	$input = array('id' => $idAlert);
	displayQuery($sql, $input);
	$stmt = $dbh->prepare($sql);
	$stmt->execute($input);
}

$smarty->assign('entryCreated', false);
$smarty->assign('creationMessage', '');
if (isset($_GET['id_alert'])) {

	$idAlert = $_GET['id_alert'];

	list($mac, $ip) = getData($dbh, $idAlert);
	$smarty->assign('mac', $mac);
	$smarty->assign('ip', $ip);
	$smarty->assign('idAlert', $idAlert);
	$smarty->assign('owners', getOwners($dbh));
	$smarty->assign('types', getTypes($dbh));
} else if (isset($_POST['id_alert'])) {
	$idAlert = $_POST['id_alert'];

	$name = $_POST['name'];
	$mac = $_POST['mac'];
	$ip = $_POST['ip'];
	$owner = $_POST['owner'];
	$type = $_POST['type'];

	insertEntry($dbh, $name, $mac, $ip, $owner, $type);
	deleteAlert($dbh, $idAlert);
	$smarty->assign('entryCreated', true);
	$smarty->assign('creationMessage', 'The entry has been created');
}

$smarty->assign('currentPage', 'alert/createEntryFromAlert.tpl');

?>

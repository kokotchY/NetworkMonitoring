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

function getPostInput($fields) {
	$result = array();
	foreach ($fields as $field) {
		if (isset($_POST[$field])) {
			$result[$field] = $_POST[$field];
		}
	}
	return $result;
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

$smarty->assign('entryUpdated', false);
if (isset($_GET['id_mac'])) {
	$id_mac = $_GET['id_mac'];
	$sql = 'SELECT * FROM `mac`
		WHERE `id_mac` = :id';
	$input = array('id' => $id_mac);	
	$stmt = $dbh->prepare($sql);
	if ($stmt->execute($input) && $stmt->rowCount() == 1) {
		$smarty->assign('data', $stmt->fetch());
		$smarty->assign('owners', getOwners($dbh));
		$smarty->assign('types', getTypes($dbh));
		$smarty->assign('message', '');
	} else {
		$smarty->assign('message', 'The mac entry '.$id_mac.' wasn\'t found in the database');
	}
} elseif (isset($_POST['id_mac'])) {
	$id_mac = $_POST['id_mac'];
	$sql = 'UPDATE `mac`
		SET `name` = :name,
		`id_owner` = :owner,
		`mac` = :mac,
		`ip` = :ip,
		`type_connection` = :type
		WHERE `id_mac` = :id_mac';
	$input = getPostInput(array('name', 'owner', 'mac', 'ip', 'type', 'id_mac'));
	$stmt = $dbh->prepare($sql);
	print_r(displayQuery($sql, $input));
	if ($stmt->execute($input)) {
		$smarty->assign('message', 'The mac entry has been modified');
		$smarty->assign('entryUpdated', true);
	} else {
		$smarty->assign('message', 'Error when trying to update the entry');
	}
} else {
	$smarty->assign('message', '');
}


$smarty->assign('currentPage', 'editMac.tpl');

?>

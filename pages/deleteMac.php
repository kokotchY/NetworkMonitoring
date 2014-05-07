<?php

if (isset($_GET['id_mac'])) {
	$id_mac = $_GET['id_mac'];
	$sql = 'DELETE FROM `mac`
		WHERE `id_mac` = :id_mac'; 
	$input = getGetInput(array('id_mac'));
	$stmt = $dbh->prepare($sql);
	if ($stmt->execute($input)) {
		$smarty->assign('message', 'The mac has been deleted.');
	} else {
		$smarty->assign('message', 'The mac wasn\'t deleted.');
	}
} else {
	$smarty->assign('message', 'The id_mac is not present.');
}

$smarty->assign('currentPage', 'simpleMessage.tpl');

?>

<?php

if (isset($_GET['id_alert'])) {
	$id_alert = $_GET['id_alert'];
	$sql = 'DELETE FROM `alert`
		WHERE `id_alert` = :id';
	$input = array('id' => $id_alert);	
	$stmt = $dbh->prepare($sql);
	if ($stmt->execute($input)) {
		$smarty->assign('message', 'Alert '.$id_alert.' has been deleted.');
	} else {
		$smarty->assign('message', 'Alert '.$id_alert.' wasn\'t found in the database.');
	}
} else {
	$smarty->assign('message', 'You need to provide id_alert');
}


$smarty->assign('currentPage', 'simpleMessage.tpl');
?>  

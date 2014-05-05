<?php

if (isset($_GET['id_owner'])) {
	$sql = 'SELECT COUNT(1) AS `nb`
		FROM `mac`
		WHERE `id_owner` = :id';

	$stmt = $dbh->prepare($sql);
	$input = array('id' => $_GET['id_owner']);
	if ($stmt->execute($input)) {
		$nb = $stmt->fetch()['nb'];
		if ($nb == 0) {
			$stmt = $dbh->prepare('DELETE FROM `owner` WHERE `id_owner` = :id');
			if ($stmt->execute($input)) {
				$smarty->assign('message', 'The owner has been deleted');
			}
		} else {
			$smarty->assign('message', 'The owner can\'t be deleted because there is '.$nb.' macs assigned');
		}
	} else {
		$smarty->assign('message', 'Error when trying to deleted the owner');
	}
} else {
	$smarty->assign('message', 'Bad usage of the page');
}

$smarty->assign('currentPage', 'simpleMessage.tpl');

?>

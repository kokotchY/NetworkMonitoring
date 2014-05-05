<?php

$sql = 'SELECT m.`id_mac`, m.`mac`, m.`name`, m.`ip`, o.`name` as `owner`, t.`name` as `type` 
	FROM `mac` m 
	LEFT JOIN `owner` o ON m.`id_owner` = o.`id_owner` 
	LEFT JOIN `typeConnection` t ON m.`type_connection` = t.`id_type` 
	ORDER BY m.`name`';
$stmt = $dbh->prepare($sql);
if ($stmt->execute()) {
	$smarty->assign('macs', $stmt->fetchAll());
} else {
	$smarty->assign('macs', array());
}

$smarty->assign('currentPage', 'listMacs.tpl');
?>

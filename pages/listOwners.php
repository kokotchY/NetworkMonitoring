<?php

$sql = 'SELECT o.`id_owner`, o.`name`, o.`email`, COUNT(m.`id_mac`) as `nb_mac`
	FROM `owner` o
	LEFT JOIN `mac` m ON o.`id_owner` = m.`id_owner`
	GROUP BY o.`id_owner`
	ORDER BY `name`';
$stmt = $dbh->prepare($sql);
if ($stmt->execute()) {
	$smarty->assign('owners', $stmt->fetchAll());	
} else {
	$smarty->assign('owners', array());	
}
$smarty->assign('currentPage', 'listOwners.tpl');

?>

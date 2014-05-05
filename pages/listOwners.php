<?php

$sql = 'SELECT `id_owner`, `name`, `email` 
	FROM `owner`
	ORDER BY `name`';
$stmt = $dbh->prepare($sql);
if ($stmt->execute()) {
	$smarty->assign('owners', $stmt->fetchAll());	
} else {
	$smarty->assign('owners', array());	
}
$smarty->assign('currentPage', 'listOwners.tpl');

?>

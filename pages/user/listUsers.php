<?php

$sql = 'SELECT * FROM `users`
	ORDER BY `username`';
$stmt = $dbh->prepare($sql);
if ($stmt->execute()) {
	$smarty->assign('users', $stmt->fetchAll());
} else {
	$smarty->assign('users', array());
}

$smarty->assign('currentPage', 'user/listUsers.tpl');

?>

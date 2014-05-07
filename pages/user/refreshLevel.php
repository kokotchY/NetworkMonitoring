<?php

$sql = 'SELECT `level`
	FROM `users`
	WHERE `id_user` = :id';
$stmt = $dbh->prepare($sql);
$stmt->execute(array('id' => $_SESSION['id_user']));
$_SESSION['level'] = $stmt->fetch()['level'];

$smarty->assign('message', 'Level updated');
$smarty->assign('currentPage', 'simpleMessage.tpl');

?>

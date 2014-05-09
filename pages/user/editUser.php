<?php

if (isset($_GET['id_user'])) {
	$sql = 'SELECT *
		FROM `users`
		WHERE `id_user` = :id_user';
	$input = getGetInput(array('id_user'));
	$stmt = $dbh->prepare($sql);
	if ($stmt->execute($input) && $stmt->rowCount() == 1) {
		$smarty->assign('user', $stmt->fetch());
		$smarty->assign('message', '');
	} else {
		$smarty->assign('message', 'User not found');
	}
} elseif (isset($_POST['id_user'])) {
	$sql = 'UPDATE `users` 
		SET `username` = :username,
		    `email` = :email,
		    `level` = :level
		WHERE `id_user` = :id_user';
	$input = getPostInput(array('username', 'email', 'level', 'id_user'));
	$stmt = $dbh->prepare($sql);
	$smarty->assign('user', $input);
	if ($stmt->execute($input)) {
		$smarty->assign('message', 'The user has been modified');
	} else {
		$smarty->assign('message', 'Impossible to update the user');
	}
} else {
	$smarty->assign('message', 'Id user is missing');
}

$smarty->assign('currentPage', 'user/editUser.tpl');

?>

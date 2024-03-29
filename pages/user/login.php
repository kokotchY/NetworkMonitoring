<?php

if (isset($_POST['submit'])) {
	$sql = 'SELECT `id_user`, `username`, `password`, `salt`, `level`
		FROM `users`
		WHERE `username` = :username';
	$stmt = $dbh->prepare($sql);
	$username = $_POST['username']; 
	$input = array('username' => $username);
	if ($stmt->execute($input) && $stmt->rowCount() == 1) {
		$row = $stmt->fetch();
		$salt = $row['salt'];
		$password = hashPassword($_POST['password'], $salt);
		if ($password == $row['password']) {
			$_SESSION['logged'] = true;
			$_SESSION['login'] = $username;
			$_SESSION['level'] = $row['level'];
			$_SESSION['id_user'] = $row['id_user'];
			$smarty->assign('loginMessage', 'You are successfully logged as '.$username);
		} else {
			$smarty->assign('loginMessage', 'The username/password wasn\'t found in the database');
		}
	} else {
		$smarty->assign('loginMessage', 'The username/password wasn\'t found in the database');
	}
} else {
	$smarty->assign('loginMessage', '');
}

$smarty->assign('currentPage', 'user/login.tpl');

?>

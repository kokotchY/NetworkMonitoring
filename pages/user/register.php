<?php

function usernameAvailable($dbh, $username) {
	$sql = 'SELECT `username` 
		FROM `users`
		WHERE `username` = :user';
	$stmt = $dbh->prepare($sql);
	$input = array('user' => $username);
	return $stmt->execute($input) && $stmt->rowCount() == 0;
}

if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$password2 = $_POST['password2'];
	$email = $_POST['email'];
	if ($password == $password2) {
		$salt = generateSalt();
		$hashPassword = hashPassword($password, $salt);
		if (usernameAvailable($dbh, $username)) {
			$sql = 'INSERT INTO `users` (`username`, `password`, `salt`, `email`)
				VALUES (:user, :pass, :salt, :email)';
			$input = array('user' => $username, 'pass' => $hashPassword,
					'salt' => $salt, 'email' => $email);
			$stmt = $dbh->prepare($sql);
			if ($stmt->execute($input)) {
				$smarty->assign('registerMessage', 'Account created');
			} else {
				$smarty->assign('registerMessage', 'Error when trying to create account');
			}
		} else {
			$smarty->assign('registerMessage', 'Username not available');
		}
	}
} else {
	$smarty->assign('registerMessage', '');
}

$smarty->assign('currentPage', 'user/register.tpl');

?>

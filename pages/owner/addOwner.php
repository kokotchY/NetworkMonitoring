<?php

if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];

	if (!empty($name)) {
		$sql = 'INSERT INTO `owner` (`name`, `email`)
			VALUES (:name, :email)';
		$stmt = $dbh->prepare($sql);
		$input = array('name' => $name, 'email' => $email);
		if ($stmt->execute($input)) {
			$smarty->assign('message', 'The user '.$name.' have been created');
		} else {
			$smarty->assign('message', 'Error when trying to create the user '.$name);
		}
	} else {
		$smarty->assign('message', 'The name can\'t be empty.');
	}
} else {
	$smarty->assign('message', '');
}

$smarty->assign('currentPage', 'owner/addOwner.tpl');

?>

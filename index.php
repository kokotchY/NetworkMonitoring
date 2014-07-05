<?php

session_start();

require 'Smarty/Smarty.class.php'; 
require 'util.php';
require 'databaseConnection.php';

$smarty = new Smarty();

$smarty->debugging = false;

$smarty->setTemplateDir('smarty/templates');
$smarty->setCompileDir('smarty/templates_c');
$smarty->setCacheDir('smarty/cache');
$smarty->setConfigDir('smarty/config');

$pages = array();
$pages['editUser'] = 'pages/user/editUser.php';
$pages['listUsers'] = 'pages/user/listUsers.php';
$pages['login'] = 'pages/user/login.php';
$pages['logout'] = 'pages/user/logout.php';
$pages['refreshLevel'] = 'pages/user/refreshLevel.php';
$pages['register'] = 'pages/user/register.php';

$pages['createEntryFromAlert'] = 'pages/alert/createEntryFromAlert.php';
$pages['deleteAlert'] = 'pages/alert/deleteAlert.php';
$pages['listAlerts'] = 'pages/alert/listAlerts.php';

$pages['deleteMac'] = 'pages/mac/deleteMac.php';
$pages['editMac'] = 'pages/mac/editMac.php';
$pages['listMacs'] = 'pages/mac/listMacs.php';

$pages['addOwner'] = 'pages/owner/addOwner.php';
$pages['deleteOwner'] = 'pages/owner/deleteOwner.php';
$pages['listOwners'] = 'pages/owner/listOwners.php';

$pages['statistics'] = 'pages/statistics/listStatistics.php';

$level = array();
$level['addOwner'] = 3;
$level['createEntryFromAlert'] = 3;
$level['deleteAlert'] = 3;
$level['deleteMac'] = 3;
$level['deleteOwner'] = 3;
$level['editMac'] = 3;
$level['editUser'] = 5;
$level['listAlerts'] = 2;
$level['listMacs'] = 2;
$level['listOwners'] = 2;
$level['listUsers'] = 5;
$level['login'] = 0;
$level['logout'] = 1;
$level['refreshLevel'] = 1;
$level['register'] = 0;
$level['statistics'] = 2;

$header = array();
$header['addOwner'] = 'Create an owner';
$header['createEntryFromAlert'] = 'Create Entry from Alert';
$header['deleteAlert'] = 'Delete an alert';
$header['deleteMac'] = 'Delete a mac';
$header['deleteOwner'] = 'Delete an owner';
$header['editMac'] = 'Edit a mac';
$header['editUser'] = 'Edit a user';
$header['listAlerts'] = 'List alerts';
$header['listMacs'] = 'List macs';
$header['listOwners'] = 'List Owners';
$header['listUsers'] = 'List users';
$header['login'] = 'Login';
$header['logout'] = 'Logout';
$header['register'] = 'Register';
$header['statistics'] = 'Statistics';

$found = false;
$smarty->assign('hasHeader', false);
foreach ($pages as $name => $file) {
	if (isset($_GET[$name])) {
		if (hasLevelAccess($level[$name])) {
			$found = true;
			if (isset($header[$name])) {
				$smarty->assign('hasHeader', true);
				$smarty->assign('header', $header[$name]);
			}
			require $file;
		}
	}
}

if (!$found) {
	$smarty->assign('currentPage', 'index.tpl');
}

setValueFromSession($smarty, 'logged', false);
setValueFromSession($smarty, 'login', '');
setValueFromSession($smarty, 'level', '');
setValueFromSession($smarty, 'id_user', '');

$smarty->display('layout/design.tpl');

$dbh = null;
?>

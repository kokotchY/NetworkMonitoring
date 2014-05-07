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
$pages['login'] = 'pages/user/login.php';
$pages['register'] = 'pages/user/register.php';
$pages['logout'] = 'pages/user/logout.php';
$pages['listAlerts'] = 'pages/alert/listAlerts.php';
$pages['createEntryFromAlert'] = 'pages/alert/createEntryFromAlert.php';
$pages['listMacs'] = 'pages/mac/listMacs.php';
$pages['listOwners'] = 'pages/owner/listOwners.php';
$pages['addOwner'] = 'pages/owner/addOwner.php';
$pages['deleteOwner'] = 'pages/owner/deleteOwner.php';
$pages['refreshLevel'] = 'pages/user/refreshLevel.php';
$pages['editMac'] = 'pages/mac/editMac.php';
$pages['deleteMac'] = 'pages/mac/deleteMac.php';

$level = array();
$level['login'] = 0;
$level['register'] = 0;
$level['logout'] = 1;
$level['listAlerts'] = 2;
$level['createEntryFromAlert'] = 3;
$level['listMacs'] = 2;
$level['listOwners'] = 2;
$level['addOwner'] = 3;
$level['deleteOwner'] = 3;
$level['refreshLevel'] = 1;
$level['editMac'] = 3;
$level['deleteMac'] = 3;

$header = array();
$header['login'] = 'Login';
$header['register'] = 'Register';
$header['logout'] = 'Logout';
$header['listAlerts'] = 'List alerts';
$header['createEntryFromAlert'] = 'Create Entry from Alert';
$header['listMacs'] = 'List macs';
$header['listOwners'] = 'List Owners';
$header['addOwner'] = 'Create an owner';
$header['deleteOwner'] = 'Delete an owner';
$header['editMac'] = 'Edit a mac';
$header['deleteMac'] = 'Delete a mac';

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

$smarty->assign('logged', isset($_SESSION['logged'])?$_SESSION['logged']:false);
$smarty->assign('login', isset($_SESSION['login'])?$_SESSION['login']:'');
$smarty->assign('level', isset($_SESSION['level'])?$_SESSION['level']:'');
$smarty->display('layout/design.tpl');

$dbh = null;
?>

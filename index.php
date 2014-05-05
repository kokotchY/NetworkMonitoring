<?php

session_start();

require 'Smarty/Smarty.class.php'; 
require 'util.php';
require 'databaseConnection.php';

$smarty = new Smarty();

$smarty->setTemplateDir('smarty/templates');
$smarty->setCompileDir('smarty/templates_c');
$smarty->setCacheDir('smarty/cache');
$smarty->setConfigDir('smarty/config');

$pages = array();
$pages['login'] = 'pages/login.php';
$pages['register'] = 'pages/register.php';
$pages['logout'] = 'pages/logout.php';
$pages['listAlerts'] = 'pages/listAlerts.php';
$pages['createEntryFromAlert'] = 'pages/createEntryFromAlert.php';
$pages['listMacs'] = 'pages/listMacs.php';
$pages['listOwners'] = 'pages/listOwners.php';
$pages['addOwner'] = 'pages/addOwner.php';
$pages['deleteOwner'] = 'pages/deleteOwner.php';

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
$smarty->display('design.tpl');

$dbh = null;
?>

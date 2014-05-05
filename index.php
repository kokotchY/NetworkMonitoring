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

$level['login'] = 0;
$level['register'] = 0;
$level['logout'] = 1;
$level['listAlerts'] = 2;
$level['createEntryFromAlert'] = 3;
$level['listMacs'] = 2;
$level['listOwners'] = 2;

$found = false;

foreach ($pages as $name => $file) {
	if (isset($_GET[$name])) {
		if (hasLevelAccess($level[$name])) {
			$found = true;
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

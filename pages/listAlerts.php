<?php

$sql = 'SELECT `id_alert`, `mac`, `ip`, `timestamp` 
	FROM `alert`
	ORDER BY `timestamp` ASC';

$stmt = $dbh->prepare($sql);
$execute = $stmt->execute();

function createLink($id, $page, $text) {
	return '<a href="?'.$page.'&amp;id_alert='.$id.'">'.$text.'</a>';
}

$rows = array();
if ($execute && $stmt->rowCount() > 0) {
	while (($row = $stmt->fetch()) !== false) {
		$idAlert = $row['id_alert'];
		$createEntry = createLink($idAlert, 'createEntryFromAlert', 'Create Entry');
		$editEntry = createLink($idAlert, 'editAlert', 'Edit');
		$deleteEntry = createLink($idAlert, 'deleteAlert', 'Delete');
		$links = array($createEntry, $editEntry, $deleteEntry);
		$row['links'] = implode(' - ', $links);
		$rows[] = $row;
	}
}

$smarty->assign('alerts', $rows);
$smarty->assign('currentPage', 'listAlerts.tpl')

?>

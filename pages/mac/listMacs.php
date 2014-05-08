<?php
$sql = 'SELECT m.`id_mac`, m.`mac`, m.`name`, m.`ip`, o.`name` as `owner`, t.`name` as `type`, m.`id_owner` as `id_owner`
FROM `mac` m 
LEFT JOIN `owner` o ON m.`id_owner` = o.`id_owner` 
LEFT JOIN `typeConnection` t ON m.`type_connection` = t.`id_type`'."\n";
$input = array();
if (isset($_GET['id_owner'])) {
	$sql .= 'WHERE m.`id_owner` = :id_owner'."\n";
	$input = getGetInput(array('id_owner'));
}

$smarty->assign('order', 'asc');
$smarty->assign('orderField', 'name');

if (isset($_GET['order'])) {
	if (isset($_GET['desc'])) {
		$order = 'DESC';
	} else {
		$order = 'ASC';
	}
	$orders = array();
	$orders['name'] = 'm.`name`';
	$orders['owner'] = 'o.`name`';
	$orders['mac'] = 'm.`mac`';
	$orders['ip'] = 'm.`ip`';
	$orders['type'] = 't.`name`';

	$orderField = $_GET['order'];
	if (isset($orders[$orderField])) {
		$smarty->assign('order', $order);
		$smarty->assign('orderField', $orderField);
		$sql .= 'ORDER BY '.$orders[$orderField].' '.$order;
	} else {
		$sql .= 'ORDER BY m.`name` ASC';
	}

} else {
	$sql .= 'ORDER BY m.`name` ASC';
}

$stmt = $dbh->prepare($sql);
if ($stmt->execute($input)) {
	$smarty->assign('macs', $stmt->fetchAll());
} else {
	$smarty->assign('macs', array());
}

$smarty->assign('currentPage', 'mac/listMacs.tpl');
?>

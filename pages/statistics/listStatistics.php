<?php

function getAverage($dbh) {
	$sql = 'SELECT avg(`nb`) as `average`
		FROM `statistics`';
	$stmt = $dbh->prepare($sql);
	if ($stmt->execute() && $stmt->rowCount() == 1) {
		return $stmt->fetch()['average'];
	} else {
		return 0;
	}
}

$average = getAverage($dbh);
$smarty->assign('average', $average);

$sql = 'SELECT *
	FROM `statistics`
	ORDER BY `timestamp` DESC
	LIMIT 50';

$stmt = $dbh->prepare($sql);
if ($stmt->execute() && $stmt->rowCount() > 0) {
	$smarty->assign('statistics', $stmt->fetchAll());
} else {
	$smarty->assign('statistics', array());
}

$smarty->assign('currentPage', 'statistics/listStatistics.tpl');

?>

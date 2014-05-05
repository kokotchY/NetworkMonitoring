<html>
	<head>
		<title>Network Monitoring - {$currentPage}</title>
		<style type="text/css">
#listAlerts { 
	width: 100%;
}

#listMacs {
	width: 100%;
	border: 1px solid black;
	text-align: center;
}
#listOwners {
	width: 100%;
	border: 1px solid black;
	text-align: center;
}
		</style>
	</head>
	<body>
		{include file='header.tpl'}
		{include file='menu.tpl'}
		{if $hasHeader}
		<h1>{$header}</h1>
		{/if}
		{include file=$currentPage}
		{include file='footer.tpl'}
	</body>
</html>

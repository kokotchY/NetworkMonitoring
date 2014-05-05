<div id="menu">
	<ul>
		{if $logged}
		<li><a href="?listAlerts">List Alerts</a></li>
		<li><a href="?listMacs">List Mac</a></li>
		<li><a href="?listOwners">List Owners</a></li>
		<li><a href="?logout">Logout</a> {$login} (<a href="?refreshLevel">Refresh Level ({$level})</a>)</li>
		{else}
		<li><a href="?login">Login</a></li>
		<li><a href="?register">Register</a></li>
		{/if}
	</ul>
</div>

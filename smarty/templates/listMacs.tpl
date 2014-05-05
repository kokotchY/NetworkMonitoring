<table id="listMacs">
	<tr>
		<th>Name</th>
		<th>Owner</th>
		<th>MAC</th>
		<th>IP</th>
		<th>Type</th>
	</tr>
	{foreach $macs as $mac}
	<tr>
		<td>{$mac['name']}</td>
		<td>{$mac['owner']}</td>
		<td>{$mac['mac']}</td>
		<td>{$mac['ip']}</td>
		<td>{$mac['type']}</td>
	</tr>
	{foreachelse}
	<tr>
		<td colspan="5">No macs</td>
	</tr>
	{/foreach}
</table>

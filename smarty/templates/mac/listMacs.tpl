<table id="listMacs">
	<tr>
		<th>Name</th>
		<th>Owner</th>
		<th>MAC</th>
		<th>IP</th>
		<th>Type</th>
		<th>Actions</th>
	</tr>
	{foreach $macs as $mac}
	<tr>
		<td>{$mac['name']}</td>
		<td>
		<a href="?listMacs&amp;id_owner={$mac['id_owner']}">{$mac['owner']}</a>

		</td>
		<td>{$mac['mac']}</td>
		<td>{$mac['ip']}</td>
		<td>{$mac['type']}</td>
		<td><a href="?editMac&amp;id_mac={$mac['id_mac']}">Edit</a> - 
		<a href="?deleteMac&amp;id_mac={$mac['id_mac']}">Delete</a></td>
	</tr>
	{foreachelse}
	<tr>
		<td colspan="5">No macs</td>
	</tr>
	{/foreach}
</table>

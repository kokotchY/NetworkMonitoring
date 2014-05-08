<table id="listMacs">
	<tr>
		<th>Name <a href="?listMacs&order=name&amp;desc">\/</a> <a href="?listMacs&amp;order=name&amp;asc">/\</a></th>
		<th>Owner <a href="?listMacs&order=owner&amp;desc">\/</a> <a href="?listMacs&amp;order=owner&amp;asc">/\</a></th>
		<th>MAC <a href="?listMacs&order=mac&amp;desc">\/</a> <a href="?listMacs&amp;order=mac&amp;asc">/\</a></th>
		<th>IP <a href="?listMacs&order=ip&amp;desc">\/</a> <a href="?listMacs&amp;order=ip&amp;asc">/\</a></th>
		<th>Type <a href="?listMacs&order=type&amp;desc">\/</a> <a href="?listMacs&amp;order=type&amp;asc">/\</a></th>
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

<table id="listOwners">
	<tr>
		<th>Name</th>
		<th>Email</th>
	</tr>
	{foreach $owners as $owner}
	<tr>
		<td>{$owner['name']}</td>
		<td>{$owner['email']}</td>
	</tr>
	{foreachelse}
	<tr><td colspan="2">No owners</td></tr>
	{/foreach}
</table>

<a href="?addOwner">Create an owner</a>

<table id="listOwners">
	<tr>
		<th>Name</th>
		<th>Email</th>
		<th>Macs</th>
		<th>Actions</th>
	</tr>
	{foreach $owners as $owner}
	<tr>
		<td>{$owner['name']}</td>
		<td>{$owner['email']}</td>
		<td>{$owner['nb_mac']}</td>
		<td>
		{if $displayActions}
		<a href="?editOwner&amp;id_owner={$owner['id_owner']}">Edit</a> -
		<a href="?deleteOwner&amp;id_owner={$owner['id_owner']}">Delete</a>
		{/if}
		</td>
	</tr>
	{foreachelse}
	<tr><td colspan="3">No owners</td></tr>
	{/foreach}
</table>

{if $displayActions}
<a href="?addOwner">Create an owner</a>
{/if}

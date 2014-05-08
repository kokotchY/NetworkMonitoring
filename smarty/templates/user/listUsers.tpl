<table id="listUsers">
	<tr>
		<th>Id</th>
		<th>Name</th>
		<th>Email</th>
		<th>Level</th>
		<th>Actions</th>
	</tr>
	{foreach $users as $user}
	<tr>
		<td>{$user.id_user}</td>
		<td>{$user.username}</td>
		<td>{$user.email}</td>
		<td>{$user.level}</td>
		{if $id_user != $user.id_user}
		<td>
			<a href="?editUser&amp;id_user={$user.id_user}">Edit</a>
			<a href="?deleteUser&amp;id_user={$user.id_user}">Delete</a>
		</td>
		{else}
		<td>No action on yourself</td>
		{/if}
	</tr>
	{foreachelse}
	<tr><td colspan="4">No user</td></tr>
	{/foreach}
</table>

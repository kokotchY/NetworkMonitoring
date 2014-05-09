{$levels = [0, 1, 2, 3, 4, 5]}
{$message}
<form action="?editUser" method="post">
	<label for="username">Username: <input id="username" type="text" name="username" value="{$user.username}" /> </label> <br />
	<label for="email">Email: <input id="email" type="text" name="email" value="{$user.email}" /> </label> <br />
	<label for="level">Level: {html_options name=level options=$levels selected=$user.level} </label> <br />
	<label for="submit"><input type="submit" value="Edit" id="submit" name="submit" /></label>
	<input name="id_user" value="{$user.id_user}" type="hidden" />
</form>

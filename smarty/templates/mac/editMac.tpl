{$message}
{if !$entryUpdated}
<form action="?editMac" method="post">
	<label for="name">Name: <input type="text" id="name" name="name" value="{$data.name}" /> </label> <br />
	<label for="owner">Owner: {html_options name=owner options=$owners selected=$data.id_owner}</label> <br />
	<label for="mac">MAC: <input id="mac" type="text" name="mac" value="{$data.mac}" /> </label> <br />
	<label for="ip">IP: <input id="ip" type="text" name="ip" value="{$data.ip}" /> </label> <br />
	<label for="type">Type: {html_options name=type options=$types selected=$data.type_connection}</label> <br />
	<label for="submit"><input type="submit" id="submit" name="submit" value="Modify" /></label>
	<input name="id_mac" value="{$data.id_mac}" type="hidden" />
</form>
{/if}

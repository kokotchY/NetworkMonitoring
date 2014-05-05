{if $entryCreated}
{$creationMessage}
{else}
<form action="?createEntryFromAlert" method="post">
	<label for="name">Name: <input type="text" id="name" name="name" /></label><br />
	<label for="mac">MAC: <input type="text" id="mac" name="mac" value="{$mac}" /></label><br />
	<label for="ip">IP: <input type="text" id="ip" name="ip" value="{$ip}"/></label><br />
	<label for="owner">Owner: 
		{html_options name=owner options=$owners}
	</label><br />
	<label for="type">Type:
		{html_options name=type options=$types}
	</label><br />
	<label for="submit"><input type="submit" value="Create" id="submit" name="submit" /></label><br />
	<input name="id_alert" value="{$idAlert}" type="hidden" />
</form>
{/if}

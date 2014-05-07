<table id="listAlerts">
<tr><th>Timestamp</th><th>MAC</th><th>IP</th><th>Actions</th></tr>
{foreach $alerts as $alert}
<tr><td>{$alert['timestamp']}</td><td>{$alert['mac']}</td><td>{$alert['ip']}</td><td>{$alert['links']}</td></tr>
{foreachelse}
<tr><td colspan="4" style="text-align: center">No alert</td></tr>
{/foreach}
</table>

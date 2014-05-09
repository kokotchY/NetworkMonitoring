Average #macs = {$average}
<table id="listStatistics">
	<tr>
		<th>Timestamp</th>
		<th>Nb</th>
		<th>Macs</th>
	</tr>
	{foreach $statistics as $stat}
	<tr>
		<td>{$stat.timestamp}</td>
		<td>{$stat.nb}</td>
		<td><pre>{$stat.macs}</pre></td>
	</tr>
	{foreachelse}
	<tr>
		<td colspan="3">No statistics</td>
	</tr>
	{/foreach}
</table>

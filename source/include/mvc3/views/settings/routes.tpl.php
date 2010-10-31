
<div id="submenu">
<?include('settings/menu.tpl.php')?>
</div>

<table border="1">
<tr>
	<th>Active?</th>
	<th>From</th>
	<th>To</th>
	<th>Forward?</th>
</tr>
<?foreach( $routes AS $route ):?>
<tr>
	<td><?=$route->active ? 'Y' : 'N'?></td>
	<td><?=$route->from_regexp?></td>
	<td><?=$route->to_url_path?></td>
	<td><?=$route->forward ? 'Y' : 'N'?></td>
</tr>
<?endforeach?>
</table>

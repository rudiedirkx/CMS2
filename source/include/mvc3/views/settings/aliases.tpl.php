
<div id="submenu">
<?include('settings/menu.tpl.php')?>
</div>

<table border="1">
<tr>
	<th>From</th>
	<th>To</th>
</tr>
<?foreach( $aliases AS $alias ):?>
<tr>
	<td><?=$alias->from_url_path?></td>
	<td><?=$alias->to_url_path?></td>
</tr>
<?endforeach?>
</table>


<div id="submenu">
<?include('content/submenu.tpl.php')?>
</div>

<h1>Node type: <?=$ct->node_type_name?></h1>

<ul>
	<li><a href="/admin<?=$GLOBALS['url']?>/add-field">Add field</a></li>
</ul>

<table border=1>
<thead>
<tr>
	<th>Machine name</th>
	<th>Title</th>
	<th>Type</th>
	<th>Mandatory?</th>
</tr>
</thead>
<tbody>
<?foreach($fields AS $f):?>
<tr>
	<td><?=$f->field_machine_name?></td>
	<td><?=$f->field_title?></td>
	<td><?=$types[$f->field_type][0]?></td>
	<td align=center><?if($f->mandatory):?>YES<?else:?>-<?endif?></td>
</tr>
<?endforeach?>
</tbody>
</table>



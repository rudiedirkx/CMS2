
<div id="submenu">
<?include('content/submenu.tpl.php')?>
</div>

<h1>Node type: <?=$ct->node_type_name?></h1>

<ul>
	<li><a href="/admin/content/type/<?=$ct->node_type?>/new">Create content</a></li>
	<li><a href="/admin/content/type/<?=$ct->node_type?>/add-field">Add field</a></li>
</ul>

<table border=1>
<thead>
<tr>
	<th>Machine name</th>
	<th>Title</th>
	<th>Type</th>
	<th>Mandatory?</th>
	<td></td>
</tr>
</thead>
<tbody>
<?foreach($fields AS $f):?>
<tr>
	<td><?=$f->field_machine_name?></td>
	<td><?=$f->field_title?></td>
	<td><?=$types[$f->field_type][0]?></td>
	<td align=center><?if($f->mandatory):?>YES<?else:?>-<?endif?></td>
	<td><a href="?del=<?=$f->id?>">del</a></td>
</tr>
<?endforeach?>
</tbody>
</table>



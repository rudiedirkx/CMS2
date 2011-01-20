
<div id="submenu">
<?include('content/submenu.tpl.php')?>
</div>

<h1>All Nodes</h1>

<table border=1>
<thead>
<tr>
	<th>ID</th>
	<th>Title</th>
	<th>Type</th>
</tr>
</thead>
<tbody>
<?foreach($nodes AS $node):?>
<tr>
	<td><a href="<?=$node->admin_url()?>"><?=$node->id?></a></td>
	<td><span style="float:right;">&nbsp; <a href="<?=$node->url()?>">&gt;&gt;</a></span> <a href="<?=$node->admin_url()?>?goto=/admin/content"><?=$node->title?></a></td>
	<td><a href="/admin/content/by-type/<?=$node->node_type?>"><?=$node->node_type_name?></a></td>
</tr>
<?endforeach?>
</tbody>
</table>


<div id="submenu">
<?include('content/submenu.tpl.php')?>
</div>

<h1>Node types</h1>

<ul>
<?foreach($cts AS $ct):?>
	<li><a href="/admin/content/type/<?=$ct->node_type?>"><?=$ct->node_type_name?></a> - (<a href="/admin/content/type/<?=$ct->node_type?>/new">new</a>)</li>
<?endforeach?>
</ul>

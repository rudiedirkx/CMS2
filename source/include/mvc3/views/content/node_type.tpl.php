
<h1>Node type: <?=$ct->node_type_name?></h1>

<ul>
<?foreach($cts AS $ct):?>
	<li><a href="/admin/content/type/<?=$ct->id?>"><?=$ct->node_type_name?></a></li>
<?endforeach?>
</ul>

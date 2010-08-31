<div id="node-<?=$node->id?>" class="node content-node node-type-<?=$node->node_type_name?> content-node-<?=$node->node_type_name?>">
	<div class="title"><h2><?=$node->title?></h2></div>
	<div class="content">
	<?foreach ( $node->_fields AS $k => $f ):?>

	<div class="field-<?=$k?>">
		<div class="field-content"><?=$node->$k?></div>
	</div>

	<?endforeach?>
	</div>
</div>

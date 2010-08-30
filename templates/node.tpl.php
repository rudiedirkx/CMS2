<div id="node-<?=$node->id?>">
	<h2><?=$node->title?></h2>
	<?foreach ( $node->_fields AS $k => $f ):?>

	<div class="field-<?=$k?>">
		<div class="field-content"><?=$node->$k?></div>
	</div>

	<?endforeach?>
</div>

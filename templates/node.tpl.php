<div id="node-<?=$node->id?>">
	<h2><?=$node->title?></h2>
	<?foreach ( $node->_fields AS $k => $f ):?>
	<div class="field-<?=$k?>">
		<span class="field-title"><?=$f?></span>
		<span class="field-content"><?=$node->$k?></span>
	</div>
	<?endforeach?>
</div>
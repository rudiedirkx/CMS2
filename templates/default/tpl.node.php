
<div class="<?if($node->is_page):?>node-is-page <?endif?>node-<?=$node->id?> node content-node node-type-<?=$node->node_type?> content-node-<?=$node->node_type?>">
	<div class="title"><h2><?=$node->title?> (<?=$node->node_type_name?>)</h2></div>
	<div class="content">
	<?foreach ( $node->_fields AS $k => $f ):?>

		<div class="field-<?=$k?>">
			<div title="<?=$f->field_title?>" class="field-content">
				<?=$node->$k?>
				<?if( 0 === strpos($k, 'ref_') ):?>
					<? $ref = $node->{substr($k, 4)} ?>
					= <?=$ref ? $ref->title : 'NULL'?>
				<?endif?>
			</div>
		</div>

	<?endforeach?>
	</div>
</div>

<div class="<?if($node->is_page):?>node-is-page <?endif?>node-<?=$node->id?>">
	<h2>Nieuws: &quot;<?=$node->title?>&quot;</h2>
	<div class="field-body">
		<?=$node->body?>
	</div>
	<pre>[<?=$node->publicationdate->format('%d %B')?>]</pre>
</div>

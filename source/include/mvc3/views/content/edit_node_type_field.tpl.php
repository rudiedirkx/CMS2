
<div id="submenu">
<?include('content/submenu.tpl.php')?>
</div>

<h1>Node type: <?=$ct->node_type_name?> | Field: <?=$field->field_title?></h1>

<form method=post action="/admin<?=$GLOBALS['url']?>save">
<fieldset>
	<legend>Gimme some details!</legend>

	<p>Field type:<br /><code class="textfield"><?=$field->field_type?></code></p>

	<p>Field machine name:<br /><code class="textfield"><?=$field->field_machine_name?></code></p>

	<p>Field title:<br /><input name="field_title" value="<?=htmlspecialchars($field->field_title)?>" /></p>

	<p>Field details / Input format:<br /><textarea name="input_format" cols="60" rows="4"><?=htmlspecialchars($field->input_format)?></textarea></p>

	<p><label><input type=checkbox name="mandatory"<?=$field->mandatory ? ' checked' : ''?> /> Mandatory?</label></p>

	<p><input type=submit value="Update" /></p>

</fieldset>
</form>



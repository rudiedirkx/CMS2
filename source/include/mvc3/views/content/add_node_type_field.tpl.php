
<div id="submenu">
<?include('content/submenu.tpl.php')?>
</div>

<h1>Node type: <?=$ct->node_type_name?> | Add field</h1>

<form method=post action="/admin<?=$GLOBALS['url']?>/save">
<fieldset>
	<legend>Gimme some details!</legend>

	<p>Field machine name:<br /><input name="field_machine_name" /></p>

	<p>Field title:<br /><input name="field_title" /></p>

	<p>Field type:<br /><select name="field_type"><?foreach($types AS $t => $td):?><option value="<?=$t?>"><?=$td[0]?></option><?endforeach?></select></p>

	<p>Field details / Input format:<br /><textarea name="input_format" cols="60" rows="4"></textarea></p>

	<p><label><input type=checkbox name="mandatory" /> Mandatory?</label></p>

	<p><input type=submit value="Insert" /></p>

</fieldset>
</form>



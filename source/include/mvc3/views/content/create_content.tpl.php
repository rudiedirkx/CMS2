
<div id="submenu">
<?include('content/submenu.tpl.php')?>
</div>

<h1>Create node: <?=$ct->node_type_name?></h1>

<form>
<fieldset>
	<legend>New content</legend>

	<p class="field">Title<span class="mandatory"> *</span>:<br><input type="text" name="f-title" value="" /></p>

	<?foreach($ct->fields AS $f):?>
	<p class="field"><?=$f->field_title?><?if($f->mandatory):?><span class="mandatory"> *</span><?endif?>:<br>
		<?if('reference'==$f->field_type):?>
			<select name="f-<?=$f->field_machine_name?>"><?if(!$f->mandatory):?><option value="">--</option><?endif?><?foreach($f->html_options AS $k => $v):?><option value="<?=$k?>"><?=$v?></option><?endforeach?></select>
		<?else:?>
			<input type="text" name="f-<?=$f->field_machine_name?>" value="" />
		<?endif?><br><span class="field-description"><?=$f->field_description?></span>
	</p>

	<?endforeach?>

	<p><input type="submit" value="Save" /></p>
</form>




<div id="submenu">
<?include('content/submenu.tpl.php')?>
</div>

<h1>New node type</h1>

<form method=post action="/admin/content/types/add/save">
<fieldset>
	<legend>What you wanna add?</legend>

	<p>Node type:<br /><input name="node_type" /></p>

	<p>Node type name:<br /><input name="node_type_name" /></p>

	<p><input type=submit value="Insert" /></p>

</fieldset>
</form>



<!DOCTYPE html>
<html>

<head>
<title>Page.tpl.php</title>
<style>
* { margin:0; padding:0; }
body { padding:10px; }
div { padding:10px; border:solid 2px green; }
#header, #footer { background:pink; }
</style>
</head>

<body>

<div id="header">
	<?$page->render_region('header')?>
</div>

<div id="content">
	<?$content->render_as_node()?>
</div>

<div id="footer">
	<?$page->render_region('footer')?>
</div>

</body>

</html>

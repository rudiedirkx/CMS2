<!DOCTYPE html>
<html>

<head>
<title>Site title</title>
<style>
* { margin:0; padding:0; }
body { padding:10px; }
div { padding:10px; border:solid 2px green; }
#wrapper { max-width:1000px; margin:0 auto; border:0; padding:0; }
div.node div.content { background:#faa; }
div.node div.title { background:#afa; }
#header, #footer { background:pink; }
</style>
</head>

<body>
<div id="wrapper">

<div id="header">
	<?$page->render_region('header')?>
</div>

<div id="content">
	<?$content->render_as_node()?>
</div>

<div id="footer">
	<?$page->render_region('footer')?>
</div>

</div>
</body>

</html>

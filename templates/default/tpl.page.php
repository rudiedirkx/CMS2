<!DOCTYPE html>
<html>

<head>
<title><?=$page->title?></title>
<style>
* { margin:0; padding:0; }
body { padding:10px; }
div { -webkit-box-sizing:border-box; padding:6px; border:solid 1px green; }
#wrapper { max-width:960px; margin:0 auto; border:0; padding:0; }
div.node div.content { background:#faa; }
div.node div.title { background:#afa; }
#wrapper .region { background:lightblue; margin-bottom:10px; }
</style>
</head>

<body>
<div id="wrapper">

	<p id="url_path"><?=implode(' => ', $url_path)?></p>

<div class="region" id="header">
	<?$page->render_region('header')?>
</div>

<div class="region" id="content">
	<?$page->render_in_page()?>
</div>

<div class="region" id="footer">
	<?$page->render_region('footer')?>
</div>

</div>
</body>

</html>

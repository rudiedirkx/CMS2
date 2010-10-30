<!DOCTYPE html>
<html>

<head>
<title><?=$page->title?></title>
<style>
* { margin:0; padding:0; }
html { overflow-y:scroll; }
body { padding:10px; font-size:14px; }
div { -webkit-box-sizing:border-box; padding:6px; border:solid 1px green; }
#wrapper { max-width:960px; margin:0 auto; border:0; padding:0; }
div.node div.content { background:#faa; }
div.node div.title { background:#afa; }
.region { background:lightblue; margin-bottom:10px; opacity:0.6; max-height:100px; overflow:hidden; font-size:11px; }
#content, .region:not(#content):hover { opacity:1.0; -webkit-box-shadow:0 0 30px #777; max-height:none; overflow:visible; font-size:14px; }
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

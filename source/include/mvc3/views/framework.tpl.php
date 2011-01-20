<!DOCTYPE html>
<html>

<head>
<title><?=$_szHtmlTitle?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?=$_szHtmlHead?>
<style>
body { font-size:14px; font-family:Arial, sans-serif; }
form p.field span.mandatory { font-weight:bold; color:red; }
form p.field span.field-description { font-size:12px; margin-left:25px; }
form p.field.error { color:red; font-size:16px; text-transform:uppercase; }
form p.field.error input, form p.field.error select, form p.field.error textarea { border-color:red; }
</style>
</head>

<body>

<div id="header">
	<ul>
		<li><a href="/admin/">Admin</a></li>
		<li><a href="/admin/content">Content</a></li>
		<li><a href="/admin/content/types">Node types</a></li>
		<li><a href="/admin/settings">Settings</a></li>
	</ul>
</div>

<?=$_szHtmlContents?>

</body>

</html>
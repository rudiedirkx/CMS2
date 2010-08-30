<?php

define('CMS2_TEMPLATE_DIR', '../templates');

require_once('../source/include/mvc3/source/include/models/db/inc.cls.db_mysqli.php');
$db = new db_mysqli('localhost', 'cms2', 'cms2', 'cms2_default');

$szUrlPath = reset(explode('?', $_SERVER['REQUEST_URI'], 2));
$url_path = array($szUrlPath);

$routes = $db->select('routes', "active = 1 ORDER BY id DESC");
foreach ( $routes AS $r ) {
	if ( 0 < preg_match($r->from_regexp, $szUrlPath) ) {
		$szUrlPath = $r->to_url_path;
		$url_path[] = $szUrlPath;
		break;
	}
}

if ( 0 < preg_match('#^/node/(\d+)/?#', $szUrlPath, $parrMatches) ) {
	$node = (int)$parrMatches[1];
}
else if ( ($page = $db->select('url_paths', "url_path = '".$db->escape($szUrlPath)."'")) ) {
	$node = (int)$page[0]->node_id;
	$url_path[] = '/node/'.$node;
}
if ( empty($node) ) {
	exit('404');
}

require_once('../source/logic/inc.cls.page.php');
require_once('../source/logic/inc.cls.node.php');
require_once('../source/logic/inc.cls.block.php');
require_once('../source/logic/inc.cls.user.php');
require_once('../source/logic/inc.cls.view.php');

$page = node::load($node);
$page->render_as_page($page);



<?php

define('CMS2_TEMPLATE_DIR', '../templates');

require_once('../source/include/mvc3/source/include/models/db/inc.cls.db_mysqli.php');
$db = new db_mysqli('localhost', 'cms2', 'cms2', 'cms2_default');

$szUrlPath = reset(explode('?', $_SERVER['REQUEST_URI'], 2));

$routes = $db->select('routes', "active = 1 ORDER BY id DESC");
foreach ( $routes AS $r ) {
	if ( 0 < preg_match($r->from, $szUrlPath) ) {
		$szUrlPath = $r->to;
		break;
	}
}

//var_dump($szUrlPath);

if ( 0 < preg_match('#^/node/(\d+)/?#', $szUrlPath, $parrMatches) ) {
	$node = (int)$parrMatches[1];
}
else if ( ($page = $db->select('url_paths', "url_path = '".$db->escape($szUrlPath)."'")) ) {
	$node = (int)$page[0]->node_id;
}
if ( empty($node) ) {
	exit('404');
}

require_once('../source/logic/inc.cls.node.php');

//echo 'Loading node '.$node."...\n";

$node = node::load($node);
$node->render_node();



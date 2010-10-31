<?php

define( 'CMS2_SCRIPT_ROOT', dirname(dirname(__FILE__)) );
define( 'CMS2_MVC3_ROOT', CMS2_SCRIPT_ROOT.'/source/include/mvc3' );

define('CMS2_TEMPLATE_DIR', '../templates/default');

require_once('cfg_db.php');

function is_system_path( $path ) {
	return 0 < preg_match('#^/(node|view|user)/(\d+)/?#', $path, $parrMatches) ? array_slice($parrMatches, 1, 2) : false;
}

function iterate_towards_system_path( $path, $with_404 = true ) {
	global $url_path;
	$url_path[] = $path;
	if ( is_array($arrPath = is_system_path($path)) ) {
		return $arrPath;
	}
	global $db;
	if ( ($page = $db->select('url_paths', "from_url_path = '".$db->escape($path)."'")) ) {
		return iterate_towards_system_path($page[0]->to_url_path, $with_404);
	}
	static $routes = null;
	if ( !isset($routes ) ) {
		$routes = $db->select('routes', "active = 1 ORDER BY o ASC, id DESC");
	}
	foreach ( $routes AS $r ) {
		if ( 0 < preg_match('#^'.$r->from_regexp.'#', $path, $parrMatches) ) {
			$parrMatches[0] = $r->to_url_path;
			array_push($parrMatches, $with_404);
			return iterate_towards_system_path(call_user_func_array('sprintf', $parrMatches));
		}
	}
	if ( $with_404 ) {
		return iterate_towards_system_path('404', false);
	}
	return false;
}

function get_system_path_object( $path ) {
	if ( !is_array($path) ) return false;
	list($class, $arg) = $path;
	$page = call_user_func(array($class, 'load'), $arg);
	return $page;
}

$x = explode('?', $_SERVER['REQUEST_URI'], 2);
if ( isset($x[1]) ) parse_str($x[1], $_GET);
$szUrlPath = $x[0];
$url_path = array();
$arrSystemPath = iterate_towards_system_path($szUrlPath);

//var_dump($arrSystemPath);
//print_r($url_path);

require_once('../source/logic/inc.cls.renderable.php');
require_once('../source/logic/inc.cls.page.php');
require_once('../source/logic/inc.cls.node.php');
require_once('../source/logic/inc.cls.block.php');
require_once('../source/logic/inc.cls.user.php');
require_once('../source/logic/inc.cls.view.php');
require_once('../source/logic/inc.cls.dateandtime.php');

/*$page = get_system_path_object($arrSystemPath);
if ( false === $page ) {
	$arrSystemPath = iterate_towards_system_path('404', false);
}*/

if ( false === $arrSystemPath || ( false === ($page = get_system_path_object($arrSystemPath)) && false === ($page = get_system_path_object(iterate_towards_system_path('404', false))) ) ) {
	exit('404 and no 404 found');
}

$page->is_page = true;
$page->render_as_page();



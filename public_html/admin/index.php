<?php

define( 'CMS2_SCRIPT_ROOT', dirname(dirname(dirname(__FILE__))) );
define( 'CMS2_MVC3_ROOT', CMS2_SCRIPT_ROOT.'/source/include/mvc3' );

require_once('mvc3_cfg_toplevel.php');
require_once('cfg_db.php');


function __autoload( $f_szClass ) {
	$class = strtolower($f_szClass);
	foreach ( array(PROJECT_MODELS, PROJECT_INCLUDE, PROJECT_CONTROLLERS) AS $dir ) {
		if ( file_exists($dir . '/inc.cls.' . $class . '.php') ) {
			require_once($dir . '/inc.cls.' . $class . '.php');
			break;
		}
	}
}


require_once( PROJECT_CONTROLLERS.'/inc.cls.__topmodule.php' );


// Fetch request URI
$url = __TopModule::getRequestUri();


// Save db layer
require_once( PROJECT_INC_DB . '/inc.cls.activerecordobject.php' );
ActiveRecordObject::setDbObject($db);


$user = new User;


try {
	$application = __TopModule::run( $url );
	$application->exec();
}
catch ( InvalidURIException $ex ) {
	exit('['.date('Y-m-d H:i:s').'] Page not found: '.$url);
}
catch ( AROException $ex ) {
	exit('['.date('Y-m-d H:i:s').'] Model error: '.$ex->getMessage());
}
catch ( DBException $ex ) {
	exit('['.date('Y-m-d H:i:s').'] Database error: '.$ex->getMessage());
}



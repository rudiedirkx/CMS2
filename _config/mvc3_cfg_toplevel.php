<?php

define( 'UTC_START',			microtime(true) );



define( 'SCRIPT_ROOT',			str_replace('\\', '/', dirname(dirname(__FILE__))) );

define( 'PROJECT_PUBLIC',		CMS2_MVC3_ROOT . '/public_html' );
define( 'PROJECT_INCLUDE',		CMS2_MVC3_ROOT . '/_source/include' );
define( 'PROJECT_MODELS',		CMS2_MVC3_ROOT . '/models' );			// M
define( 'PROJECT_VIEWS',		CMS2_MVC3_ROOT . '/views' );			// V
define( 'PROJECT_CONTROLLERS',	CMS2_MVC3_ROOT . '/controllers' );	// C
define( 'PROJECT_RESOURCES',	CMS2_MVC3_ROOT . '/_source/resources' );
define( 'PROJECT_RUNTIME',		CMS2_MVC3_ROOT . '/_source/runtime' );
define( 'PROJECT_CRONJOBS',		CMS2_MVC3_ROOT . '/_source/cronjobs' );


# include paths (3dparty apps and global apps) #
define( 'PROJECT_INC_TPL',		PROJECT_INCLUDE . '/smarty' );
define( 'PROJECT_INC_DB',		PROJECT_INCLUDE . '/db' );


# runtime paths (logs, tmp for suckureAdmin, etc) #
define( 'RUNTIME_LOGS',			PROJECT_RUNTIME . '/logs/' );


# session vars #
define( 'SESSION_NAME',			'pj_3_1' );


# project version from VERSION file #
define( 'PROJECT_VERSION',		trim(file_get_contents(SCRIPT_ROOT.'/VERSION')) );



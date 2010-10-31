<?php

class Mod_Settings extends Main_Inside
{

	protected $m_arrHooks = array(
		'/'							=> 'menu',
		'/routes'					=> 'routes',
		'/aliases'					=> 'aliases',
	);



	/**
	 * 
	 */
	protected function routes()
	{
		$routes = $this->db->select('routes', '1');
		$this->tpl->assign( 'routes', $routes);

		$this->tpl->display('settings/routes.tpl.php');

	} // END routes() */


	/**
	 * 
	 */
	protected function aliases()
	{
		$aliases = $this->db->select('url_paths', '1 ORDER BY \'404\' <> from_url_path, from_url_path');
		$this->tpl->assign( 'aliases', $aliases);

		$this->tpl->display('settings/aliases.tpl.php');

	} // END aliases() */



	/**
	 * M e n u
	 */
	protected function menu()
	{
		$this->tpl->display('settings/menu.tpl.php');

	} // END menu() */


} // END Class Mod_Settings



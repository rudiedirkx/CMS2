<?php

class __Home extends __Actual_TopModule
{

	protected $m_arrHooks = array(
		'/'					=> 'index',
		'/login'			=> 'loginForm',
		'/login/do'			=> 'loginProcess',
	);



	/**
	 * I n d e x
	 */
	protected function index()
	{
		if ( $this->user->logincheck() ) {
			header('Location: /admin/content');
			exit;
		}
		return $this->loginForm();

	} // END index() */


} // END Class __Home



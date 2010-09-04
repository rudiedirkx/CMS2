<?php

class Mod_Content extends Main_Inside
{

	protected $m_arrHooks = array(
		'/'					=> 'menu',
		'/types'			=> 'listContentTypes',
		'/type/#'			=> 'contentType',
		'/type/#/edit'		=> 'editContentType',
		'/type/#/edit/save'	=> 'saveContentType',
	);



	/**
	 * I n d e x
	 */
	protected function listContentTypes()
	{
		$cts = ARONodeType::finder()->findMany('1 ORDER BY node_type ASC');
		$this->tpl->assign( 'cts', $cts );

		$this->tpl->display('content/node_types.tpl.php');

	} // END listContentTypes() */


	/**
	 * I n d e x
	 */
	protected function contentType( $ct )
	{
		$ct = ARONodeType::finder()->byPK( $ct );
		$this->tpl->assign( 'ct', $ct );

		$this->tpl->display('content/node_type.tpl.php');

	} // END contentType() */


	/**
	 * I n d e x
	 */
	protected function editContentType( $ct )
	{
		$this->tpl->display('edit_content_type.tpl.php');

	} // END editContentType() */


	/**
	 * I n d e x
	 */
	protected function saveContentType( $ct )
	{
		print_r($_POST);

	} // END saveContentType() */



	/**
	 * I n d e x
	 */
	protected function menu()
	{
		$this->tpl->display('menu.tpl.php');

	} // END menu() */


} // END Class Mod_Content



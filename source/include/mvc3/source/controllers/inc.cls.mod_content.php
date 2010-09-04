<?php

class Mod_Content extends Main_Inside
{

	public static $field_types = array(
		'integer'		=> array('Integer', 'INTEGER'),
		'float'			=> array('Float', 'FLOAT'),
		'string'		=> array('String', 'VARCHAR(250)'),
		'multistring'	=> array('Multistring', 'TEXT'),
		'text'			=> array('Text', 'TEXT'),
		'html'			=> array('HTML', 'TEXT'),
		'date'			=> array('Date', 'DATE'),
		'time'			=> array('Time', 'TIME'),
		'dateandtime'	=> array('Date & Time', 'INTEGER'),
		'file'			=> array('File', 'VARCHAR(250)'),
		'image'			=> array('image', 'VARCHAR(250)'),
		'reference'		=> array('Node reference', 'INTEGER'),
	);

	protected $m_arrHooks = array(
		'/'							=> 'content',
		'/by-type/#'				=> 'content',

		'/types/add'				=> 'addNodeType',
		'/types/add/save'			=> 'saveNodeType',

		'/types'					=> 'listContentTypes',
		'/type/#'					=> 'contentType',
		'/type/#/edit'				=> 'editContentType',
		'/type/#/edit/save'			=> 'saveContentType',
		'/type/#/add-field'			=> 'addContentTypeField',
		'/type/#/add-field/save'	=> 'saveContentTypeField',
	);



	/**
	 * 
	 */
	protected function saveContentTypeField( $ct )
	{
		$this->mf_RequirePostVars(array(
			'field_title' => 'Field title',
			'field_machine_name' => 'Field machine name',
			'field_type' => 'Field type',
		), true, true);

		$this->mf_RequirePostVars(array(
			'input_format' => 'Field details / Input format',
		), true, false);

		if ( !isset(self::$field_types[$_POST['field_type']]) ) {
			exit('Invalid Field type');
		}
		$type = self::$field_types[$_POST['field_type']];

		if ( !$this->validate_machine_name($_POST['field_machine_name']) ) {
			exit('Invalid Field machine name');
		}

		if ( 3 > strlen(trim($_POST['field_title'])) ) {
			exit('Invalid Field title');
		}

		$arrInsert = array(
			'node_type_id' => $ct,
			'field_title' => trim($_POST['field_title']),
			'field_machine_name' => strtolower($_POST['field_machine_name']),
			'field_type' => strtolower($_POST['field_type']),
			'input_format' => strtolower($_POST['input_format']),
			'mandatory' => (int)!empty($_POST['mandatory']),
			'field_description' => '--none--',
		);

		ARONodeTypeField::finder()->insert($arrInsert);
		$this->db->query('ALTER TABLE node_data_'.$ct.' ADD COLUMN '.$arrInsert['field_machine_name'].' '.$type[1].( $arrInsert['mandatory'] ? ' NOT NULL' : '' ).';');

		$this->redirect('/admin/content/type/'.$ct);

	} // END saveContentTypeField() */


	/**
	 * 
	 */
	protected function addContentTypeField( $ct )
	{
		$ct = ARONodeType::finder()->byPK( $ct );
		$this->tpl->assign( 'ct', $ct );

		$this->tpl->assign( 'types', self::$field_types );

		$this->tpl->display('content/add_node_type_field.tpl.php');

	} // END addContentTypeField() */



	/**
	 * 
	 */
	protected function saveNodeType()
	{
		$this->mf_RequirePostVars(array(
			'node_type' => 'Node type',
			'node_type_name' => 'Node type name',
		), true, true);

		if ( !$this->validate_machine_name($_POST['node_type']) ) {
			exit('Invalid Node type');
		}

		if ( 3 > strlen(trim($_POST['node_type_name'])) ) {
			exit('Invalid Node type name');
		}

		$arrInsert = array(
			'node_type' => strtolower($_POST['node_type']),
			'node_type_name' => trim($_POST['node_type_name']),
		);

		ARONodeType::finder()->insert($arrInsert);
		$iNodeTypeId = $this->db->insert_id();
		$this->db->query('CREATE TABLE node_data_'.$iNodeTypeId.' ( node_id INTEGER UNSIGNED NOT NULL, PRIMARY KEY (node_id) );');

		$this->redirect('/admin/content/type/'.$iNodeTypeId);

	} // END saveNodeType() */


	/**
	 * 
	 */
	protected function addNodeType()
	{
		$this->tpl->display('content/add_node_type.tpl.php');

	} // END addNodeType() */



	/**
	 * 
	 */
	protected function listContentTypes()
	{
		$cts = ARONodeType::finder()->findMany('1 ORDER BY node_type ASC');
		$this->tpl->assign( 'cts', $cts );

		$this->tpl->display('content/node_types.tpl.php');

	} // END listContentTypes() */


	/**
	 * 
	 */
	protected function contentType( $ct )
	{
		$ct = ARONodeType::finder()->byPK( $ct );
		$this->tpl->assign( 'ct', $ct );

		$fields = ARONodeTypeField::finder()->findMany('node_type_id = '.$ct->id.' ORDER BY o ASC');
		$this->tpl->assign( 'fields', $fields );

		$this->tpl->assign( 'types', self::$field_types );

		$this->tpl->display('content/node_type.tpl.php');

	} // END contentType() */


	/**
	 * 
	 */
	protected function editContentType( $ct )
	{
		$this->tpl->display('edit_content_type.tpl.php');

	} // END editContentType() */


	/**
	 * 
	 */
	protected function saveContentType( $ct )
	{
		print_r($_POST);

	} // END saveContentType() */



	/**
	 * N o d e   l i s t
	 */
	protected function content( $ct = null )
	{
		$nodes = ARONode::finder()->findMany(( !$ct ? '1' : 'nodes.node_type_id = '.(int)$ct ).' ORDER BY nodes.id DESC');
		$this->tpl->assign( 'nodes', $nodes );

		$this->tpl->display('content/nodes.tpl.php');

	} // END content() */


} // END Class Mod_Content



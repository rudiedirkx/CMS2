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
		'image'			=> array('Image', 'VARCHAR(250)'),
		'reference'		=> array('Node reference', 'INTEGER'),
	);

	protected $m_arrHooks = array(
		'/'							=> 'content',
		'/by-type/*'				=> 'content',

		'/type/*/new'				=> 'addNode',
		'/type/*/insert'			=> 'insertNode',
		'/node/#'					=> 'editNode',
		'/node/#/delete'			=> 'deleteNode',
		'/node/update'				=> 'updateNode',

		'/types/add'				=> 'addNodeType',
		'/types/add/save'			=> 'saveNodeType',

		'/types'					=> 'listContentTypes',
		'/type/*'					=> 'contentType',
		'/type/*/edit'				=> 'editContentType',
		'/type/*/edit/save'			=> 'saveContentType',
		'/type/*/field/*/'			=> 'editContentTypeField',
		'/type/*/field/*/save'		=> 'updateContentTypeField',
		'/type/*/add-field'			=> 'addContentTypeField',
		'/type/*/add-field/save'	=> 'insertContentTypeField',
	);



	/**
	 * 
	 */
	protected function deleteNode( $node )
	{
		is_object($node) or $node = ARONode::finder()->byPK((int)$node);

		if ( empty($_GET['confirm']) ) {
			echo '<h1>Delete node "'.$node->title.'"?</h1>';
			exit('<p><a href="?confirm=1">CONFIRM</a> or <a href="/admin/content">cancel</a></p>');
		}

		$node->delete();
echo $this->db->error;

		$this->redirect('/admin/content');

	} // END deleteNode() */



	/**
	 * 
	 */
	protected function updateContentTypeField( $ct, $field )
	{
		is_object($ct) or $ct = ARONodeType::get($ct);
		is_object($field) or $field = $ct->getField($field);

		$data = array('mandatory' => (int)!empty($_POST['mandatory']));
		if ( isset($_POST['field_title']) && '' != trim($_POST['field_title']) ) {
			$data['field_title'] = trim($_POST['field_title']);
		}
		if ( isset($_POST['input_format']) ) {
			$data['input_format'] = $_POST['input_format'];
		}

		$this->redirect('/admin/content/type/'.$ct->node_type);

	} // END updateContentTypeField() */


	/**
	 * 
	 */
	protected function editContentTypeField( $ct, $field )
	{
		is_object($ct) or $ct = ARONodeType::get($ct);
		$this->tpl->assign( 'ct', $ct );

		is_object($field) or $field = $ct->getField($field);
		$this->tpl->assign( 'field', $field );

		$this->tpl->display('content/edit_node_type_field.tpl.php');

	} // END editContentTypeField() */



	/**
	 * 
	 */
	protected function updateNode()
	{
		$this->mf_RequirePostVars(array(
			'node_id' => 'NODE',
			'title' => 'TITLE',
		), true, true);

		$node_id = (int)$_POST['node_id'];
		$node = ARONode::finder()->byPK($node_id);
		$ct = $node->type;

		$data = $ct->validateNode($_POST, $errors = array());
		if ( false === $data ) {
			return $this->editNode($node_id, $errors);
		}

		$title = $data['title'];
		unset($data['title']);

		// save
		$update = $this->db->update('node_data_'.$ct->id, $data, 'node_id = '.$node_id);
//var_dump($update); exit;

		$goto = isset($_POST['goto']) ? $_POST['goto'] : '/admin/content/node/'.$node_id;
		$this->redirect($goto);

	} // END updateNode() */


	/**
	 * 
	 */
	protected function editNode( $node, $errors = array() )
	{
		$node = ARONode::finder()->byPK((int)$node);
		$this->tpl->assign( 'node', $node );

		$nodevalues = Node::load($node->id);
		$this->tpl->assign( 'values', !empty($_POST) ? (object)$_POST : $nodevalues );
		$this->tpl->assign( 'errors', $errors );

		$ct = $node->type;
		$ct->prepFields();
		$this->tpl->assign( 'ct', $ct );

		$this->tpl->display('content/node_form.tpl.php');
//		print_r($node);

	} // END editNode() */



	/**
	 * 
	 */
	protected function insertNode( $ct )
	{
		$ct = ARONodeType::get($ct);

		$data = $ct->validateNode($_POST, $errors);
		if ( $errors ) {
			return $this->addNode($ct, $errors);
		}

		$title = $data['title'];
		unset($data['title']);

		// save
		$node_id = ARONode::finder()->insert(array(
			'title' => $title,
			'node_type_id' => $ct->id,
		));
echo $this->db->error;
		$data['node_id'] = $node_id;
		$this->db->insert('node_data_'.$ct->id, $data);
echo $this->db->error;

		$goto = isset($_POST['goto']) ? $_POST['goto'] : '/admin/content/node/'.$node_id;
		$this->redirect($goto);

	} // END insertNode() */


	/**
	 * 
	 */
	protected function addNode( $ct, $errors = array() )
	{
		$ct = is_object($ct) ? $ct : ARONodeType::get($ct);
		$ct->prepFields();
		$this->tpl->assign( 'ct', $ct );

		$this->tpl->assign( 'values', (object)$_POST );
		$this->tpl->assign( 'errors', $errors );

		$this->tpl->display('content/node_form.tpl.php');

	} // END addNode() */



	/**
	 * 
	 */
	protected function insertContentTypeField( $ct )
	{
		$ct = ARONodeType::get($ct);

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
			'node_type_id' => $ct->id,
			'field_title' => trim($_POST['field_title']),
			'field_machine_name' => strtolower($_POST['field_machine_name']),
			'field_type' => strtolower($_POST['field_type']),
			'input_format' => strtolower($_POST['input_format']),
			'mandatory' => (int)!empty($_POST['mandatory']),
			'field_description' => '--none--',
		);

		ARONodeTypeField::finder()->insert($arrInsert);
		$this->db->query('ALTER TABLE node_data_'.$ct->id.' ADD COLUMN '.$arrInsert['field_machine_name'].' '.$type[1].( $arrInsert['mandatory'] ? ' NOT NULL' : '' ).';');

		$this->redirect('/admin/content/type/'.$ct->node_type);

	} // END insertContentTypeField() */


	/**
	 * 
	 */
	protected function addContentTypeField( $ct )
	{
		$ct = ARONodeType::get($ct);
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

		$this->redirect('/admin/content/type/'.$arrInsert['node_type']);

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
		$ct = ARONodeType::get($ct);
		$this->tpl->assign( 'ct', $ct );

		if ( isset($_GET['del']) ) {
			// remove field
			$f = null;
			foreach ( $ct->fields AS $_f ) {
				if ( (int)$_f->id === (int)$_GET['del'] ) {
					$f = $_f;
					break;
				}
			}
			if ( $f ) {
				ARONodeTypeField::finder()->deleteField($f);
			}
		}

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
		$ct = ARONodeType::get($ct);
		$this->tpl->assign( 'ct', $ct );

		$this->tpl->display('edit_content_type.tpl.php');

	} // END editContentType() */


	/**
	 * 
	 */
	protected function saveContentType( $ct )
	{
		$ct = ARONodeType::get($ct);

		print_r($_POST);

	} // END saveContentType() */



	/**
	 * N o d e   l i s t
	 */
	protected function content( $ct = null )
	{
		$nodes = ARONode::finder()->findMany(( !$ct ? '1' : 't.node_type = \''.$ct."'" ).' ORDER BY nodes.id DESC');
		$this->tpl->assign( 'nodes', $nodes );

		$this->tpl->display('content/nodes.tpl.php');

	} // END content() */


} // END Class Mod_Content



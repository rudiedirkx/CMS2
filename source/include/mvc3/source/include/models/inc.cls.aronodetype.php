<?php

class ARONodeType extends ActiveRecordObject {

	const _TABLE = 'node_types';
	const _PK = 'id';
	public static $_GETTERS = array(
//		'fields' => array( self::GETTER_MANY, true, 'ARONodeTypeField', 'id', 'node_type_id' ),
		'fields' => array( self::GETTER_FUNCTION, true, 'getFields' ),
	);


	function validateNode( $input, &$errors = array() ) {
		$output = array();
		foreach ( $this->fields AS $field ) {
			$name = $field->field_machine_name;
			$output[$name] = empty($input[$name]) ? null : (string)$input[$name];
			if ( true !== ($validity = $field->validateValue($input[$name])) ) {
				$errors[$name] = $validity;
			}
		}
		return $errors ? false : $output;
	}


	function prepFields() {
		$fields = $this->fields;
		foreach ( $fields AS &$f ) {
			$f->options = $f->parseOptions();
			if ( 'reference' == $f->field_type ) {
				$f->html_options = $this->getDbObject()->select_fields('nodes', 'id, title', 'node_type_id IN ('.implode(',', $f->options['node_types']).')');
			}
			unset($f);
		}
		return $this->fields;
	}


	public function getFields() {
		$fields = ARONodeTypeField::finder()->findMany('node_type_id = '.(int)$this->id);
		array_unshift($fields, new ARONodeTypeField(array(
			'id' => 0,
			'node_type_id' => $this->id,
			'field_machine_name' => 'title',
			'field_title' => 'Title',
			'field_description' => 'Mandatory title',
			'field_type' => 'string',
			'mandatory' => true,
			'input_format' => '',
			'input_regexp' => '',
			'o' => -1,
		)));
		return $fields;
	}


	static public function get( $ct ) {
		return self::finder()->findOne('node_type = '.self::$_db->escapeAndQuote($ct));
	}


	static public function finder( $class = __CLASS__ ) {
		return parent::finder( $class );
	}

}



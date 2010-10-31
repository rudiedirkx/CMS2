<?php

class ARONodeType extends ActiveRecordObject {

	const _TABLE = 'node_types';
	const _PK = 'id';
	public static $_GETTERS = array(
		'fields' => array( self::GETTER_MANY, true, 'ARONodeTypeField', 'id', 'node_type_id' ),
	);


	function validateNode( $input, &$errors = array() ) {
		$output = array();
		if ( !isset($input['title']) || !is_string($input['title']) || '' == $input['title'] ) {
			$errors['title'] = 'Mandatory!';
		}
		foreach ( $this->fields AS $field ) {
			$name = $field->field_machine_name;
			if ( $field->mandatory && empty($input[$name]) ) {
				$errors[$name] = 'Mandatory!';
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


	static public function get( $ct ) {
		return self::finder()->findOne('node_type = '.self::$_db->escapeAndQuote($ct));
	}


	static public function finder( $class = __CLASS__ ) {
		return parent::finder( $class );
	}

}



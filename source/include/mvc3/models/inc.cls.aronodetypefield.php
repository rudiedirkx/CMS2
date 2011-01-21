<?php

class ARONodeTypeField extends ActiveRecordObject {

	const _TABLE = 'node_type_fields';
	const _PK = 'id';
	public static $_GETTERS = array();


	function deleteField( $field ) {
		$this->getDbObject()->delete('node_type_fields', 'id = '.$field->id);
		$this->getDbObject()->query('ALTER TABLE node_data_'.$field->node_type_id.' DROP COLUMN '.$field->field_machine_name.'');
	}


	function validateValue( $value ) {
		if ( $this->mandatory && empty($value) ) {
			return 'Mandatory!';
		}
		if ( $this->input_regexp && !preg_match('#'.$this->input_regexp.'#', $value) ) {
			return 'Invalid format. Must be: '.$this->input_regexp;
		}
		$options = $this->parseOptions($this->input_format);
		switch ( $this->field_type ) {
			case 'multistring':
				if ( isset($options['options']) ) {
					$selected = array_intersect($options['options'], (array)$value);
					if ( $this->mandatory && !$selected ) {
						return 'Mandatory!';
					}
					else if ( isset($options['min']) && (int)$options['min'][0] > count($selected) ) {
						return 'Too few options selected';
					}
					else if ( isset($options['max']) && (int)$options['max'][0] < count($selected) ) {
						return 'Too many options selected';
					}
				}
			break;
			case 'integer':
				if ( (string)(int)$value !== (string)$value ) {
					return 'Invalid number';
				}
			break;
			case 'float':
				if ( !is_number($value) ) {
					return 'Invalid number';
				}
			break;
			case 'date':
				if ( !preg_match('#^\d\d\d\d\-\d\d?\-\d\d?$#', $value) ) {
					return 'Invalid date';
				}
			break;
			case 'time':
				if ( !preg_match('#^\d\d?:\d\d?(?::\d\d?)?$#', $value) ) {
					return 'Invalid time';
				}
			break;
			case 'dateandtime':
				if ( !preg_match('#^\d\d\d\d\-\d\d?\-\d\d? \d\d?:\d\d?(?::\d\d?)?$#', $value) ) {
					return 'Invalid date+time';
				}
			break;
			case 'reference':
				if ( !$this->getDbObject()->count('nodes', 'id = '.(int)$value.' AND node_type_id IN ('.implode(',', $options['node_types']).')') ) {
					return 'Invalid reference ('.(int)$value.' not found)';
				}
			break;
		}
		return true;
	}


	function parseOptions( $o = null ) {
		if ( !$o && !empty($this) ) {
			$o = $this->input_format;
		}
		if ( empty($o) ) {
			return false;
		}
		$options = array();
		foreach ( explode("\n", $o) AS $line ) {
			$x = explode('=', trim($line), 2);
			$options[$x[0]] = !isset($x[1]) ? array() : explode(',', $x[1]);
		}
		return $options;
	}


	static public function finder( $class = __CLASS__ ) {
		return parent::finder( $class );
	}

}



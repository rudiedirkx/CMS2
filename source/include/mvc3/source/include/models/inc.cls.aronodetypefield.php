<?php

class ARONodeTypeField extends ActiveRecordObject {

	const _TABLE = 'node_type_fields';
	const _PK = 'id';
	public static $_GETTERS = array();


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
			$options[$x[0]] = explode(',', $x[1]);
		}
		return $options;
	}


	static public function finder( $class = __CLASS__ ) {
		return parent::finder( $class );
	}

}



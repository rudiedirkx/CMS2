<?php

class ARONodeType extends ActiveRecordObject {

	const _TABLE = 'node_types';
	const _PK = 'id';
	public static $_GETTERS = array(
		'fields' => array( self::GETTER_MANY, true, 'ARONodeTypeField', 'id', 'node_type_id' ),
	);


	static public function get( $ct ) {
		return self::finder()->findOne('node_type = '.self::$_db->escapeAndQuote($ct));
	}


	static public function finder( $class = __CLASS__ ) {
		return parent::finder( $class );
	}

}



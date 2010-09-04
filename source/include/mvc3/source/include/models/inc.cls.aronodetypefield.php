<?php

class ARONodeTypeField extends ActiveRecordObject {

	const _TABLE = 'node_type_fields';
	const _PK = 'id';
	public static $_GETTERS = array();


	static public function finder( $class = __CLASS__ ) {
		return parent::finder( $class );
	}

}



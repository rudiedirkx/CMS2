<?php

class AROUser extends ActiveRecordObject {

	const _TABLE = 'users';
	const _PK = 'id';
	public static $_GETTERS = array();


	static public function finder( $class = __CLASS__ ) {
		return parent::finder( $class );
	}

}



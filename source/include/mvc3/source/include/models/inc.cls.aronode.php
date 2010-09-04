<?php

class ARONode extends ActiveRecordObject {

	const _TABLE = 'nodes';
	const _PK = 'id';
	public static $_GETTERS = array();


	function url() {
		return '/node/'.$this->id;
	}


	function getQuery( $where ) {
		return 'SELECT t.*, nodes.* FROM nodes, node_types t WHERE nodes.node_type_id = t.id AND '.$where;
	}

	static public function finder( $class = __CLASS__ ) {
		return parent::finder( $class );
	}

}



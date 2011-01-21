<?php

class ARONode extends ActiveRecordObject {

	const _TABLE = 'nodes';
	const _PK = 'id';
	public static $_GETTERS = array(
		'type' => array( self::GETTER_ONE, true, 'ARONodeType', 'node_type_id', 'id' ),
	);


	function delete() {
		$db = $this->getDbObject();
		$db->delete('node_data_'.$this->node_type_id, 'node_id = '.$this->id);
echo $db->error;
		return parent::delete();
	}


	function url() {
		return '/node/'.$this->id;
	}


	function admin_url() {
		return '/admin/content/node/'.$this->id;
	}


	function getQuery( $where ) {
		return 'SELECT t.*, nodes.* FROM nodes, node_types t WHERE nodes.node_type_id = t.id AND '.$where;
	}

	static public function finder( $class = __CLASS__ ) {
		return parent::finder( $class );
	}

}



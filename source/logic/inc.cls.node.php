<?php

class Node extends Page {

	static public function load( $id, $object = true ) {
		$node = $GLOBALS['db']->select('node_types t, nodes n', 't.id = n.node_type_id AND n.id = '.$id);
		if ( $node ) {
			return !$object ? $node[0] : new self($node[0]);
		}
		return false;
	}

	static public $__fields;

	static public function fields( $type ) {
		if ( empty(self::$__fields[$type]) ) {
#			self::$__fields[$type] = $GLOBALS['db']->select_fields('node_type_fields', 'field_machine_name, field_title', 'node_type_id = '.$type);
			self::$__fields[$type] = $GLOBALS['db']->select_by_field('node_type_fields', 'field_machine_name', 'node_type_id = '.$type);
		}
		return self::$__fields[$type];
	}

	public $_fields = array();

	public function __construct( $data = null ) {
		if ( null !== $data ) {
			if ( is_scalar($data) ) {
				return $this->__construct(self::load($data, false));
			}
			$this->extend((array)$data);
		}
		if ( empty($this->node_id) ) {
			$md = $GLOBALS['db']->select('node_data_'.$this->node_type_id, 'node_id = '.$this->id);
			if ( $md ) {
				$this->extend($md[0]);
			}
			$this->node_id = $this->id;
		}
		$this->save_fields();
	}

	public function save_fields() {
		$this->_fields = self::fields($this->node_type_id);
		foreach ( $this->_fields AS $k => $f ) {
			if ( in_array(strtolower($f->field_type), array('dateandtime', 'date', 'time')) ) {
				$c = $f->field_type;
				$this->$k = new $c($this->$k);
			}
		}
	}

	public function render_in_view() {
		return $this->render_in_page();
	}
	public function render_in_block() {
		return $this->render_in_page();
	}
	public function render_in_page() {
		renderable::render_with_vars( $this->in_page_template(), array('node' => $this) );
	}


	public function in_page_templates() {
		$templates = array('node-'.$this->id, 'node-type-'.$this->node_type, 'node');
		return $templates;
	}


	public function __get( $k ) {
		if ( !property_exists($this, $k) ) {
			if ( property_exists($this, 'ref_'.$k) && null !== $this->{'ref_'.$k} ) {
				$this->$k = Node::load($this->{'ref_'.$k});
			}
			else {
				$this->$k = null;
			}
		}
		return $this->$k;
	}

}



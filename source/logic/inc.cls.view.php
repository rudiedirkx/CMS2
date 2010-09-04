<?php

class View extends Page {

	static public function load( $id, $object = true ) {
		$view = $GLOBALS['db']->select('views', 'id = '.$id);
		if ( $view ) {
			return !$object ? $view[0] : new self($view[0]);
		}
		return false;
	}


	public function __construct( $data = null ) {
		if ( null !== $data ) {
			$this->extend((array)$data);
		}
	}


	public function render_in_page() {
		$results = $GLOBALS['db']->fetch($this->details, $this->result_type);
		renderable::render_with_vars( $this->in_page_template(), array('view' => $this, 'results' => $results) );
	}
	public function render_in_block() {
		return $this->render_in_page();
	}


	public function in_page_templates() {
		$templates = array('view');
		return $templates;
	}

}



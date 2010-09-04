<?php

class User extends Page {

	public $user;

	static public function load( $user ) {
		if ( !is_object($user) ) {
			$user = $GLOBALS['db']->select('users', 'id = '.(int)$user);
			if ( !$user ) {
				return false;
			}
			$user = $user[0];
		}
		return new self($user);
	}


	public function __construct( $data = null ) {
		if ( null !== $data ) {
			$this->extend((array)$data);
		}
		$this->title = $this->username;
	}


	public function render_in_view() {
		return $this->render_in_page();
	}
	public function render_in_block() {
		return $this->render_in_page();
	}
	public function render_in_page() {
		renderable::render_with_vars( $this->in_page_template(), array('user' => $this) );
	}


	public function in_page_templates() {
		$templates = array('user');
		return $templates;
	}

}



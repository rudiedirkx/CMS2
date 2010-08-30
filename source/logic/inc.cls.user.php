<?php

class User {

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

	public function __construct( $user ) {
		$this->user = $user;
	}

	public function render_as_block() {
		return $this->render();
	}

	public function render() {
		$user = $this->user;
		include($this->user_template());
	}

	public function user_templates() {
		return array('user');
	}

	public function user_template( $dir = CMS2_TEMPLATE_DIR ) {
		$templates = $this->user_templates();
		foreach ( $templates AS $t ) {
			if ( file_exists($f=$dir.'/'.$t.'.tpl.php') ) {
				return $f;
			}
		}
		return false;
	}

}



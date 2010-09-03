<?php

class Renderable {

	public function find_template( $dir, $templates ) {
		foreach ( $templates AS $t ) {
			if ( file_exists($f=$dir.'/tpl.'.$t.'.php') ) {
				return $f;
			}
		}
		return false;		
	}

	public function __get( $k ) {
		if ( !property_exists($this, $k) ) {
			return null;
		}
		return $this->$k;
	}

}



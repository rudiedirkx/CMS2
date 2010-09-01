<?php

class Date extends DateAndTime {

	public $default_format = '%Y-%m-%d';

	public function __construct( $date ) {
		if ( $date ) {
			$t = array(0, 0, 0);
			$d = explode('-', $date);
			$this->utc = mktime($t[0], $t[1], $t[2], $d[1], $d[2], $d[0]);
		}
	}

}



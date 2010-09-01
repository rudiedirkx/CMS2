<?php

class Time extends DateAndTime {

	public $default_format = '%T';

	public function __construct( $time ) {
		if ( $time ) {
			$date = date('Y-m-d');
			$t = explode(':', $time);
			$d = explode('-', $date);
			$this->utc = mktime($t[0], $t[1], $t[2], $d[1], $d[2], $d[0]);
		}
	}

}



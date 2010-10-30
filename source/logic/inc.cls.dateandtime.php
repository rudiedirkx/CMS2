<?php

class DateAndTime {

	static public function fast_format( $fmt, $utc = 0 ) {
		return strftime($fmt, $utc ? $utc : time());
	}

	public $default_format = 'Y-m-d H:i:s';

	public $utc = 0;

	public function __construct( $utc ) {
		if ( $utc ) {
			$this->utc = (int)$utc;
		}
	}

	public function __tostring() {
		return $this->format($this->default_format);
	}

	public function format( $fmt, $or = '?' ) {
		return $this->isempty() ? $or : self::fast_format($fmt, $this->utc);
	}

	public function isempty() {
		return !$this->utc;
	}

}

require_once(dirname(__FILE__).'/inc.cls.date.php');
require_once(dirname(__FILE__).'/inc.cls.time.php');



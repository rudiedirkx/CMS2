<?php

class User {

	public $user; // AROUser

	public function logincheck() {
		if ( defined('USER_ID') ) {
			return true;
		}
		$uid = 1;
		if ( 1 ) {
			$user = AROUser::finder()->byPK($uid);
			$this->user = $user;
			return true;
		}
	}

}



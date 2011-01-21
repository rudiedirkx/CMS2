<?php

class Main_Inside extends __Actual_TopModule {

	function __preload() {
		parent::__preload();
		if ( !$this->user->logincheck() ) {
			exit('access denied');
		}
	}

}



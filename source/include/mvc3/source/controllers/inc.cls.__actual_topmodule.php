<?php

class __Actual_TopModule extends __Topmodule {

	function __preload() {
		$this->db = $GLOBALS['db'];
		$this->user = $GLOBALS['user'];
		$this->tpl = new Template(CMS2_MVC3_ROOT.'/views');
	}

}



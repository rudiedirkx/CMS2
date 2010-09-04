<?php

class __Actual_TopModule extends __Topmodule {

	function __preload() {
		$this->db = $GLOBALS['db'];
		$this->user = $GLOBALS['user'];
		$this->tpl = new Template(CMS2_MVC3_ROOT.'/views');
	}


	function validate_machine_name( $name ) {
		return 0 < preg_match('/^[a-z][0-9a-z_-]{2,}$/i', $name);
	}


	function redirect( $url, $exit = true ) {
		header('Location: '.$url);
		if ( $exit && is_string($exit) ) {
			exit($exit);
		}
		else if ( $exit ) {
			exit;
		}
	}


	function mf_RequirePostVars( $f_arrVars, $f_bExit = false, $f_bRequireContent = false ) {
		if ( 0 < count($arrMissing=array_diff_key($f_arrVars, $_POST)) ) {
			$szMessage = 'Missing parameters: '.implode(', ', $arrMissing);
			if ( $f_bExit ) {
				exit($szMessage);
			}
			return $szMessage;
		}
		else if ( $f_bRequireContent ) {
			$arrMissing = array();
			foreach ( $f_arrVars AS $pkey => $lkey ) {
				if ( '' == trim($_POST[$pkey]) ) {
					$arrMissing[] = $lkey;
				}
			}
			if ( $arrMissing ) {
				$szMessage = 'Missing parameters: '.implode(', ', $arrMissing);
				if ( $f_bExit ) {
					exit($szMessage);
				}
				return $szMessage;
			}
		}
		return true;

	} // END mf_RequirePostVars() */

}



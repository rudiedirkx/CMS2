<?php

class Page {

	public function render_page() {
		$node = $this;
		include($this->page_template());
	}

	public function page_templates() {
		return array('page');
	}

	public function page_template( $dir = CMS2_TEMPLATE_DIR ) {
		$templates = $this->page_templates();
		
	}

}



<?php

class Page {

#	public $content;

	public function render_region( $region ) {
		// Fetch regions (how?) and render them (like _page and _node)
		global $db;
		$blocks = $db->select('regions r, regioned_blocks rb, blocks b', "r.region_name = ".$db->escapeAndQuote($region)." AND r.id = rb.region_id AND rb.block_id = b.id");
		foreach ( $blocks AS $block ) {
			$block = block::load($block);
			if ( $block->available($GLOBALS['url_path']) ) {
				$block->render();
			}
		}
	}

	public function render_as_page( $content ) {
#		$this->content = $content;
		$page = $this;
		include($this->page_template());
	}

	public function page_templates() {
		return array('page');
	}

	public function page_template( $dir = CMS2_TEMPLATE_DIR ) {
		$templates = $this->page_templates();
		foreach ( $templates AS $t ) {
			if ( file_exists($f=$dir.'/'.$t.'.tpl.php') ) {
				return $f;
			}
		}
		return false;
	}

}



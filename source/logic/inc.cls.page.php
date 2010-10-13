<?php

class Page extends Renderable {

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


	public function in_page_template( $dir = CMS2_TEMPLATE_DIR ) {
		$templates = $this->in_page_templates();
		return $this->find_template($dir, $templates);
	}


	public function render_as_page() {
		renderable::render_with_vars($this->as_page_template(), array(
			'page' => $this,
			'url_path' => $GLOBALS['url_path'],
		));
	}
	public function as_page_template( $dir = CMS2_TEMPLATE_DIR ) {
		$templates = $this->as_page_templates();
		return $this->find_template($dir, $templates);
	}
	public function as_page_templates() {
		return array('page');
	}


	public function extend( $data ) {
		foreach ( (array)$data AS $k => $v ) {
			$this->$k = $v;
		}
	}

}



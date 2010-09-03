<?php

class Block extends Renderable {

	static public function load( $block ) {
		if ( is_object($block) ) {
			return new self($block);
		}
		return false;
	}

	public $block;

	public function __construct( $block ) {
		$this->block = $block;
	}

	public function source() {
		$content = call_user_func(array($this->block->type, 'load'), $this->block->content_source_id);
		return $content;
	}

	public function render() {
		$source = $this->source();
		$source->render_as_block();
//		include($this->block_template());
	}

	public function block_templates() {
		$type = $this->block->type;
		return array('block-'.$type);
	}

	public function block_template( $dir = CMS2_TEMPLATE_DIR ) {
		$templates = $this->block_templates();
		foreach ( $templates AS $t ) {
			if ( file_exists($f=$dir.'/'.$t.'.tpl.php') ) {
				return $f;
			}
		}
		return false;
	}

	public function available( $url_paths ) {
		$url_paths = (array)$url_paths;
		switch ( $this->block->condition_type ) {
			case 'always':
				return true;
			case 'if_true':
				return eval($this->block->condition_value);
			case 'except_on':
			case 'only_on':
				$return = 'only_on' == $this->block->condition_type;
				foreach ( $url_paths AS $url_path ) {
					foreach ( preg_split('/(\r\n|\n|\r)/', $this->block->condition_value) AS $line ) {
echo 'match '.$url_path.' vs '.$line."";
						if ( 0 < preg_match('#^'.str_replace('*', '.+', $line).'$#', $url_path.' ') ) {
							return $return;
						}
					}
				}
				return !$return;
		}
		return false;
	}

}



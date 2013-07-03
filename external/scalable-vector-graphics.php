<?php

/**
* Scalable Vector Graphics class
* @package 		WordPress
* @subpackage 	Marginal
* @since 		Marginal 0.2
* Code from: 	Scalable Vector Graphics (SVG) v2.1.1
* URI: 			http://wordpress.org/plugins/side-matter/
* Author: 		Sterling Hamilton
* Author URI: 	http://sterlinghamilton.com
* License: 		GPLv2
*
* Scalable Vector Graphics are two-dimensional vector graphics, that can be both static and dynamic. 
* This plugin allows you to easily use them on your site.
*/

class scalable_vector_graphics {

	public function execute() {
		$this->_enable_svg_mime_type();
	}

	private function _enable_svg_mime_type() {
		add_filter( 'upload_mimes', array( &$this, 'allow_svg_uploads' ) );
	}

	public function allow_svg_uploads( $existing_mime_types = array() ) {
		return $this->_add_mime_type( $existing_mime_types );
	}

	private function _add_mime_type( $mime_types ) {
		$mime_types[ 'svg' ] = 'image/svg+xml';
		$mime_types[ 'svgz' ] = 'image/svg+xml';

		return $mime_types;
	}

}

if ( class_exists( 'scalable_vector_graphics' ) and ! isset( $scalable_vector_graphics ) ) {
	$scalable_vector_graphics = new scalable_vector_graphics();
	$scalable_vector_graphics->execute();
}

?>

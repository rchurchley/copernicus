<?php

/**
Side Matter Class v.1.0
@package 	WordPress
@subpackage 	Iconic
@since 		Iconic 2.0

Based on the Side Matter plugin by Christopher Setzer, this class allows the inclusion of Grantland-like footnotes, citations, and sidefigures.

License: GPLv2
*/

/*
Copyright (C) 2013  Christopher Setzer and Ross Churchley

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

$side_matter = new Side_Matter;

class Side_Matter {

	public $notes; // All Side Matter notes (array)
	public $notes_type; // Type of each note - cite, aside, or sidefig (array)
	public $notes_id; // Number of each note (array)

	public $note_index; // Index of current note in the above arrays (integer)
	public $note_id; // Number of current citation / aside footnote (integer)
	public $fig_id; // Number of current figure (integer)
	public $note_text; // Text of current note (string)
	
	public $class; // CSS class for Side Matter content (string)

	public function Side_Matter() { // Construct class and set defaults
		add_shortcode( 'ref', array( &$this, 'ref_shortcode' ) );
		add_shortcode( 'cite', array( &$this, 'cite_shortcode' ) );
		add_shortcode( 'sidefig', array( &$this, 'sidefig_shortcode' ) );
		add_shortcode( 'featured', array( &$this, 'featured_shortcode' ) );
		add_shortcode( 'infobox', array( &$this, 'infobox_shortcode' ) );
		add_action( 'wp_enqueue_scripts', array( &$this, 'enqueue' ) );
		add_action( 'side_matter_list_notes', array( &$this, 'list_notes' ) );
		add_action( 'side_matter_clear_note_buffer', array( &$this, 'clear_note_buffer' ) );
		add_action( 'the_post', array( &$this, 'clear_notes' ) );
		add_action( 'side_matter_featured_image', array( &$this, 'add_featured_image' ) );
		$this->note_index = 0;
		$this->note_id = 0;
		$this->fig_id = 0;
		$this->note_text = '';
		$this->class = 'side-matter'; // Used for all CSS classes; `side-matter.css` must be updated if this is modified
	}

	public function ref_shortcode( $atts, $content = null ) { // Handler for shortcode
		$post_id = get_the_id();
		$this->note_index++;
		$this->note_id++;
		$this->note_text = $content;
		
		$this->notes[$this->note_index] = $this->note_text; // Add note to array
		$this->notes_type[$this->note_index] = 'ref';
		$this->notes_id[$this->note_index] = $this->note_id;

		return "<a id='link-ref-{$post_id}-{$this->note_id}' class='{$this->class}-link' href='#ref-{$post_id}-{$this->note_id}'><sup>{$this->note_id}</sup></a>"; // Return superscript reference numeral
	}

	public function cite_shortcode( $atts, $content = null ) { // Handler for shortcode
		$post_id = get_the_id();
		$this->note_index++;
		$this->note_id++;
		$this->note_text = $content;
		
		$this->notes[$this->note_index] = $this->note_text; // Add note to array
		$this->notes_type[$this->note_index] = 'cite';
		$this->notes_id[$this->note_index] = $this->note_id;

		return "<a id='link-cite-{$post_id}-{$this->note_id}' class='{$this->class}-link' href='#cite-{$post_id}-{$this->note_id}'><sup>{$this->note_id}</sup></a>"; // Return superscript reference numeral
	}

	public function sidefig_shortcode( $atts, $content = null ) { // Handler for shortcode
		extract(shortcode_atts(array(
			'caption' => ''
    	), $atts));
		$post_id = get_the_id();
		$this->note_index++;
		$this->fig_id++;
		$this->note_text = $content;
		
		$this->notes_type[$this->note_index] = 'sidefig';
		$this->notes_id[$this->note_index] = $this->fig_id;
		if ($caption == '') {
			$this->notes[$this->note_index] = $this->note_text; // Add note to array
			return "<figure id='link-sidefig-{$post_id}-{$this->fig_id}' class='{$this->class}-link sidefig-placeholder'>{$this->note_text}</figure>";
		} else {
			$this->notes[$this->note_index] = $this->note_text . "<figcaption>{$caption}</figcaption>"; // Add note to array with caption
			return "<figure id='link-sidefig-{$post_id}-{$this->fig_id}' class='{$this->class}-link sidefig-placeholder'>{$this->note_text}<figcaption>{$caption}</figcaption></figure>";
		}
	}

	public function featured_shortcode( $atts, $content = null ) { // Handler for shortcode
		$post_id = get_the_id();
		$this->note_index++;
		$this->fig_id++;
		$this->note_text = $content;
		
		$this->notes[$this->note_index] = $this->note_text; // Add note to array
		$this->notes_type[$this->note_index] = 'featured';
		$this->notes_id[$this->note_index] = $this->fig_id;

		return "";
	}

	public function infobox_shortcode( $atts, $content = null ) { // Handler for shortcode
		$post_id = get_the_id();
		$this->note_index++;
		$this->note_text = $content;
		
		$this->notes[$this->note_index] = $this->note_text; // Add note to array
		$this->notes_type[$this->note_index] = 'infobox';
		$this->notes_id[$this->note_index] = 0;

		return "";
	}

	public function enqueue() { // Enqueue script and stylesheet
		wp_enqueue_script( 'side-matter-js', get_template_directory_uri().'/js/side-matter.js', array( 'jquery' ), null, true );
	}

	public function list_notes() {
		$post_id = get_the_id();
		if ( isset( $this->notes) ) {
			$notes_list = "";
			foreach ( $this->notes as $index => $text ) {
				$id = $this->notes_id[$index];
				$type = $this->notes_type[$index];
				if ($type == 'featured') {
					$notes_list .= "<figure class='featured-image'>{$text}</figure>";
				} elseif ($type == 'infobox') {
					$notes_list .= "<aside class='infobox'>{$text}</aside>";
				} elseif ($type == 'sidefig') {
					$notes_list .= "<figure id='{$type}-{$post_id}-{$id}' class='{$this->class} sidefig'>{$text}</figure>";
				} else {
					$notes_list .= "<aside id='{$type}-{$post_id}-{$id}' class='{$this->class}'>{$id}. {$text}<a href='#link-{$type}-{$post_id}-{$this->note_id}' class='footnote-snapback'>↩</a></aside>";
				}
			}
			$notes_list .= '</ol>';
			echo $notes_list;
		} else {
			return;
		}
	}

	public function clear_note_buffer() { // Clears the current notes array for the next post
		$this->note_index = 0;
		$this->note_text = '';
		$this->notes = array();
		$this->notes_type = array();
		$this->notes_id = array();
	}

	public function clear_notes() { // Clears the current notes array for the next post
		$this->note_id = 0;
		$this->clear_note_buffer();
	}
}
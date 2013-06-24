<?php

/**
* Side Matter Class v.1.0
* @package 		WordPress
* @subpackage 	Marginal
* @since 		Marginal 1.0
*
* Based on the Side Matter plugin by Christopher Setzer, this class allows the inclusion of Grantland-style footnotes, citations, and sidefigures.
*
* License: GPLv2
*/

$side_matter = new Side_Matter;

class Side_Matter {

	public $margin_content; // All Side Matter notes (array)
	public $content_type; // Type of each note - cite, aside, or sidefig (array)
	public $content_id; // Number of each note (array)
	public $content_index; // Index of current note in the above arrays (integer)

	public $note_id; // Number of current citation / aside footnote (integer)
	public $figure_id; // Number of current figure (integer)

	public $class; // CSS class for Side Matter content (string)

	public function Side_Matter() { // Construct class and set defaults
		add_shortcode( 'sidenote', array( &$this, 'sidenote_shortcode' ) );
		add_shortcode( 'cite', array( &$this, 'cite_shortcode' ) );
		add_shortcode( 'sidefig', array( &$this, 'sidefig_shortcode' ) );
		add_shortcode( 'infobox', array( &$this, 'infobox_shortcode' ) );
		add_shortcode( 'ref', array( &$this, 'sidenote_shortcode' ) ); // alias for Side Matter plugin compatibility

		add_action( 'side_matter_list_notes', array( &$this, 'list_notes' ) );
		add_action( 'side_matter_clear_note_buffer', array( &$this, 'clear_note_buffer' ) );
		add_action( 'the_post', array( &$this, 'clear_notes' ) );
		add_action( 'side_matter_featured_image', array( &$this, 'add_featured_image' ) );
		
		add_filter( 'side_matter_exists', array( &$this, 'side_matter_exists' ) );
		
		$this->content_index = 0;
		$this->note_id = 0;
		$this->figure_id = 0;
		$this->class = 'side-matter'; // CSS class applied to sidenotes and sidefigures
	}

	public function sidenote_shortcode( $atts, $content = null ) {
		$post_id = get_the_id();
		$this->content_index++;
		$this->note_id++;
		
		$this->margin_content[$this->content_index] =  $content; // Add note to array
		$this->content_type[$this->content_index] = 'sidenote';
		$this->content_id[$this->content_index] = $this->note_id;

		// Return superscript reference numeral
		return "<a id='link-sidenote-{$post_id}-{$this->note_id}' class='{$this->class}-link' href='#sidenote-{$post_id}-{$this->note_id}'><sup>{$this->note_id}</sup></a>"; 
	}

	function cite_shortcode( $atts, $content = null ) {
		$post_id = get_the_id();
		$this->content_index++;
		$this->note_id++;
		
		$this->margin_content[$this->content_index] = $content; // Add note to array
		$this->content_type[$this->content_index] = 'cite';
		$this->content_id[$this->content_index] = $this->note_id;

		return "<a id='link-cite-{$post_id}-{$this->note_id}' class='{$this->class}-link' href='#cite-{$post_id}-{$this->note_id}'><sup>{$this->note_id}</sup></a>"; // Return superscript reference numeral
	}

	function sidefig_shortcode( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'caption' => ''
    	), $atts));
		$post_id = get_the_id();
		$this->content_index++;
		$this->figure_id++;
		
		$this->content_type[$this->content_index] = 'sidefig';
		$this->content_id[$this->content_index] = $this->figure_id;
		if ($caption == '') {
			$this->margin_content[$this->content_index] =  $content; // Add note to array
			return "<figure id='link-sidefig-{$post_id}-{$this->figure_id}' class='{$this->class}-link sidefig-placeholder'>{$content}</figure>";
		} else {
			$this->margin_content[$this->content_index] =  $content . "<figcaption>{$caption}</figcaption>"; // Add note to array with caption
			return "<figure id='link-sidefig-{$post_id}-{$this->figure_id}' class='{$this->class}-link sidefig-placeholder'>{$content}<figcaption>{$caption}</figcaption></figure>";
		}
	}

	function list_notes() {
		$post_id = get_the_id();
		if ( isset( $this->margin_content) ) {
			$margin_content_list = "";
			foreach ( $this->margin_content as $index => $text ) {
				$id = $this->content_id[$index];
				$type = $this->content_type[$index];
				if ($type == 'sidefig') {
					$margin_content_list .= "<figure id='{$type}-{$post_id}-{$id}' class='{$this->class} sidefig'>{$text}</figure>";
				} else {
					$margin_content_list .= "<aside id='{$type}-{$post_id}-{$id}' class='{$this->class} {$type}'>{$id}. {$text}<a href='#link-{$type}-{$post_id}-{$this->note_id}' class='footnote-snapback'>↩</a></aside>";
				}
			}
			echo $margin_content_list;
		} else {
			return;
		}
	}

	function clear_note_buffer() { // Clears the margin_content array for a new section
		$this->content_index = 0;
		$this->margin_content = array();
		$this->content_type = array();
		$this->content_id = array();
	}

	function side_matter_exists() {
		return ( $this->note_id > 0);
	}

	function clear_notes() { // Clears the margin_content array and resets sidenote numbering
		$this->note_id = 0;
		$this->clear_note_buffer();
	}
}
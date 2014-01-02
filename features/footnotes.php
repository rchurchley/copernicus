<?php
/*  footnotes.php =============================================================

    A fork of Austin Sweeney's (https://defomicron.net/colophon) Civil
    Footnotes plugin with slightly altered display options. Provides the
    ability to insert footnotes with ((footnote text)).

    @package    WordPress
    @subpackage Copernicus
    @since      Copernicus 2.0

============================================================================ */


// Some important constants
define('WP_FOOTNOTES_OPEN', " ((");
define('WP_FOOTNOTES_CLOSE', "))");
define('WP_FOOTNOTES_VERSION', '1.3');

// Instantiate the class 
$swas_wp_footnotes = new swas_wp_footnotes();

// Encapsulate in a class
class swas_wp_footnotes {
	var $current_options;
	var $default_options;
	
	/**
	 * Constructor.
	 */
	function swas_wp_footnotes() {		
	
		// Define the implemented option styles		
		$this->styles = array(
			'decimal' => '1,2...10',
			'decimal-leading-zero' => '01, 02...10',
			'lower-alpha' => 'a,b...j',
			'upper-alpha' => 'A,B...J',
			'lower-roman' => 'i,ii...x',
			'upper-roman' => 'I,II...X', 
			'symbol' => 'Symbol'
		);
		
		// Hook me up
		add_action('the_content', array($this, 'process'), 11);
	}
	
	
	/**
	 * Searches the text and extracts footnotes. 
	 * Adds the identifier links and creats footnotes list.
	 * @param $data string The content of the post.
	 * @return string The new content with footnotes generated.
	 */
	function process($data) {
		global $post;

		// Check for and setup the starting number
		$start_number = (preg_match("|<!\-\-startnum=(\d+)\-\->|",$data,$start_number_array)==1) ? $start_number_array[1] : 1;
	
		// Regex extraction of all footnotes (or return if there are none)
		if (!preg_match_all("/(".preg_quote(WP_FOOTNOTES_OPEN)."|<footnote>)(.*)(".preg_quote(WP_FOOTNOTES_CLOSE)."|<\/footnote>)/Us", $data, $identifiers, PREG_SET_ORDER)) {
			return $data;
		}
		
		$display = true;
		
		$footnotes = array();
		
		$style = 'decimal';
		
		// Create 'em
		for ($i=0; $i<count($identifiers); $i++){
			// Look for ref: and replace in identifiers array.
			if (substr($identifiers[$i][2],0,4) == 'ref:'){
				$ref = (int)substr($identifiers[$i][2],4);
				$identifiers[$i]['text'] = $identifiers[$ref-1][2];
			}else{
				$identifiers[$i]['text'] = $identifiers[$i][2];
			}
			
			if (!isset($identifiers[$i]['use_footnote'])){
				// Add footnote and record the key
				$identifiers[$i]['use_footnote'] = count($footnotes);
				$footnotes[$identifiers[$i]['use_footnote']]['text'] = $identifiers[$i]['text'];
				$footnotes[$identifiers[$i]['use_footnote']]['symbol'] = ( array_key_exists( 'symbol', $identifiers[$i] ) ) ? $identifiers[$i]['symbol'] : ''; // Bugfix submitted by Greg Sullivan
				$footnotes[$identifiers[$i]['use_footnote']]['identifiers'][] = $i;
			}
		}
		
		// Footnotes and identifiers are stored in the array

		$use_full_link = false;
		if (is_feed()) $use_full_link = true;

		if (is_preview()) $use_full_link = false;

		// Display identifiers
		$datanote = ''; // Bugfix submitted by Greg Sullivan
		foreach ($identifiers as $key => $value) {
				
			$id_num = ($style == 'decimal') ? $value['use_footnote']+$start_number : $this->convert_num($value['use_footnote']+$start_number, $style, count($footnotes));
			$id_id = "fnref:".$id_num."-".$post->ID;
			$id_href = ( ($use_full_link) ? get_permalink($post->ID) : '' ) . "#fn:".$id_num."-".$post->ID;
			$id_replace = '<sup class="footnoteref" id="'.$id_id.'"><a href="'.$id_href.'" rel="footnote">'.$id_num.'</a></sup>';
			if ($display) $data = substr_replace($data, $id_replace, strpos($data,$value[0]),strlen($value[0]));
			else $data = substr_replace($data, '', strpos($data,$value[0]),strlen($value[0]));
	
	// Display the footnotes (here is where you can change the output)

		// Create each footnote
			$datanote = $datanote.'<li class="footnote" id="fn:'.$id_num.'-'.$post->ID.'">'; // You can add a class to the list item
			$datanote = $datanote.'<p>'; // Before the footnote
			$datanote = $datanote.$value['text'].'&nbsp;<a href="#'.$id_id.'"'; // The footnote (don't change this)
			$datanote = $datanote.' class="backlink" title="Jump back to footnote '.$id_num.' in the text.">'; // You can change the class or hover text
			$datanote = $datanote.'&#8617;'; // The backlink character (↩)... &#8626 (↲) is another common one
			$datanote = $datanote.'</a></p></li>'; // After the footnote
		}
		
			
	// Create the footnotes
		foreach ($footnotes as $key => $value) {
			$data = $data.'<footer class="footnotes"><ol'; // Before the footnotes
			if ($start_number != '1') $data = $data.' start="'.$start_number.'"';
			$data = $data.'>';
			$data = $data.$datanote; // Don't change this
			$data = $data.'</ol></footer>'; // After the footnotes
		
		return $data;

		}
	}
	
	function upgrade_post($data){
		$data = str_replace('<footnote>',WP_FOOTNOTES_OPEN,$data);
		$data = str_replace('</footnote>',WP_FOOTNOTES_CLOSE,$data);
		return $data;
	}
}

?>
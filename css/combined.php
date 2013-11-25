<?php
// First of all send css header
header("Content-type: text/css");

// Array of css files
$css = array(
	'http://fonts.googleapis.com/css?family=Open+Sans:400&subset=latin-ext',
	'http://fonts.googleapis.com/css?family=Open+Sans:700,400italic&subset=latin'
);

echo file_get_contents('../fonts/genericons.css');
echo file_get_contents('style.css');

// Loop the css Array
foreach ($css as $css_file) {

    // Load the content of the css file 
    $css_content = getter($css_file);

    // print the css content
    echo $css_content;
}

	function getter($url) {
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    //curl_setopt($ch, CURLOPT_POST, 1);
	    //curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
	    $data = curl_exec($ch);
	    curl_close($ch);
	    return $data;
	}
?>
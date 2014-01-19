<?php

/*  Preamble
 * 
 *  Generates (the beginning of) the HTML file for all pages. Includes
 *  html and body tags, as well as everything in the head.
 * 
 *  @package    WordPress
 *  @subpackage Copernicus
 *  @since      Copernicus 1.0
 * 
 */

?>

<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>
        <?php 
        bloginfo('name');
        wp_title('|');
        ?>
    </title>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

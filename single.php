<?php

/* Single =====================================================================
	
	The Template for displaying all single posts.
	
	@package 	WordPress
	@subpackage Copernicus
	@since 		Copernicus 1.0
	
============================================================================ */

	get_template_part('parts/html-header');
	get_template_part('parts/header'); 


	if (have_posts()) :
		while (have_posts()) : the_post();
			get_template_part('parts/content', get_post_format() );
		endwhile;
	else:
		get_template_part('parts/content', 'none' );
	endif;


	get_template_part('parts/footer');
	get_template_part('parts/html-footer');

?>
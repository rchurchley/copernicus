<?php

/* Page =======================================================================
	
	The template for displaying all pages.
	
	This is the template that displays all WordPress pages by default.
	
	@package 	WordPress
	@subpackage Copernicus
	@since 		Copernicus 1.0
	
============================================================================ */

	get_template_part('parts/preamble');
	get_template_part('parts/header');

	if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		
		<article class="post">
			<div class="post-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'copernicus' ) ); ?>
				<?php wp_link_pages( array( 'before' => '<nav class="post-pagination"><span class="post-pagination-title">' . __( 'Pages:', 'copernicus' ) . '</span>', 'after' => '</nav>' ) ); ?>
			</div>
		</article>

	<?php endwhile; 

	get_template_part('parts/footer');

?>
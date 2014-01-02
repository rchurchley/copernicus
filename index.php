<?php

/* Index ======================================================================
		
	This is the most generic template file in a WordPress theme	and one of the two required files for a theme (the other being style.css). It is used to display a page when nothing more specific matches a query.	For example, it puts together the home page when no home.php file.
	
	@package 	WordPress
	@subpackage Copernicus
	@since 		Copernicus 1.0
	
============================================================================ */

	get_template_part('parts/preamble');
	get_template_part('parts/header'); 

?>

<main>
<?php

	if (have_posts()) :
		while (have_posts()) : the_post(); ?>
			<article>
				<?php get_template_part('parts/content-templates/format', get_post_format() ); ?>
			</article>
		<?php endwhile;
	else:
		get_template_part('parts/content-templates/format', 'noposts' );
	endif;

?>
</main>

<?php
	get_template_part('parts/footer');

?>
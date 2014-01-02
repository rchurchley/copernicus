<?php

/*  Archive ===================================================================
	
	The template for displaying Archive-type pages if nothing more specific matches a query. For example, puts together date-based pages if no date.php file exists.
	
	Learn more: http://codex.wordpress.org/Template_Hierarchy
	
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
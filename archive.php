<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package 	WordPress
 * @subpackage 	Marginal
 * @since 		Marginal 1.0
 */
?>
<?php 
	get_template_part('parts/html-header');
	get_template_part('parts/header'); 
?>

<?php if (have_posts()) :
	while (have_posts()) : the_post();
		if(!get_post_format()) {
			get_template_part('parts/standard', 'listed');
		} else {
			get_template_part('parts/'.get_post_format(), 'listed');
		}
	endwhile;
else:?>
<section class="guttered">
	<h2>No posts to display</h2>
</section>
<?php endif; ?>

<?php 
	get_template_part('parts/footer');
	get_template_part('parts/html-footer'); 
?>
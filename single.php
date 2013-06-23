<?php
/**
 * The Template for displaying all single posts
 *
 * @package 	WordPress
 * @subpackage 	Marginal
 * @since 		Marginal 1.0
 */
?>

<?php get_template_part('parts/html-header'); ?>
<?php get_template_part('parts/header'); ?>

<?php if (have_posts()) :
	while (have_posts()) : the_post();
		if(!get_post_format()) {
			get_template_part('parts/standard', 'single');
		} else {
			get_template_part('parts/'.get_post_format(), 'single');
		}
	endwhile;
else:?>
<h2 class="output-message">No posts to display</h2>
<?php endif; ?>

<?php get_template_part('parts/footer'); ?>
<?php get_template_part('parts/html-footer'); ?>
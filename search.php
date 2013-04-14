<?php
/**
 * Search results page
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

<?php if ( have_posts() ): ?>
	<section class="guttered">
		<h2>Search results for '<?php echo get_search_query(); ?>'</h2>
	</section>

<?php while (have_posts()) : the_post();
		if(!get_post_format()) {
			get_template_part('parts/standard', 'listed');
		} else {
			get_template_part('parts/'.get_post_format(), 'listed');
		}
	endwhile;
else:?>
<section class="guttered">
	<h2>No search results for '<?php echo get_search_query(); ?>'</h2>
</section>
<?php endif; ?>


<?php 
	get_template_part('parts/footer');
	get_template_part('parts/html-footer'); 
?>
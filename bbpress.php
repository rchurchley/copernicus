<?php
/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file 
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

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<section id="bbpress-forums">
		<header>
		<h2><?php the_title(); ?></h2>
		</header>
	<?php the_content(); ?>
	</section>
<?php endwhile; ?>
<?php endif; ?>

<?php 
	get_template_part('parts/footer');
	get_template_part('parts/html-footer'); 
?>
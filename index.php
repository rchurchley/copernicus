<?php
/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file 
 *
 * Please see /external/starkers-utilities.php for info on Starkers_Utilities::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Iconic
 * @since 		Iconic 1.0
 */
?>

<?php get_template_part('parts/html-header'); ?>
<?php get_template_part('parts/header'); ?>

<?php if ( have_posts() ): ?>
<?php while ( have_posts() ) : the_post(); ?>
	
	<article class="<?php $category = get_the_category(); echo $category[0]->slug;?>">
		<div class="column">
			<header>
			<h2><a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate><?php the_date(); ?></time>
			</header>
		<?php if ( has_post_thumbnail() ) { add_post_thumbnail_to_margin(); } ?>
		<?php the_content(); ?>
		</div>
		<div class="margin">
			<?php do_action( 'side_matter_list_notes' ); ?>
		</div>
	</article>

<?php endwhile; ?>
<?php else: ?>
<h2>No posts to display</h2>
<?php endif; ?>

<?php get_template_part('parts/footer'); ?>
<?php get_template_part('parts/html-footer'); ?>
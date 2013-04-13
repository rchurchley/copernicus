<?php
/**
 * The template used to display Tag Archive pages
 *
 * @package 	WordPress
 * @subpackage 	Marginal
 * @since 		Marginal 1.0
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
		<?php the_content(); ?>
		</div>
		<div class="margin">
			<?php do_action( 'side_matter_list_notes' ); ?>
		</div>
	</article>
	
<?php endwhile; ?>
<?php else: ?>
<section><h2>No posts to display in <?php echo single_tag_title( '', false ); ?></h2></section>
<?php endif; ?>

<?php get_template_part('parts/footer'); ?>
<?php get_template_part('parts/html-footer'); ?>
<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package 	WordPress
 * @subpackage 	Marginal
 * @since 		Marginal 1.0
 */
?>


<?php get_template_part('parts/html-header'); ?>
<?php get_template_part('parts/header'); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<?php if( has_post_thumbnail() ) : ?>
		<section id="splash">
			<figure>
				<img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" alt=""/>
			</figure>
			<header>
				<h2><a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<p class="categories"><?php the_category(', '); ?></p>
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Page Summary") ) : endif; ?>
			</header>
		</section>
	<?php endif;?>

	<section class="<?php $category = get_the_category(); echo $category[0]->slug;?> single-page">
		<div class="column">
			<?php if( !has_post_thumbnail() ) : ?>			
				<header>
				<h2><a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				</header>
			<?php endif;?>
		<?php the_content(); ?>
		</div>
		<div class="margin">
			<?php do_action( 'side_matter_list_notes' ); ?>
		</div>
	</section>

<?php endwhile; ?>

<?php get_template_part('parts/footer'); ?>
<?php get_template_part('parts/html-footer'); ?>
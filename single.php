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

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

	<section class="<?php $category = get_the_category(); echo $category[0]->slug;?> single-post">
		<div class="column">
			<header>
			<h2><a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate><?php the_date(); ?></time>
			</header>
			<?php the_content(); ?>

			<?php if ( get_the_author_meta( 'description' ) ) : ?>
				<address rel="author">
					<?php echo get_avatar( get_the_author_meta( 'user_email' ) ); ?>
					<h3><?php echo get_the_author() ; ?></h3>
					<p><?php the_author_meta( 'description' ); ?></p>
				</address>
			<?php endif; ?>

		</div>
		<div class="margin">
			<?php do_action( 'side_matter_list_notes' ); ?>
		</div>		
	</section>
	<?php comments_template( '', true ); ?>

<?php endwhile; ?>

<?php get_template_part('parts/footer'); ?>
<?php get_template_part('parts/html-footer'); ?>
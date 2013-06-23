<?php if( has_post_thumbnail() ) : ?>
	<figure id="featured-image"><img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" alt=""/>
	<header class="summary">
		<h2><a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<p class="categories"><?php the_category(', '); ?></p>
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Summary") ) : ?>
			Default summary stuff here…
		<?php endif; ?>
	</header>
	</figure>
<?php endif;?>
<section class="<?php $category = get_the_category(); echo $category[0]->slug;?> single-post">
	<div class="column">
		
		<?php if( !has_post_thumbnail() ) : ?>

			<header>
			<h2><a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate><?php the_date(); ?></time>
			</header>

		<?php endif; ?>
			
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
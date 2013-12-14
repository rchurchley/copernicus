<article class="post">
	<h1><a href="<?php esc_url( the_permalink() ); ?>" rel="bookmark">
		<?php the_title(); ?>
	</a></h1>

	<?php if( has_post_thumbnail() ) : ?>
		<img class="alignleft" src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" alt=""/>
	<?php endif;?>

	<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'copernicus' ) ); ?>
	
</article>
<?php comments_template( '', true ); ?>

<article class="post format-image">
	<?php if( has_post_thumbnail() ) : ?>
		<figure class="post-thumbnail">
			<img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" alt=""/>
		</figure>
	<?php endif;?>
	<div class="post-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'copernicus' ) ); ?>
	</div>
</article>
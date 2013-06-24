<article>
	<div class="column">
	<?php the_content(); ?>
	</div>
	<div class="margin">
		<?php if( has_post_thumbnail() ) : ?>
			<figure id="featured-image">
				<img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" alt=""/>
			</figure>
		<?php else:?>
			<figure id="featured-image">
				<img src="<?php bloginfo('template_directory'); ?>/img/link.png" alt=""/>
			</figure>
		<?php endif;?>
	</div>
</article>
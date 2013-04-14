 <article class="link-post">
	<div class="column">
	<?php the_content(); ?>
	</div>
	<div class="thumbnail" 
	<?php if( has_post_thumbnail() ) : ?>
 		style="background-image: url('<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>');"
 	<?php endif;?>></div>
</article>


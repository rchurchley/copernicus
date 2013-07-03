<article class="short">
	<div class="column">
		<h2><a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<p class="categories"><?php the_category(', '); ?></p>
	</div>
	<div class="margin">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Short Summary") ) : endif; ?>
	</div>
</article>
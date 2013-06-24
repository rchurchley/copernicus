<section class="gallery">
	<figure>
		<?php the_content(); ?>
	</figure>
	<header>
		<h2><a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<p class="categories"><?php the_category(', '); ?></p>
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Image Summary") ) : endif; ?>
	</header>
</section>
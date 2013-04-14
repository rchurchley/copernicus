<article class="standard-post">
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
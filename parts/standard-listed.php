<article>
<?php if( get_field('post_banner_image')): ?>
	<figure class="post-banner" style="background-image:url(<?php echo get_field('post_banner_image'); ?>); background-position:<?php echo get_field('post_banner_alignment'); ?> bottom;">
	</figure>
<?php endif;?>
	<section class="post-content">
		<div class="column">
			<header>
			<h2><a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate><?php the_date(); ?></time>
			<p class="meta">— <?php the_category(', '); ?></p>
			</header>
		<?php the_content('Read more...'); ?>
		</div>

		<div class="margin <?php if (apply_filters('side_matter_exists','')) : ?>has-sidenotes<?php endif;?>">
			<?php do_action( 'side_matter_list_notes' ); ?>
		</div>
	</section>
</article>
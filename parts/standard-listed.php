<article>
<?php if( has_post_thumbnail() ) : ?>
	<figure class="featured-image-banner" style="background-image:url(<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>);">
	</figure>
<?php endif;?>
	<section>
	<div class="column">
		<header>
		<h2><a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate><?php the_date(); ?></time>
		</header>
	<?php the_content('Read more...'); ?>
	</div>

	<div class="margin <?php if ( apply_filters( 'side_matter_exists', '' ) ) : ?>has-sidenotes<?php endif;?>">
		<?php do_action( 'side_matter_list_notes' ); ?>
	</div>
	</section>
</article>
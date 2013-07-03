<article>
	<div class="column">
		<header>
		<h2><a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate><?php the_date(); ?></time>
		</header>
	<?php if( has_post_thumbnail() ) : ?>
		<figure class="sidefig-placeholder">
			<img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" alt=""/>
		</figure>
	<?php endif;?>
	<?php the_content('Read more...'); ?>
	</div>

	<div class="margin <?php if ( apply_filters( 'side_matter_exists', '' ) ) : ?>has-sidenotes<?php endif;?>">
		<?php if( has_post_thumbnail() ) : ?>
			<figure class="sidefig">
				<img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" alt=""/>
			</figure>
		<?php endif;?>

		<?php do_action( 'side_matter_list_notes' ); ?>

	</div>
</article>
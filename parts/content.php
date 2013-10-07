<article class="post">
	<h1 class="post-title"><a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark">
			<?php the_title(); ?>
	</a></h1>
	<div class="post-meta">
		<?php copernicus_post_date(); ?>
		<?php edit_post_link( __( 'Edit', 'copernicus' ), '<span class="edit-link">', '</span>' ); ?>
	</div>

	<?php if( has_post_thumbnail() ) : ?>
		<img class="alignleft" src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" alt=""/>
	<?php endif;?>

	<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'copernicus' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<nav class="post-pagination"><span class="post-pagination-title">' . __( 'Pages:', 'copernicus' ) . '</span>', 'after' => '</nav>' ) ); ?>
</article>
<?php comments_template( '', true ); ?>
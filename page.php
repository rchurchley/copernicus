<?php

/* Page =======================================================================
	
	The template for displaying all pages.
	
	This is the template that displays all WordPress pages by default.
	
	@package 	WordPress
	@subpackage Copernicus
	@since 		Copernicus 1.0
	
============================================================================ */

	get_template_part('parts/html-header');
	get_template_part('parts/header');

	if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		
		<article class="post">
			<?php if( has_post_thumbnail() ) : ?>
				<figure class="post-thumbnail">
					<img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" alt=""/>
				</figure>
			<?php endif;?>
			<header class="post-header">
				<a class="post-title" href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark">
					<?php the_title(); ?>
				</a>
				<div class="post-meta">
					<?php copernicus_post_meta(); ?>
					<?php edit_post_link( __( 'Edit', 'copernicus' ), '<span class="edit-link">', '</span>' ); ?>
				</div>
			</header>

			<div class="post-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'copernicus' ) ); ?>
				<?php wp_link_pages( array( 'before' => '<nav class="post-pagination"><span class="post-pagination-title">' . __( 'Pages:', 'copernicus' ) . '</span>', 'after' => '</nav>' ) ); ?>
			</div>
		</article>

	<?php endwhile; 

	get_template_part('parts/footer');
	get_template_part('parts/html-footer'); 

?>
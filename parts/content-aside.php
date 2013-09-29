<article class="post format-aside">
	<div class="post-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'copernicus' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<nav class="post-pagination"><span class="post-pagination-title">' . __( 'Pages:', 'copernicus' ) . '</span>', 'after' => '</nav>' ) ); ?>
	</div>
</article>
<?php comments_template( '', true ); ?>
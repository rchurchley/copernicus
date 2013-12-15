	<nav class="site-pagination">
	<?php
		global $wp_query;

		$big = 999999999; // need an unlikely integer

		echo paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages
		) );
	?>
	</nav>

	<footer id="site-footer">
		<?php if ( dynamic_sidebar('footer') ) : else : ?>
			&sect;
		<?php endif; ?>
	</footer>

	<?php wp_footer(); ?>
	</body>
</html>
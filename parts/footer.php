<?php if (get_next_posts_link() || get_previous_posts_link()) : 
	echo '<nav class="site-pagination">';
	if ( get_previous_posts_link() ) :
		previous_posts_link('&laquo; Newer Entries');
	else:
		echo '&laquo; Newer Entries';
	endif;
	echo ' — ';
	if ( get_next_posts_link() ) :
		next_posts_link('Older Entries &raquo;');
	else:
		echo 'Older Entries &raquo;';
	endif;
	echo '</nav>';
endif;?>

<footer class="colophon">
	Powered by <a href="http://www.wordpress.org">Wordpress</a>. Copernicus theme by <a href="http://rosschurchley.com">Ross Churchley</a>.
</footer>
<?php if (get_next_posts_link() || get_previous_posts_link()) : ?>
<nav id="prev-next">
	<div class="prev"><?php previous_posts_link('&laquo; Newer Entries') ?></div>
	<div class="next"><?php next_posts_link('Older Entries &raquo;','') ?></div>
</nav>
<?php endif; ?>
<footer>
	Powered by <a href="http://www.wordpress.org">Wordpress</a>. Marginal theme by <a href="http://rosschurchley.com">Ross Churchley</a>.
</footer>
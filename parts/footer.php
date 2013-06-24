<?php if (get_next_posts_link() || get_previous_posts_link()) : ?>
<nav id="prev-next">
	<ul class="menu">
		<li><?php previous_posts_link('&laquo; Newer Entries') ?></li>
		<li><?php next_posts_link('Older Entries &raquo;','') ?></li>
	</ul>
</nav>
<?php endif; ?>
<footer>
	Powered by <a href="http://www.wordpress.org">Wordpress</a>. Marginal theme by <a href="http://rosschurchley.com">Ross Churchley</a>.
</footer>
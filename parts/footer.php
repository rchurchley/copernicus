<nav id="prev-next">
	<div class="prev"><?php previous_posts_link('&laquo; Newer Entries') ?></div>
	<div class="next"><?php next_posts_link('Older Entries &raquo;','') ?></div></nav>
<footer>
	<?php 
	if ( dynamic_sidebar('footer-widgets') ) : 
	else : 
	?>
	<?php endif; ?>
</footer>
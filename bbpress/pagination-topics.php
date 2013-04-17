<?php

/**
 * Pagination for pages of topics (when viewing a forum)
 *
 * @package bbPress
 * @subpackage Marginal
 */

?>

<?php do_action( 'bbp_template_before_pagination_loop' ); ?>

<nav class="bbp-pagination">
	<?php bbp_forum_pagination_links(); ?>
</nav>

<?php do_action( 'bbp_template_after_pagination_loop' ); ?>
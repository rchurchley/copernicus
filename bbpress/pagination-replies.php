<?php

/**
 * Pagination for pages of replies (when viewing a topic)
 *
 * @package bbPress
 * @subpackage Marginal
 */

?>

<?php do_action( 'bbp_template_before_pagination_loop' ); ?>

<nav class="bbp-pagination">
		<?php bbp_topic_pagination_links(); ?>
</nav>

<?php do_action( 'bbp_template_after_pagination_loop' ); ?>

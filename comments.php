<?php

/* Comments ===================================================================

	The template for displaying comments.
	
	The area of the page that contains current comments and the comment form. 
	
	@package 	WordPress
	@subpackage Copernicus
	@since 		Copernicus 1.0

============================================================================ */

	echo '<section id="comments-list">';

		if ( post_password_required() ) :
			echo '<p>This post is password protected. Enter the password to view any comments</p>';
			echo '</section>';
			return; // Stop the rest of comments.php from being processed
		endif; 

		if ( have_comments() ) : 
			echo '<h2 class="comments-list-title">';
			comments_number();
			echo '</h2>';
			wp_list_comments( array( 'callback' => 'copernicus_comment' ) ); 
		endif;

		comment_form();

	echo '</section>';


	/* copernicus_comment -----------------------------------------------------
	 * Custom callback for displaying comments
	------------------------------------------------------------------------ */

	function copernicus_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment; 
		if ( $comment->comment_approved == '1' ): ?>

			<article id="comment-<?php comment_ID() ?>" class="comment">
				<header class="comment-header">
					<?php echo get_avatar( $comment ); ?>
					<div class="comment-meta">
						<h4><?php comment_author_link() ?></h4>
						<time>
							<a href="#comment-<?php comment_ID() ?>" pubdate>
								<?php comment_date('j M Y') ?>
							</a>
						</time>
						<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
					</div>
				</header>
				<div class="comment-content">
					<?php comment_text() ?>
				</div>
			</article>
			
		<?php endif;
	}

?>
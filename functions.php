<?php
	/**
	 * Marginal functions and definitions
	 *
 	 * @package 	WordPress
 	 * @subpackage 	Marginal
 	 * @since 		Marginal 1.0
	 */

/* ===========================================================================================
	Theme options
=========================================================================================== */

//	function marginal_admin_menus() {  
//		add_submenu_page('themes.php', 'Marginal Theme Options', 'Theme Options', 'manage_options', 'marginal_theme_options', 'marginal_theme_options_page');
//	}  
  
//	require_once( 'external/theme-options.php' );

//	add_action("admin_menu", "marginal_admin_menus"); 

	function marginal_customize_css() { ?>
		 <style type="text/css">
			body > header { background-color:<?php echo get_option('header_background_color'); ?>; }
			a { color:<?php echo get_option('hyperlink_color'); ?>; }
			button { background-color: <?php echo get_option('hyperlink_color'); ?>;}
		</style>
	<?php
	}

	add_action( 'customize_register', 'marginal_customize_register' ); 
	add_action( 'wp_head', 'marginal_customize_css');


/* ===========================================================================================
	Required external files
=========================================================================================== */

	require_once( 'external/side-matter.php' );
	require_once( 'external/scalable-vector-graphics.php' );
	require_once( 'external/add-featured-image-to-rss-feed.php' );

/* ===========================================================================================
	Add theme support for various features
=========================================================================================== */

	register_nav_menus(array('primary' => 'Primary Navigation'));
	register_nav_menus(array('secondary' => 'Secondary Navigation'));
	
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'post-formats', array( 'link', 'image' ) );

	add_theme_support( ‘bbpress’ );

	add_filter('widget_text', 'do_shortcode');

	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'start_post_rel_link');
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'adjacent_posts_rel_link');


/* ===========================================================================================
	Security
=========================================================================================== */
	function _remove_script_version( $src ){
		$parts = explode( '?', $src );
		return $parts[0];
	}
	add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
	add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );

/* ===========================================================================================
	Actions, Scripts, and Filters
=========================================================================================== */

	function untitled_list_pages() {
		return wp_list_pages('title_li=');
	}

	function marginal_script_enqueuer() {
		wp_register_style( 'screen', get_stylesheet_directory_uri().'/css/combined.php', '', '', 'screen' );
		wp_enqueue_style( 'screen' );

		wp_enqueue_script( 'side-matter-js', get_template_directory_uri().'/js/side-matter.js', array( 'jquery' ), null, true );
	}

	function remove_empty_p($content){
		return preg_replace('#<p>\s*+(<br\s*/*>)?\s*</p>#', '', $content);
	}

	add_action( 'wp_enqueue_scripts', 'marginal_script_enqueuer' );
	remove_filter( 'the_content', 'wpautop' );
	add_filter( 'the_content', 'wpautop' , 99);
	add_filter('the_content', 'remove_empty_p',100);

/* ===========================================================================================
	Shortcodes
=========================================================================================== */

	function html5_section($atts, $content = null ) {
		extract(shortcode_atts(array(
			'class' => ''
		), $atts));
		return "<section class='{$class} subsection'>".do_shortcode($content)."</section>";
	}
	add_shortcode('section', 'html5_section');

/* ===========================================================================================
	Widgets
=========================================================================================== */

	register_sidebar(array(
		'name' => 'Summary',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));

	register_sidebar(array(
		'name' => 'Short Summary',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));

	register_sidebar(array(
		'name' => 'Page Summary',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));

	register_sidebar(array(
		'name' => 'Image Summary',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));


/* ===========================================================================================
	Comments
=========================================================================================== */
	/**
	 * Enqueue threaded comments Javascript only when necessary
	 *
	 * @author Michael Preuss
	 */

	function xtreme_enqueue_comments_reply() {
		if( get_option( 'thread_comments' ) )  {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	add_action( 'comment_form_before', 'xtreme_enqueue_comments_reply' );

	/**
	 * Custom callback for outputting comments 
	 *
	 * @return void
	 * @author Keir Whitaker
	 */
	function starkers_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment; 
		?>
		<?php if ( $comment->comment_approved == '1' ): ?>	
		<article id="comment-<?php comment_ID() ?>">
			<header class="comment-author">
				<?php echo get_avatar( $comment ); ?>
				<h4><?php comment_author_link() ?></h4>
				<time><a href="#comment-<?php comment_ID() ?>" pubdate><?php comment_date('j M Y') ?></a></time>
				<p class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</p>
			</header>
			<div class="comment-body">
				<?php comment_text() ?>
			</div>
		</article>
		<?php endif;
	}
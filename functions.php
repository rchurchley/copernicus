<?php

/*  functions.php =============================================================

	Copernicus functions and definitions

	@package 	WordPress
	@subpackage Copernicus
	@since 		Copernicus 1.0

============================================================================ */


//  SETUP  ====================================================================

	/*  Initial setup ---------------------------------------------------------
		Sets up theme defaults and registers the various WordPress features that Copernicus supports:

		- RSS feed links added to <head>
		- Default core markup switched to valid HTML5 for forms
		- Post formats (see http://codex.wordpress.org/Post_Formats)
		- Post thumbnails

		@uses add_theme_support() To add support for automatic feed links, post formats, and post thumbnails.
		@uses register_nav_menu() To add support for a navigation menu.
		@uses set_post_thumbnail_size() To set a custom post thumbnail size.

		@since Copernicus 1.0

		@return void
	------------------------------------------------------------------------ */

	function copernicus_setup() {

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
		add_theme_support( 'post-formats', array('aside','image', 'link') );
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 768 );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menu( 'primary', __( 'Navigation Menu', 'copernicus' ) );
		register_nav_menu( 'secondary', __( 'Secondary Menu', 'copernicus' ) );
	}
	add_action( 'after_setup_theme', 'copernicus_setup' );


	/*  Scripts and Styles ----------------------------------------------------
		Enqueues scripts and styles for the front end:
		
		- JavaScript for pages with threaded comments
		- Theme-specific JavaScript
		- Main stylesheet

		@since Copernicus 1.0

		@return void
	------------------------------------------------------------------------ */

	function copernicus_scripts_styles() {

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) :
			wp_enqueue_script( 'comment-reply' );
		endif;

		wp_enqueue_script( 'copernicus-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '2013-07-18', true );
		wp_enqueue_style( 'copernicus-genericons', get_stylesheet_directory_uri().'/fonts/genericons.css', array(), '2013-08-12' );
		wp_enqueue_style( 'copernicus-style', get_stylesheet_directory_uri().'/css/style.css', array(), '2013-08-12' );
	}
	add_action( 'wp_enqueue_scripts', 'copernicus_scripts_styles' );


	/*  More Theme Support ----------------------------------------------------
		Sets content width, and adds support for SVG uploads and custom headers
	------------------------------------------------------------------------ */

		if ( ! isset( $content_width ) )
			$content_width = 604;

		function copernicus_mime_types( $mimes ){
			$mimes['svg'] = 'image/svg+xml';
			return $mimes;
		}
		add_filter( 'upload_mimes', 'copernicus_mime_types' );
	
		require_once( 'external/add-featured-image-to-rss-feed.php' );


	/*  Simplify <head> -------------------------------------------------------
		Removes version and pointless links from <head> for security and simplicity. Removes version queries from script and style requests to improve caching.
	------------------------------------------------------------------------ */
	
		function copernicus_remove_version() {
			return '';  
		}
		add_filter('the_generator', 'copernicus_remove_version'); 

		function _remove_script_version( $src ){
			$parts = explode( '?', $src );
			return $parts[0];
		}
		add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
		add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );

		remove_action('wp_head', 'wlwmanifest_link');
		remove_action('wp_head', 'rsd_link');

		remove_action('wp_head', 'start_post_rel_link', 10, 0 );
		remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);


/*  THEME OPTIONS ========================================================== */

	require_once( 'external/theme-options.php' );

	function marginal_customize_css() { ?>
		 <style type="text/css">
			.site-title { 
				background-color:<?php echo get_option('header_background_color'); ?>; 
			}
			a {
				color:<?php echo get_option('hyperlink_color'); ?>; 
			}
			.comment-form #submit { 
				background-color: <?php echo get_option('hyperlink_color'); ?>;
			}
		</style>
	<?php
	}

	add_action( 'customize_register', 'marginal_customize_register' ); 
	add_action( 'wp_head', 'marginal_customize_css');


/*  CUSTOM THEME CALLBACKS ================================================= */

	if ( ! function_exists( 'copernicus_entry_meta' ) ) :

		function copernicus_post_meta() {

			copernicus_entry_date();

			$categories_list = get_the_category_list( __( ', ', 'copernicus' ) );
			if ( $categories_list ) {
				echo '<span class="categories-links">' . $categories_list . '</span>';
			}

			$tag_list = get_the_tag_list( '', __( ', ', 'copernicus' ) );
			if ( $tag_list ) {
				echo '<span class="tags-links">' . $tag_list . '</span>';
			}

			// Post author
			if ( 'post' == get_post_type() ) {
				printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					esc_attr( sprintf( __( 'View all posts by %s', 'copernicus' ), get_the_author() ) ),
					get_the_author()
				);
			}
		}

	endif;

	/*  Date ------------------------------------------------------------------
		Prints HTML with date information for current post.
	
		@since Copernicus 1.0
	
		@param boolean $echo Whether to echo the date. Default true.
		@return string The HTML-formatted post date.
	------------------------------------------------------------------------ */

	if ( ! function_exists( 'copernicus_entry_date' ) ) :

		function copernicus_entry_date( $echo = true ) {
			if ( has_post_format( array( 'chat', 'status' ) ) )
				$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'copernicus' );
			else
				$format_prefix = '%2$s';

			$date = sprintf( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
				esc_url( get_permalink() ),
				esc_attr( sprintf( __( 'Permalink to %s', 'copernicus' ), the_title_attribute( 'echo=0' ) ) ),
				esc_attr( get_the_date( 'c' ) ),
				esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
			);

			if ( $echo )
				echo $date;

			return $date;
		}

	endif;

	/*  Link ------------------------------------------------------------------
	 	@uses get_url_in_content() to get the URL in the post meta (if it exists)
	 	or the first link found in the post content.
		
	 	Falls back to the post permalink if no URL is found in the post.
		
	 	@since Copernicus 1.0
	 	@return string The Link format URL.
	------------------------------------------------------------------------ */

		function copernicus_get_link_url() {
			$content = get_the_content();
			$has_url = get_url_in_content( $content );

			return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
		}
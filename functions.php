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
		add_theme_support( 'custom-header', array(
			'width'         => 50,
			'height'        => 50,
			'default-image' => get_template_directory_uri() . '/img/header.jpg',
			'uploads'		=> true,
		) );
		set_post_thumbnail_size( 688 );

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

		wp_enqueue_script( 'copernicus-navcollapse', get_template_directory_uri() . '/components/responsive-nav.min.js', '2013-07-18', true );
		wp_enqueue_style( 'copernicus-navcollapsecss', get_template_directory_uri().'/components/responsive-nav.css', array(), '2013-08-12' );
		wp_enqueue_style( 'copernicus-style', get_template_directory_uri().'/css/style.css', array(), '2013-08-12' );
	}
	add_action( 'wp_enqueue_scripts', 'copernicus_scripts_styles' );

/*  Shortcodes ---------------------------------------------------------------
		Provides [foldable] foo [/foldable] shortcode. On page load, all content except <h2> tags will be hidden. When a <h2> is clicked, all content between it and the next <h2> tag will slide out. 
	------------------------------------------------------------------------ */

	function foldable_shortcode( $atts, $content = null ) {
		return '<section class="foldable">' . $content . '</section>';
	}
	add_shortcode( 'foldable', 'foldable_shortcode' );


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
	
		require_once( 'components/add-featured-image-to-rss-feed.php' );


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

	require_once( 'components/theme-options.php' );





/*  CUSTOM THEME CALLBACKS ================================================= */

	if ( ! function_exists( 'copernicus_post_date' ) ) :

		function copernicus_post_date() {

			$date = sprintf( '<time class="post-date" datetime="%1$s">%2$s</time>',
				esc_attr( get_the_date( 'c' ) ),
				get_the_date() 
			);

			echo $date;
			
			if( (get_the_modified_time( 'U' ) - get_the_time( 'U' )) > 1*60*60*24 ) {
				$updated = sprintf( '<time class="post-updated" datetime="%1$s">%2$s</time>',
					esc_attr( get_the_modified_date( 'c' ) ),
					get_the_modified_date() 
				);

				echo $updated;
			}

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
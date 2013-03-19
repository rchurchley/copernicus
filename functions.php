<?php
	/**
	 * Starkers functions and definitions
	 *
	 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
	 *
 	 * @package 	WordPress
 	 * @subpackage 	Starkers
 	 * @since 		Starkers 4.0
	 */

/* ===========================================================================================
	Required external files
=========================================================================================== */

	require_once( 'external/starkers-utilities.php' );
	require_once( 'external/side-matter.php' );

/* ===========================================================================================
	Add theme support for various features
=========================================================================================== */

	add_theme_support('post-thumbnails');
	register_nav_menus(array('primary' => 'Primary Navigation'));

/* ===========================================================================================
	Widgets in the footer
=========================================================================================== */

	function footer_widgets_init() {

		register_sidebar( array(
			'name' => 'Footer',
			'id' => 'footer-widgets',
			'before_widget' => '<section>',
			'after_widget' => '</section>',
			'before_title' => '<h2>',
			'after_title' => '</h2>',
		) );
	}
	add_action( 'widgets_init', 'footer_widgets_init' );

/* ===========================================================================================
	Customize header and links
=========================================================================================== */

	function iconic_customize_register($wp_customize) {
		// SETTINGS
		$wp_customize->add_setting( 'header_background_color' , array(
			'default'     => '#073642',
			'type' => 'option',
			'transport'   => 'refresh',
		) );

		$wp_customize->add_setting( 'hyperlink_color' , array(
			'default'     => '#DC322F',
			'type' => 'option',
			'transport'   => 'refresh',
		) );

		// CONTROLS
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_background_color', array(
			'label'      => __( 'Header Background Color', 'iconic' ),
			'section'    => 'colors',
			'settings'   => 'header_background_color',
		) ) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'hyperlink_color', array(
			'label'      => __( 'Link Color', 'iconic' ),
			'section'    => 'colors',
			'settings'   => 'hyperlink_color',
		) ) );
	}
	 add_action( 'customize_register', 'iconic_customize_register' ); 
	function iconic_customize_css() {
    ?>
         <style type="text/css">
             body > header { background-color:<?php echo get_option('header_background_color'); ?>; }
             a { color:<?php echo get_option('hyperlink_color'); ?>; }
         </style>
    <?php
	}
	add_action( 'wp_head', 'iconic_customize_css');

/* ===========================================================================================
	Actions and Filters
=========================================================================================== */

	add_action( 'wp_enqueue_scripts', 'starkers_script_enqueuer' );

	add_filter( 'body_class', array( 'Starkers_Utilities', 'add_slug_to_body_class' ) );

	function add_post_thumbnail_to_margin() {
		ob_start(); 
		the_post_thumbnail();
    	$thumbnail_shortcode = "[featured]". ob_get_contents() ."[/featured]";
    	ob_end_clean();
		do_shortcode($thumbnail_shortcode);
	}

/* ===========================================================================================
	New section for a page
=========================================================================================== */

	function html5_section($atts) {
	    extract(shortcode_atts(array(
			'class' => ''
    	), $atts));
    	ob_start(); // normally 
    		do_action('side_matter_list_notes');
    		do_action('side_matter_clear_note_buffer');
    		$notes_buffer = ob_get_contents();
    	ob_end_clean();
		return "</div><div class='margin'>".$notes_buffer."</div></section><section class='{$class}'><div class='column'>";
	}
	add_shortcode('section', 'html5_section');

/* ===========================================================================================
	Scripts
=========================================================================================== */

	/**
	 * Add scripts via wp_head()
	 *
	 * @return void
	 * @author Keir Whitaker
	 */

	function starkers_script_enqueuer() {
		wp_register_script( 'site', get_template_directory_uri().'/js/site.js', array( 'jquery' ) );
		wp_enqueue_script( 'site' );

		wp_register_style( 'screen', get_stylesheet_directory_uri().'/style.css', '', '', 'screen' );
        wp_enqueue_style( 'screen' );
	}	

/* ===========================================================================================
	Comments
=========================================================================================== */

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
			<header>
				<?php echo get_avatar( $comment ); ?>
				<h4>#<?php comment_ID() ?> – <?php comment_author_link() ?></h4>
				<time><a href="#comment-<?php comment_ID() ?>" pubdate><?php comment_date() ?> at <?php comment_time() ?></a></time>
			</header>
			<div class="column">
				<?php comment_text() ?>
			</div>
		</article>
		<?php endif;
	}
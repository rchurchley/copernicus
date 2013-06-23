<?php
	/**
	 * Marginal functions and definitions
	 *
 	 * @package 	WordPress
 	 * @subpackage 	Marginal
 	 * @since 		Marginal 1.0
	 */

/* ===========================================================================================
	Required external files
=========================================================================================== */

	require_once( 'external/side-matter.php' );

/* ===========================================================================================
	Add theme support for various features
=========================================================================================== */

	function untitled_list_pages() {
		return wp_list_pages('title_li=');
	}
	register_nav_menus(array('primary' => 'Primary Navigation'));
	register_nav_menus(array('secondary' => 'Secondary Navigation'));
	
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'post-formats', array( 'link' ) );

	add_theme_support( ‘bbpress’ );

	add_filter('widget_text', 'do_shortcode');

/* ===========================================================================================
	Actions, Scripts, and Filters
=========================================================================================== */

	function marginal_script_enqueuer() {
		wp_register_style( 'screen', get_stylesheet_directory_uri().'/style.css', '', '', 'screen' );
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
		'name' => 'Page Summary',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));

/* ===========================================================================================
	Theme customizations
=========================================================================================== */

	function marginal_customize_register($wp_customize) {
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

		$wp_customize->add_setting( 'headline_font' , array(
			'default'     => 'adelle, Palatino, serif',
			'type' => 'option',
			'transport'   => 'refresh',
		) );

		$wp_customize->add_setting( 'body_font' , array(
			'default'     => 'source-sans-pro, "Source Sans Pro", sans-serif',
			'type' => 'option',
			'transport'   => 'refresh',
		) );

		$wp_customize->add_setting( 'short_categories' , array(
			'default'     => '',
			'type' => 'option',
			'transport'   => 'refresh',
		) );

		// SECTIONS
		$wp_customize->add_section( 'fonts' , array(
		    'title'      => __('Fonts','marginal'),
		    'priority'   => 30,
		) );

		$wp_customize->add_section( 'layout' , array(
		    'title'      => __('Layout','marginal'),
		    'priority'   => 30,
		) );

		// CONTROLS
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_background_color', array(
			'label'      => __( 'Header Background Color', 'marginal' ),
			'section'    => 'colors',
			'settings'   => 'header_background_color',
		) ) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'hyperlink_color', array(
			'label'      => __( 'Link Color', 'marginal' ),
			'section'    => 'colors',
			'settings'   => 'hyperlink_color',
		) ) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'headline_font', array(
			'label'      => __( 'Headline Font', 'marginal' ),
			'section'    => 'fonts',
			'settings'   => 'headline_font',
		) ) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'body_font', array(
			'label'      => __( 'Body Font', 'marginal' ),
			'section'    => 'fonts',
			'settings'   => 'body_font',
		) ) );

		$wp_customize->add_control( 'short_categories', array(
			'type' => 'checkbox',
			'label' => 'Shorten Category pages',
			'section' => 'layout',
    	) );
	}

	function marginal_customize_css() {
    ?>
         <style type="text/css">
            body > header { background-color:<?php echo get_option('header_background_color'); ?>; }
            a { color:<?php echo get_option('hyperlink_color'); ?>; }
            button { background-color: <?php echo get_option('hyperlink_color'); ?>;}
            body { font-family:<?php echo get_option('body_font'); ?>; }
			header, h1, h2, h3, h4, th, dt, .menu { font-family: <?php echo get_option('headline_font'); ?>; }
         </style>
    <?php
	}
	add_action( 'customize_register', 'marginal_customize_register' ); 
	add_action( 'wp_head', 'marginal_customize_css');

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
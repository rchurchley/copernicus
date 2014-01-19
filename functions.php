<?php

/*  functions.php
 *
 *  Copernicus functions and definitions.

 *  @package    WordPress
 *  @subpackage Copernicus
 *  @since      Copernicus 1.0
 *
 */


/*  Setup
 *
 *   Sets up theme defaults and registers the various WordPress features that 
 *   Copernicus supports:
 * 
 *   - RSS feed links added to preamble
 *   - Default core markup switched to valid HTML5 for forms
 *   - Post formats (see http://codex.wordpress.org/Post_Formats)
 *   - Post thumbnails
 *   - Header icon
 * 
 *   @uses add_theme_support() To add support for automatic feed links, post 
 *   formats, and post thumbnails.
 *   @uses register_nav_menu() To add support for a navigation menu.
 *   @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 * 
 *   @since Copernicus 1.0
 *
 */

function copernicus_setup()
{
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list'));
    add_theme_support('post-formats', array('aside','image', 'link'));
    add_theme_support('post-thumbnails');
    add_theme_support('custom-header', array(
        'width'         => 50,
        'height'        => 50,
        'default-image' => get_template_directory_uri() . '/img/header.png',
        'uploads'       => true,
       ));

    set_post_thumbnail_size(688);

    register_nav_menu('primary', __('Navigation Menu', 'copernicus'));

}

add_action('after_setup_theme', 'copernicus_setup');


/*  Scripts and styles
 * 
 *  Enqueues scripts and styles for the front end:
 *   
 *  - JavaScript for pages with threaded comments
 *  - Theme-specific JavaScript
 *  - Main stylesheet
 * 
 *  @since Copernicus 1.0
 *
 */

function copernicus_scripts_styles()
{
    wp_enqueue_script(
        'copernicus-responsive-nav',
        get_template_directory_uri() . '/features/responsive-nav.min.js'
    );
    wp_enqueue_style(
        'copernicus-style',
        get_template_directory_uri().'/css/main.css'
    );
}

function copernicus_colourize()
{
    wp_enqueue_style(
        'copernicus-colours',
        get_template_directory_uri().'/css/colour.css'
    );
}

add_action('wp_enqueue_scripts', 'copernicus_scripts_styles');
add_action('wp_enqueue_scripts', 'copernicus_colourize');


/*  WordPress enhancements
 * 
 *  Enables two things that WordPress doesn't have out of the box: SVG support
 *  and featured images in RSS feeds.
 *
 *  @since Copernicus 1.0
 *
 */

function copernicus_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

add_filter('upload_mimes', 'copernicus_mime_types');

require_once('features/add-featured-image-to-rss-feed.php');


/*  Simplifications
 * 
 *  Removes version and pointless links from head for security and simplicity.
 *  Removes version queries from script and style requests to improve caching.
 *  Removes comment-related widgets because Copernicus supports neither
 *  neither comments nor widgets, and the Recent Comments widget injects
 *  pointless CSS into every page.
 *
 *  @since Copernicus 1.0
 *
 */

function copernicus_remove_version()
{
    return '';
}

function _remove_script_version($src)
{
    $parts = explode('?', $src);
    return $parts[0];
}

function copernicus_head_cleanup()
{
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'start_post_rel_link');
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

    // Absurdly, WordPress does not seem to provide a way to remove just the comments feed
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'feed_links_extra', 3);
    add_action('wp_head', 'add_back_post_feed');
}

function add_back_post_feed()
{
    echo (
        '<link rel="alternate" type="application/rss+xml"'
        .' title="'.get_bloginfo('name')
        .' Feed" href="'.get_bloginfo('rss2_url')
        .'" />'
        );
}

add_filter('the_generator', 'copernicus_remove_version');
add_filter('script_loader_src', '_remove_script_version', 15, 1);
add_filter('style_loader_src', '_remove_script_version', 15, 1);
add_action('init', 'copernicus_head_cleanup');

function unregister_default_widgets()
{
    unregister_widget('WP_Widget_Recent_Comments');
}

add_action('widgets_init', 'unregister_default_widgets', 11);


/*  Custom fields
 * 
 *  Provides fields to credit others for content or inspiration for a post.
 *
 *  @uses Advanced Custom Fields plugin (http://www.advancedcustomfields.com)
 *
 *  @since Copernicus 2.0
 *
 */

if (!class_exists('acf')) {
    define('ACF_LITE', true);
    include_once('features/advanced-custom-fields/acf.php');
}

if (function_exists("register_field_group")) {
    register_field_group(array(
        'id' => 'acf_attribution',
        'title' => 'Attribution',
        'fields' => array(
            array(
                'key' => 'field_52ad5454e45ad',
                'label' => 'Credits',
                'name' => 'credits',
                'type' => 'textarea',
                'instructions' => 'Acknowledge your sources',
                'default_value' => '',
                'placeholder' => '',
                'maxlength' => '',
                'formatting' => 'html',
           ),
            array(
                'key' => 'field_52ad562fe45ae',
                'label' => 'Photo credits',
                'name' => 'photo_credits',
                'type' => 'textarea',
                'instructions' => 'Acknowledge the creator of any photos you\'ve used',
                'default_value' => '',
                'placeholder' => '',
                'maxlength' => '',
                'formatting' => 'html',
           ),
       ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'post',
                    'order_no' => 0,
                    'group_no' => 0,
               ),
           ),
       ),
        'options' => array(
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array(
           ),
       ),
        'menu_order' => 0,
    ));
}


/*  Link callback
 * 
 *  @uses get_url_in_content() to get the URL in the post meta (if it exists)
 *  or the first link found in the post content.
 *  
 *  Falls back to the post permalink if no URL is found in the post.
 *
 *  @since Copernicus 1.0
 *  @return string The Link format URL.
 *
 */
    
function copernicus_get_link_url()
{
    $content = get_the_content();
    $has_url = get_url_in_content($content);

    return ($has_url) ? $has_url : apply_filters('the_permalink', get_permalink());
}

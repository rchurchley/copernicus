<?php

/*  Featured Image RSS
 *
 *   Adds the featured image attached to your posts to the RSS feed.
 * 
 *   @package        WordPress
 *   @subpackage     Copernicus
 *   @since          Copernicus 1.0
 *   Code from:      Add featured image to RSS feed (plugin)
 *   URI:            http://www.tacticaltechnique.com/wordpress/
 *   Author:         Corey Salzano
 *   Author URI:     http://twitter.com/salzano
 * 
 */

function add_featured_image_to_feed($content)
{
    global $post;
    if (has_post_thumbnail($post->ID)) {
        $content = '' . get_the_post_thumbnail($post->ID, 'large') . '' . $content;
    }
    return $content;
}

add_filter('the_excerpt_rss', 'add_featured_image_to_feed', 1000, 1);
add_filter('the_content_feed', 'add_featured_image_to_feed', 1000, 1);

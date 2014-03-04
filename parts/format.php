<?php

/*  Post Template: Default
 * 
 *  The default template for displaying the content of a single post.
 * 
 *  @package    WordPress
 *  @subpackage Copernicus
 *  @since      Copernicus 1.0
 * 
 */

if (has_post_thumbnail()) {
    ?>
    <main class="has-banner">
    <img class="banner" src="<?php 
        echo esc_url(wp_get_attachment_url(get_post_thumbnail_id()));
    ?>" alt="" />
    <?php
} else {
    ?>
    <main>
    <?php
}
?>

<h1><?php the_title(); ?></h1>

<?php

the_content();

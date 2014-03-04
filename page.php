<?php

/*  Page
 *
 *  The template for displaying all WordPress pages by default.
 *  
 *  @package    WordPress
 *  @subpackage Copernicus
 *  @since      Copernicus 1.0
 *
 */

    get_template_part('parts/preamble');
    get_template_part('parts/header');

if (have_posts()) {
    while (have_posts()) {
        the_post();
        if (has_post_thumbnail()) {
            ?>
            <main class="has-banner page">
            <img class="banner" src="<?php 
                echo esc_url(wp_get_attachment_url(get_post_thumbnail_id()));
            ?>" alt="" />
            <?php
        } else {
            ?>
            <main class="page">
            <?php
        }

        the_content();
    }
}

?>
</main>

<?php
    get_template_part('parts/footer');
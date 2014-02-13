<?php

/*  Post Template: Image
 * 
 *  The template for displaying the content of a single post with the image
 *  format.
 * 
 *  @package    WordPress
 *  @subpackage Copernicus
 *  @since      Copernicus 1.0
 * 
 */

?>

<figure class="format-image">
<?php

if (has_post_thumbnail()) {
    ?>
    <img src="<?php
        echo esc_url(wp_get_attachment_url(get_post_thumbnail_id()));
    ?>" alt="" />
    <?php 
}

?>

    <figcaption>
        <?php the_content(); ?>
    </figcaption>
</figure>

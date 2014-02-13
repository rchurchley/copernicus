<?php

/*  Post Template: Default (Listed)
 * 
 *  The default template for displaying a post on an archive page.
 * 
 *  @package    WordPress
 *  @subpackage Copernicus
 *  @since      Copernicus 1.0
 * 
 */

?>

<article>
<?php
if (has_post_thumbnail()) {
    ?>
    <img class='thumbnail' src='<?php 
        echo esc_url(wp_get_attachment_thumb_url(get_post_thumbnail_id()));
        ?>' width="75" height="75" alt="" />
    <?php
}

?>

<h1><a href="<?php 
        echo esc_url(the_permalink());
    ?>" rel="bookmark">
    <?php the_title(); ?>
</a></h1>

<?php
    the_excerpt();
?>
</article>

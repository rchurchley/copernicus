<?php

/*  Single
 * 
 *  The template for displaying all single posts.
 * 
 *  @package    WordPress
 *  @subpackage Copernicus
 *  @since      Copernicus 1.0
 * 
 */

    get_template_part('parts/preamble');
    get_template_part('parts/header');

?>

<main>
<?php

if (have_posts()) {
    while (have_posts()) {
        the_post();
        get_template_part('parts/format', get_post_format());
        get_template_part('parts/meta', get_post_format());
    }
}

?>
</main>

<?php
    get_template_part('parts/footer');

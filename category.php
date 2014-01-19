<?php

/*  Category Template: Default
 *
 *  The template for displaying Category pages by default, unless overridden
 *  per category by Custom Category Templates. Currently identical to
 *  archive.php.
 *
 *  Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 *  @package    WordPress
 *  @subpackage Copernicus
 *  @since      Copernicus 2.0
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
        ?>
        <article>
            <?php get_template_part('parts/content-templates/format', get_post_format()); ?>
        </article>
        <?php 
    }
} else {
    ?>
    <h1>There's nothing here.</h1>
    <?php
}

?>
</main>

<?php
    get_template_part('parts/footer');

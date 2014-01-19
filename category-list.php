<?php

/*  Category Template: List
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
$current_cat = get_query_var('cat');
$categories = get_categories(array( 'child_of' => $current_cat ));

foreach ($categories as $category) {
    ?>
    <section class="category">
    <h1><?php echo $category->name; ?></h1>
    <?php
    query_posts(array('category_name' => $category->slug, 'posts_per_page' => -1));

    if (have_posts()) {
        ?>
        <ul>
        <?php 
        while (have_posts()) {
            the_post();
            ?>
            <li>
                <?php the_title(); ?>
            </li>
            <?php
        }
        ?>
        </ul>
        <?php
    } else {
        ?>
        <h1>There's nothing here.</h1>
        <?php
    }

    ?>
    </section>
    <?php 
}
?>
</main>

<?php
    get_template_part('parts/footer');

<?php

/*  Index
 *
 *  This is the most generic template file in a WordPress theme and one of the 
 *  two required files for a theme (the other being style.css). It is used to 
 *  display a page when nothing more specific matches a query. For example, it 
 *  puts together the home page when there is no home.php file.
 *
 *  @package    WordPress
 *  @subpackage Copernicus
 *  @since      Copernicus 1.0
 *  
 */

    get_template_part('parts/preamble');
    get_template_part('parts/header');

?>

<main class="<?php (have_posts() ? 'listed' : 'not-found') ?>">

<?php

if (is_category()) {
    copernicus_list_subcategories();
}

if (have_posts()) {
    while (have_posts()) {
        the_post();
        get_template_part('parts/listed', get_post_format());
    }
} else {
    get_template_part('parts/empty');
}

?>

</main>

<?php
    get_template_part('parts/footer');

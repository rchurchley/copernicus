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

?>

<main>
<?php
    if ( have_posts() ) while ( have_posts() ) : the_post(); 
        the_content();
    endwhile; 
?>
</main>

<?php
    get_template_part('parts/footer');
?>
<?php

/*  404
 *  
 *  The template for displaying 404 (Not Found) pages.
 *
 *  @package    WordPress
 *  @subpackage Copernicus
 *  @since      Copernicus 1.0
 *
 */

    get_template_part('parts/preamble');
    get_template_part('parts/header');

?>

<main class="not-found">
    <h1>404 Not Found</h1>
    
    <form role="search" method="get" action="<?php echo home_url('/'); ?>">
        <input type="search" placeholder="Search …" value="" name="s" title="Search for:" />
        <input type="submit" class="search-submit" value="&#xe60f;"/>
    </form>
</main>

<?php 
    get_template_part('parts/footer');

<?php

/*  Empty
 * 
 *  The template displayed when there is no post to display (e.g., after an 
 *  unsuccessful search)
 * 
 *  @package    WordPress
 *  @subpackage Copernicus
 *  @since      Copernicus 2.0
 * 
 */

?>



<h1>No Results Found</h1>

<form role="search" method="get" action="<?php echo home_url('/'); ?>">
    <input type="search" placeholder="Search …" value="" name="s" title="Search for:" />
    <input type="submit" class="search-submit" value="&#xe60f;"/>
</form>

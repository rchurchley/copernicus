<header id="site-header" role="banner">
    <img src="<?php header_image(); ?>" height="50px" width="50px"/>
	<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<?php bloginfo( 'name' ); ?>
	</a></h1>

	<nav id="site-navigation" role="navigation">
		<?php 
		echo strip_tags(wp_nav_menu( array(
			'theme_location'  => 'primary',
			'container'       => '',
            'echo'            => false,
		) ), '<ul><li><a>' );
		?>
	</nav>

	<script>
      var navigation = responsiveNav("#site-navigation", {
        animate: true,        // Boolean: Use CSS3 transitions, true or false
        transition: 250,      // Integer: Speed of the transition, in milliseconds
        label: "Menu",        // String: Label for the navigation toggle
        insert: "before",      // String: Insert the toggle before or after the navigation
        customToggle: "",     // Selector: Specify the ID of a custom toggle
        openPos: "relative",  // String: Position of the opened nav, relative or static
        jsClass: "js",        // String: 'JS enabled' class which is added to <html> el
        init: function(){},   // Function: Init callback
        open: function(){},   // Function: Open callback
        close: function(){}   // Function: Close callback
      });
    </script>
</header>
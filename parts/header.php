<header>
	<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
</header>
<nav id="top-menus">
	<?php wp_nav_menu( array( 
		'theme_location'	=> 'primary', 
		'container'			=> false,
		'menu_id'			=> 'primary-menu'
	)); ?>
	<?php wp_nav_menu( array( 
		'theme_location'	=> 'secondary', 
		'container'			=> false,
		'menu_id'			=> 'secondary-menu',
		'fallback_cb'		=> 'false'
	)); ?>
</nav>
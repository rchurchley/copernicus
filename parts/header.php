<header ontouchstart="">
	<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
	<nav id="top-menus">
		<ul id="primary-menu" class="menu">
		<?php wp_nav_menu( array( 
			'theme_location'	=> 'primary', 
			'container'			=> false,
			'items_wrap'		=> '%3$s',
			'fallback_cb'		=> 'untitled_list_pages'
		)); ?>
		</ul>
		<?php wp_nav_menu( array( 
			'theme_location'	=> 'secondary', 
			'container'			=> false,
			'menu_id'			=> 'secondary-menu',
			'fallback_cb'		=> 'false'
		)); ?>
	</nav>
</header>
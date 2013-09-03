<header class="site-header" role="banner">
	<a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<?php bloginfo( 'name' ); ?>
	</a>
	<nav class="site-navigation" role="navigation">
		<h3 class="menu-toggle"><?php _e( 'Menu', 'copernicus' ); ?></h3>
		<?php 
		echo strip_tags(wp_nav_menu( array(
			'theme_location'  => 'primary',
			'container'       => false,
			'echo'            => false,
			'items_wrap'      => '%3$s',
			'depth'           => 0,
		) ), '<a>' );
		echo '<span class="site-navigation-separator">›</span> ';
		echo strip_tags(wp_nav_menu( array(
			'theme_location'  => 'secondary',
			'container'       => false,
			'echo'            => false,
			'items_wrap'      => '%3$s',
			'depth'           => 0,
		) ), '<a>' );
		?>
	</nav>
</header>
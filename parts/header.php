<header>
	<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
</header>
<nav id="main-menu">
	<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
</nav>
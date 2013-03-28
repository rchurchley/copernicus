<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title><?php bloginfo( 'name' ); ?><?php wp_title( '|' ); ?></title>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" href="<?php echo esc_url( home_url( '/' ) ); ?>favicon.ico"/>
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>

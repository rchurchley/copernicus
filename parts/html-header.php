<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title><?php bloginfo( 'name' ); ?><?php wp_title( '›' ); ?></title>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="alternate" type="application/rss+xml" title="RSS" href="<?php echo get_bloginfo ( 'rss2_url' );  ?>" />
		<link rel="alternate" type="application/atom+xml" title="Atom" href="<?php echo get_bloginfo ( 'atom_url' );  ?>" />
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>

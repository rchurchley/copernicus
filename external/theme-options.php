<?php

/*  Theme options =============================================================

	Copernicus Theme Options
	
	@package 		WordPress
	@subpackage 	Copernicus
	@since 			Copernicus 1.0

============================================================================ */

function marginal_customize_register($wp_customize) {
	// SETTINGS
	$wp_customize->add_setting( 'header_background_color' , array(
		'default'	 => '#268BD2',
		'type' => 'option',
		'transport'   => 'refresh',
	) );

	$wp_customize->add_setting( 'hyperlink_color' , array(
		'default'	 => '#268BD2',
		'type' => 'option',
		'transport'   => 'refresh',
	) );

	// CONTROLS
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_background_color', array(
		'label'	  => __( 'Header Background Color', 'marginal' ),
		'section'	=> 'colors',
		'settings'   => 'header_background_color',
	) ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'hyperlink_color', array(
		'label'	  => __( 'Link Color', 'marginal' ),
		'section'	=> 'colors',
		'settings'   => 'hyperlink_color',
	) ) );

}
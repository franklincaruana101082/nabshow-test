<?php
/**
 * NABShow LV Theme Customizer
 *
 * @package NABShow_LV
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function nabshow_lv_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'nabshow_lv_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'nabshow_lv_customize_partial_blogdescription',
		) );
	}

	$wp_customize->add_panel( 'additional_settings', array(
		'title'      => __( 'Additional Settings', 'nabshow-lv' ),
		'priority'   => 999,
		'capability' => 'edit_theme_options',
	) );

	$wp_customize->add_section( 'footer_section', array(
		'title'    => __( 'Footer', 'nabshow-lv' ),
		'priority' => 20,
		'panel'    => 'additional_settings'
	) );

	$wp_customize->add_setting( 'footer_middle_bg', array(
		'default'   => '',
		'transport' => 'refresh',
	) );

	$wp_customize->add_setting( 'footer_logo', array(
		'default'   => '',
		'transport' => 'refresh',
	) );

	$wp_customize->add_control( new WP_Customize_Upload_Control( $wp_customize, 'footer_middle_bg', array(
			'label'       => __( 'Background Image', 'nabshow-lv' ),
			'section'     => 'footer_section',
			'settings'    => 'footer_middle_bg',
			'description' => __( 'Please select footer middle background image', 'nabshow-lv' ),
		) )
	);

	$wp_customize->add_control( new WP_Customize_Upload_Control( $wp_customize, 'footer_logo', array(
			'label'       => __( 'Footer Logo', 'nabshow-lv' ),
			'section'     => 'footer_section',
			'settings'    => 'footer_logo',
			'description' => __( 'Please select footer logo', 'nabshow-lv' ),
		) )
	);
}

add_action( 'customize_register', 'nabshow_lv_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function nabshow_lv_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function nabshow_lv_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function nabshow_lv_customize_preview_js() {
	wp_enqueue_script( 'nabshow-lv-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}

add_action( 'customize_preview_init', 'nabshow_lv_customize_preview_js' );

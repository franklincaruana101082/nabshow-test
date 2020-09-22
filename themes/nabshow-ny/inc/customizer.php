<?php
add_action( 'customize_register', 'nabny_customize_register' );

function nabny_customize_register( $wp_customize ) {
   
    $wp_customize->add_section( 'header_section', array(
		'title'    => __( 'Header', 'nabshow-ny' ),
		'priority' => 20,
		'panel'    => 'additional_settings'
	) );

    $wp_customize->add_setting('nab_show_global_menu', array(
		'default'    => false
	));

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'nab_show_global_menu',
			array(
				'label'     => __('Show Global Menu', WONDERWALL_TEXTDOMAIN),
				'section'   => 'header_section',
				'settings'  => 'nab_show_global_menu',
				'type'      => 'checkbox',
			)
		)
	);
}
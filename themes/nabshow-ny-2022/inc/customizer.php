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


	$wp_customize->add_setting( 'menu_sticky_logo', array(
		'default'   => '',
		'transport' => 'refresh',
	) );

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'header_sticky_logo',
			array(
				'label'      => __( 'Upload Sticky Menu logo', 'nabshow-lv' ),
				'section'    => 'title_tagline',
				'settings'   => 'menu_sticky_logo'
			)
		)
	);

	$wp_customize->add_setting( 'primary_color', array(
		'default'	=> "#2a173c",
		'transport'	=> 'refresh',
	) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_color', array(
			'label'		=> __( 'Primary Theme Color', 'nabshow-base' ),
			'section'	=> 'colors',
		) ) );

	$wp_customize->add_setting( 'secondary_color', array(
		'default'	=> "#2f5dab",
		'transport'	=> 'refresh',
	) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_color', array(
			'label'		=> __( 'Secondary Theme Color', 'nabshow-base' ),
			'section'	=> 'colors',
		) ) );

	$wp_customize->add_setting( 'tertiary_color', array(
		'default'	=> "#f4b2ec",
		'transport'	=> 'refresh',
	) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'tertiary_color', array(
			'label'		=> __( 'Tertiary Theme Color', 'nabshow-base' ),
			'section'	=> 'colors',
		) ) );

	$wp_customize->add_setting( 'light_theme', array(
		'default'	=> "0",
		'transport'	=> 'refresh',
	) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'light_theme', array(
			'label'		=> __( 'Use Light Theme Colors', 'nabshow-base' ),
			'section'	=> 'colors',
			'type'		=> 'checkbox',
		) ) );

	$wp_customize->remove_control( 'background_color' );
	$wp_customize->remove_setting( 'background_color' );
	$wp_customize->remove_control( 'header_textcolor' );
	$wp_customize->remove_setting( 'header_textcolor' );
	$wp_customize->remove_control( 'display_header_text' );

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




function nabshow_customize_css()
{
	$primary   = get_theme_mod('primary_color', "#2a173c");
	$secondary = get_theme_mod('secondary_color', "#2f5dab");
	$tertiary  = get_theme_mod('tertiary_color', "#f4b2ec");

	$swapGrays = get_theme_mod('light_theme', false);

	$primary_hsv = hex_to_hsv($primary);

	//create derivative colors from primary color
	$primary_slate 		= hsv_to_hex(array('h'=>$primary_hsv['h']-2.8, 's'=>$primary_hsv['s']*0.176661264, 'v'=>$primary_hsv['v']*2.2851));//var(--primary-slate, #817a89);
	$primary_slate_dark = hsv_to_hex(array('h'=>$primary_hsv['h']+3.5, 's'=>$primary_hsv['s']*0.236628849, 'v'=>$primary_hsv['v']*0.8));//var(--primary-slate-dark, #2d2930);
	$primary_lighter    = hsv_to_hex(array('h'=>$primary_hsv['h']+37.8, 's'=>$primary_hsv['s']*0.497568882, 'v'=>$primary_hsv['v']*3.421276596));//var(--primary-lighter, #cd8ec4);
	$primary_light      = hsv_to_hex(array('h'=>$primary_hsv['h']+36.6, 's'=>$primary_hsv['s']*0.912479741, 'v'=>$primary_hsv['v']*2.638297872));//var(--primary-light, #9e4593);
	// $primary_lightish   = hsv_to_hex(array('h'=>$primary_hsv['h']-0.2, 's'=>$primary_hsv['s']*0.995137763, 'v'=>$primary_hsv['v']*2.553191489));//var(--primary-lightish, #6b3b99);
	$primary_lightish = '#6769B4';
	$primary_dark       = hsv_to_hex(array('h'=>$primary_hsv['h']-36.8, 's'=>$primary_hsv['s']*1.473257699, 'v'=>$primary_hsv['v']*0.54893617));//var(--primary-dark, #030621);

	//create derivative colors from secondary color
	$secondary_hsv = hex_to_hsv($secondary);
	// $secondary_light = hsv_to_hex(array('h'=>$secondary_hsv['h']-19.1,'s'=>$secondary_hsv['s']*1.308965517, 'v'=>$secondary_hsv['v']*1.368107303));
	$secondary_light = '#0CA5EA';
	$secondary_dark = hsv_to_hex(array('h'=>$secondary_hsv['h']+11.1,'s'=>$secondary_hsv['s']*1.015172414, 'v'=>$secondary_hsv['v']*0.508196721));

	echo("<!--".$swapGrays."-->");
    ?>
    <style type="text/css">
        :root { 
        	--primary-color:  <?php echo $primary; ?>;
        	--secondary-color: <?php echo $secondary; ?>;
        	--tertiary-color: <?php echo $tertiary; ?>;
        	--primary-slate:  <?php echo $primary_slate; ?>;
        	--primary-slate-dark: <?php echo $primary_slate_dark; ?>;
			--primary-lighter: <?php echo $primary_lighter; ?>;
			--primary-light: <?php echo $primary_light; ?>;
			--primary-lightish: <?php echo $primary_lightish; ?>;
			--primary-dark: <?php echo $primary_dark; ?>;
			<?php if ($swapGrays) { ?>
				--black: #ffffff;
				--gray-dark: #c4c4c4;
				--gray: #9e9e9e;
				--gray-medium: #737373;
				--gray-medium-light: #404040;
				--gray-light: #333333;
				--white: #000000;
			<?php } ?>
        }
    </style>
    <?php
}
add_action( 'wp_head', 'nabshow_customize_css');


/*
 * based on functions from:
 * https://www.beliefmedia.com.au/convert-rgb-hsv-hsl-php
 * https://www.beliefmedia.com.au/convert-hex-rgb-colour-php
*/
function hex_to_hsv($hex) {
	$hex = str_replace('#', '', $hex);

	if (strlen($hex) === 3) {
		$r = hexdec($hex[0]);
		$g = hexdec($hex[1]);
		$b = hexdec($hex[2]);
	} elseif (strlen($hex) === 6) {
		$r = hexdec(substr($hex, 0, 2));
		$g = hexdec(substr($hex, 2, 2));
		$b = hexdec(substr($hex, 4, 2));
	} else {
		return false;
	}
	$r = ($r / 255);
	$g = ($g / 255);
	$b = ($b / 255);

	$maxrgb = max($r, $g, $b);
	$minrgb = min($r, $g, $b);
	$chroma = $maxrgb - $minrgb;

	$computedv = 100 * $maxrgb;

	if ($chroma == 0)
		return array(0, 0, $computedv);

	$computeds = 100 * ($chroma / $maxrgb);

	switch ($minrgb) {
		case $r:
			$h = 3 - (($g - $b) / $chroma);
			break;
		case $b:
			$h = 1 - (($r - $g) / $chroma);
			break;
		default: /* $g == $minrgb */
			$h = 5 - (($b - $r) / $chroma);
			break;
	}

	$computedh = 60 * $h;
	return array('h'=>$computedh, 's'=>$computeds, 'v'=>$computedv);	
}

function hsv_to_hex(array $hsv) {
	$hue = $hsv['h'];
	$sat = $hsv['s'];
	$val = $hsv['v'];

	if ($hue < 0)   $hue = $hue + 360;
	if ($hue > 360) $hue = $hue - 360;
	if ($sat < 0)   $sat = 0;
	if ($sat > 100) $sat = 100;
	if ($val < 0)   $val = 0;
	if ($val > 100) $val = 100;

	$dS = $sat/100.0;
	$dV = $val/100.0;
	$dC = $dV*$dS;
	$dH = $hue/60.0;
	$dT = $dH;

	while ($dT >= 2.0) $dT -= 2.0;
	$dX = $dC*(1-abs($dT-1));

	switch(floor($dH)) {
		case 0:
			$dR = $dC; $dG = $dX; $dB = 0.0; break;
		case 1:
			$dR = $dX; $dG = $dC; $dB = 0.0; break;
		case 2:
			$dR = 0.0; $dG = $dC; $dB = $dX; break;
		case 3:
			$dR = 0.0; $dG = $dX; $dB = $dC; break;
		case 4:
			$dR = $dX; $dG = 0.0; $dB = $dC; break;
		case 5:
			$dR = $dC; $dG = 0.0; $dB = $dX; break;
		default:
			$dR = 0.0; $dG = 0.0; $dB = 0.0; break;
	}

	$dM  = $dV - $dC;
	$dR += $dM; $dG += $dM; $dB += $dM;
	$dR *= 255; $dG *= 255; $dB *= 255;
	$rgb = array('r'=>round($dR), 'g'=>round($dG), 'b'=>round($dB));
    //return $rgb;
	return '#' . sprintf('%02x', $rgb['r']) . sprintf('%02x', $rgb['g']) . sprintf('%02x', $rgb['b']);
}


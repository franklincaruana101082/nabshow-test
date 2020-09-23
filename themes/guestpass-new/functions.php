<?php
/**
 * Twenty Twenty functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

/**
 * Table of Contents:
 * Theme Support
 * Required Files
 * Register Styles
 * Register Scripts
 * Register Menus
 * Custom Logo
 * WP Body Open
 * Register Sidebars
 * Enqueue Block Editor Assets
 * Enqueue Classic Editor Styles
 * Block Editor Settings
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function twentytwenty_theme_support() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Custom background color.
	add_theme_support(
		'custom-background',
		array(
			'default-color' => 'f5efe0',
		)
	);

	// Set content-width.
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 580;
	}

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// Set post thumbnail size.
	set_post_thumbnail_size( 1200, 9999 );

	// Add custom image size used in Cover Template.
	add_image_size( 'twentytwenty-fullscreen', 1980, 9999 );

	// Custom logo.
	$logo_width  = 120;
	$logo_height = 90;

	// If the retina setting is active, double the recommended width and height.
	if ( get_theme_mod( 'retina_logo', false ) ) {
		$logo_width  = floor( $logo_width * 2 );
		$logo_height = floor( $logo_height * 2 );
	}

	add_theme_support(
		'custom-logo',
		array(
			'height'      => $logo_height,
			'width'       => $logo_width,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
		)
	);

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Twenty Twenty, use a find and replace
	 * to change 'twentytwenty' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'twentytwenty' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	/*
	 * Adds starter content to highlight the theme on fresh sites.
	 * This is done conditionally to avoid loading the starter content on every
	 * page load, as it is a one-off operation only needed once in the customizer.
	 */
	if ( is_customize_preview() ) {
		require get_template_directory() . '/inc/starter-content.php';
		add_theme_support( 'starter-content', twentytwenty_get_starter_content() );
	}

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * Adds `async` and `defer` support for scripts registered or enqueued
	 * by the theme.
	 */
	$loader = new TwentyTwenty_Script_Loader();
	add_filter( 'script_loader_tag', array( $loader, 'filter_script_loader_tag' ), 10, 2 );

}

add_action( 'after_setup_theme', 'twentytwenty_theme_support' );

/**
 * REQUIRED FILES
 * Include required files.
 */
require get_template_directory() . '/inc/template-tags.php';

// Handle SVG icons.
require get_template_directory() . '/classes/class-twentytwenty-svg-icons.php';
require get_template_directory() . '/inc/svg-icons.php';

// Handle Customizer settings.
require get_template_directory() . '/classes/class-twentytwenty-customize.php';

// Require Separator Control class.
require get_template_directory() . '/classes/class-twentytwenty-separator-control.php';

// Custom comment walker.
require get_template_directory() . '/classes/class-twentytwenty-walker-comment.php';

// Custom page walker.
require get_template_directory() . '/classes/class-twentytwenty-walker-page.php';

// Custom script loader class.
require get_template_directory() . '/classes/class-twentytwenty-script-loader.php';

// Non-latin language handling.
require get_template_directory() . '/classes/class-twentytwenty-non-latin-languages.php';

// Custom CSS.
require get_template_directory() . '/inc/custom-css.php';

/**
 * Register and Enqueue Styles.
 */
function twentytwenty_register_styles() {

	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'twentytwenty-style', get_stylesheet_uri(), array(), $theme_version );
	wp_style_add_data( 'twentytwenty-style', 'rtl', 'replace' );

	// Add output of Customizer settings as inline style.
	wp_add_inline_style( 'twentytwenty-style', twentytwenty_get_customizer_css( 'front-end' ) );

	// Add print CSS.
	wp_enqueue_style( 'twentytwenty-print-style', get_template_directory_uri() . '/print.css', null, $theme_version, 'print' );

}

add_action( 'wp_enqueue_scripts', 'twentytwenty_register_styles' );

/**
 * Register and Enqueue Scripts.
 */
function twentytwenty_register_scripts() {

	$theme_version = wp_get_theme()->get( 'Version' );

	if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'twentytwenty-js', get_template_directory_uri() . '/assets/js/index.js', array(), $theme_version, false );
	wp_script_add_data( 'twentytwenty-js', 'async', true );

}

add_action( 'wp_enqueue_scripts', 'twentytwenty_register_scripts' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function twentytwenty_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'twentytwenty_skip_link_focus_fix' );

/** Enqueue non-latin language styles
 *
 * @since 1.0.0
 *
 * @return void
 */
function twentytwenty_non_latin_languages() {
	$custom_css = TwentyTwenty_Non_Latin_Languages::get_non_latin_css( 'front-end' );

	if ( $custom_css ) {
		wp_add_inline_style( 'twentytwenty-style', $custom_css );
	}
}

add_action( 'wp_enqueue_scripts', 'twentytwenty_non_latin_languages' );

/**
 * Register navigation menus uses wp_nav_menu in five places.
 */
function twentytwenty_menus() {

	$locations = array(
		'primary'  => __( 'Desktop Horizontal Menu', 'twentytwenty' ),
		'expanded' => __( 'Desktop Expanded Menu', 'twentytwenty' ),
		'mobile'   => __( 'Mobile Menu', 'twentytwenty' ),
		'footer'   => __( 'Footer Menu', 'twentytwenty' ),
		'social'   => __( 'Social Menu', 'twentytwenty' ),
	);

	register_nav_menus( $locations );
}

add_action( 'init', 'twentytwenty_menus' );

/**
 * Get the information about the logo.
 *
 * @param string $html The HTML output from get_custom_logo (core function).
 *
 * @return string $html
 */
function twentytwenty_get_custom_logo( $html ) {

	$logo_id = get_theme_mod( 'custom_logo' );

	if ( ! $logo_id ) {
		return $html;
	}

	$logo = wp_get_attachment_image_src( $logo_id, 'full' );

	if ( $logo ) {
		// For clarity.
		$logo_width  = esc_attr( $logo[1] );
		$logo_height = esc_attr( $logo[2] );

		// If the retina logo setting is active, reduce the width/height by half.
		if ( get_theme_mod( 'retina_logo', false ) ) {
			$logo_width  = floor( $logo_width / 2 );
			$logo_height = floor( $logo_height / 2 );

			$search = array(
				'/width=\"\d+\"/iU',
				'/height=\"\d+\"/iU',
			);

			$replace = array(
				"width=\"{$logo_width}\"",
				"height=\"{$logo_height}\"",
			);

			// Add a style attribute with the height, or append the height to the style attribute if the style attribute already exists.
			if ( strpos( $html, ' style=' ) === false ) {
				$search[]  = '/(src=)/';
				$replace[] = "style=\"height: {$logo_height}px;\" src=";
			} else {
				$search[]  = '/(style="[^"]*)/';
				$replace[] = "$1 height: {$logo_height}px;";
			}

			$html = preg_replace( $search, $replace, $html );

		}
	}

	return $html;

}

add_filter( 'get_custom_logo', 'twentytwenty_get_custom_logo' );

if ( ! function_exists( 'wp_body_open' ) ) {

	/**
	 * Shim for wp_body_open, ensuring backwards compatibility with versions of WordPress older than 5.2.
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

/**
 * Include a skip to content link at the top of the page so that users can bypass the menu.
 */
function twentytwenty_skip_link() {
	echo '<a class="skip-link screen-reader-text" href="#site-content">' . __( 'Skip to the content', 'twentytwenty' ) . '</a>';
}

add_action( 'wp_body_open', 'twentytwenty_skip_link', 5 );

/**
 * Register widget areas.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentytwenty_sidebar_registration() {

	// Arguments used in all register_sidebar() calls.
	$shared_args = array(
		'before_title'  => '<h2 class="widget-title subheading heading-size-3">',
		'after_title'   => '</h2>',
		'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
		'after_widget'  => '</div></div>',
	);

	// Footer #1.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer #1', 'twentytwenty' ),
				'id'          => 'sidebar-1',
				'description' => __( 'Widgets in this area will be displayed in the first column in the footer.', 'twentytwenty' ),
			)
		)
	);

	// Footer #2.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer #2', 'twentytwenty' ),
				'id'          => 'sidebar-2',
				'description' => __( 'Widgets in this area will be displayed in the second column in the footer.', 'twentytwenty' ),
			)
		)
	);

}

add_action( 'widgets_init', 'twentytwenty_sidebar_registration' );

/**
 * Enqueue supplemental block editor styles.
 */
function twentytwenty_block_editor_styles() {

	$css_dependencies = array();

	// Enqueue the editor styles.
	wp_enqueue_style( 'twentytwenty-block-editor-styles', get_theme_file_uri( '/assets/css/editor-style-block.css' ), $css_dependencies, wp_get_theme()->get( 'Version' ), 'all' );
	wp_style_add_data( 'twentytwenty-block-editor-styles', 'rtl', 'replace' );

	// Add inline style from the Customizer.
	wp_add_inline_style( 'twentytwenty-block-editor-styles', twentytwenty_get_customizer_css( 'block-editor' ) );

	// Add inline style for non-latin fonts.
	wp_add_inline_style( 'twentytwenty-block-editor-styles', TwentyTwenty_Non_Latin_Languages::get_non_latin_css( 'block-editor' ) );

	// Enqueue the editor script.
	wp_enqueue_script( 'twentytwenty-block-editor-script', get_theme_file_uri( '/assets/js/editor-script-block.js' ), array( 'wp-blocks', 'wp-dom' ), wp_get_theme()->get( 'Version' ), true );
}

add_action( 'enqueue_block_editor_assets', 'twentytwenty_block_editor_styles', 1, 1 );

/**
 * Enqueue classic editor styles.
 */
function twentytwenty_classic_editor_styles() {

	$classic_editor_styles = array(
		'/assets/css/editor-style-classic.css',
	);

	add_editor_style( $classic_editor_styles );

}

add_action( 'init', 'twentytwenty_classic_editor_styles' );

/**
 * Output Customizer settings in the classic editor.
 * Adds styles to the head of the TinyMCE iframe. Kudos to @Otto42 for the original solution.
 *
 * @param array $mce_init TinyMCE styles.
 *
 * @return array $mce_init TinyMCE styles.
 */
function twentytwenty_add_classic_editor_customizer_styles( $mce_init ) {

	$styles = twentytwenty_get_customizer_css( 'classic-editor' );

	if ( ! isset( $mce_init['content_style'] ) ) {
		$mce_init['content_style'] = $styles . ' ';
	} else {
		$mce_init['content_style'] .= ' ' . $styles . ' ';
	}

	return $mce_init;

}

add_filter( 'tiny_mce_before_init', 'twentytwenty_add_classic_editor_customizer_styles' );

/**
 * Output non-latin font styles in the classic editor.
 * Adds styles to the head of the TinyMCE iframe. Kudos to @Otto42 for the original solution.
 *
 * @param array $mce_init TinyMCE styles.
 *
 * @return array $mce_init TinyMCE styles.
 */
function twentytwenty_add_classic_editor_non_latin_styles( $mce_init ) {

	$styles = TwentyTwenty_Non_Latin_Languages::get_non_latin_css( 'classic-editor' );

	// Return if there are no styles to add.
	if ( ! $styles ) {
		return $mce_init;
	}

	if ( ! isset( $mce_init['content_style'] ) ) {
		$mce_init['content_style'] = $styles . ' ';
	} else {
		$mce_init['content_style'] .= ' ' . $styles . ' ';
	}

	return $mce_init;

}

add_filter( 'tiny_mce_before_init', 'twentytwenty_add_classic_editor_non_latin_styles' );

/**
 * Block Editor Settings.
 * Add custom colors and font sizes to the block editor.
 */
function twentytwenty_block_editor_settings() {

	// Block Editor Palette.
	$editor_color_palette = array(
		array(
			'name'  => __( 'Accent Color', 'twentytwenty' ),
			'slug'  => 'accent',
			'color' => twentytwenty_get_color_for_area( 'content', 'accent' ),
		),
		array(
			'name'  => __( 'Primary', 'twentytwenty' ),
			'slug'  => 'primary',
			'color' => twentytwenty_get_color_for_area( 'content', 'text' ),
		),
		array(
			'name'  => __( 'Secondary', 'twentytwenty' ),
			'slug'  => 'secondary',
			'color' => twentytwenty_get_color_for_area( 'content', 'secondary' ),
		),
		array(
			'name'  => __( 'Subtle Background', 'twentytwenty' ),
			'slug'  => 'subtle-background',
			'color' => twentytwenty_get_color_for_area( 'content', 'borders' ),
		),
	);

	// Add the background option.
	$background_color = get_theme_mod( 'background_color' );
	if ( ! $background_color ) {
		$background_color_arr = get_theme_support( 'custom-background' );
		$background_color     = $background_color_arr[0]['default-color'];
	}
	$editor_color_palette[] = array(
		'name'  => __( 'Background Color', 'twentytwenty' ),
		'slug'  => 'background',
		'color' => '#' . $background_color,
	);

	// If we have accent colors, add them to the block editor palette.
	if ( $editor_color_palette ) {
		add_theme_support( 'editor-color-palette', $editor_color_palette );
	}

	// Block Editor Font Sizes.
	add_theme_support(
		'editor-font-sizes',
		array(
			array(
				'name'      => _x( 'Small', 'Name of the small font size in the block editor', 'twentytwenty' ),
				'shortName' => _x( 'S', 'Short name of the small font size in the block editor.', 'twentytwenty' ),
				'size'      => 18,
				'slug'      => 'small',
			),
			array(
				'name'      => _x( 'Regular', 'Name of the regular font size in the block editor', 'twentytwenty' ),
				'shortName' => _x( 'M', 'Short name of the regular font size in the block editor.', 'twentytwenty' ),
				'size'      => 21,
				'slug'      => 'normal',
			),
			array(
				'name'      => _x( 'Large', 'Name of the large font size in the block editor', 'twentytwenty' ),
				'shortName' => _x( 'L', 'Short name of the large font size in the block editor.', 'twentytwenty' ),
				'size'      => 26.25,
				'slug'      => 'large',
			),
			array(
				'name'      => _x( 'Larger', 'Name of the larger font size in the block editor', 'twentytwenty' ),
				'shortName' => _x( 'XL', 'Short name of the larger font size in the block editor.', 'twentytwenty' ),
				'size'      => 32,
				'slug'      => 'larger',
			),
		)
	);

	// If we have a dark background color then add support for dark editor style.
	// We can determine if the background color is dark by checking if the text-color is white.
	if ( '#ffffff' === strtolower( twentytwenty_get_color_for_area( 'content', 'text' ) ) ) {
		add_theme_support( 'dark-editor-style' );
	}

}

add_action( 'after_setup_theme', 'twentytwenty_block_editor_settings' );

/**
 * Overwrite default more tag with styling and screen reader markup.
 *
 * @param string $html The default output HTML for the more tag.
 *
 * @return string $html
 */
function twentytwenty_read_more_tag( $html ) {
	return preg_replace( '/<a(.*)>(.*)<\/a>/iU', sprintf( '<div class="read-more-button-wrap"><a$1><span class="faux-button">$2</span> <span class="screen-reader-text">"%1$s"</span></a></div>', get_the_title( get_the_ID() ) ), $html );
}

add_filter( 'the_content_more_link', 'twentytwenty_read_more_tag' );

/**
 * Enqueues scripts for customizer controls & settings.
 *
 * @since 1.0.0
 *
 * @return void
 */
function twentytwenty_customize_controls_enqueue_scripts() {
	$theme_version = wp_get_theme()->get( 'Version' );

	// Add main customizer js file.
	wp_enqueue_script( 'twentytwenty-customize', get_template_directory_uri() . '/assets/js/customize.js', array( 'jquery' ), $theme_version, false );

	// Add script for color calculations.
	wp_enqueue_script( 'twentytwenty-color-calculations', get_template_directory_uri() . '/assets/js/color-calculations.js', array( 'wp-color-picker' ), $theme_version, false );

	// Add script for controls.
	wp_enqueue_script( 'twentytwenty-customize-controls', get_template_directory_uri() . '/assets/js/customize-controls.js', array( 'twentytwenty-color-calculations', 'customize-controls', 'underscore', 'jquery' ), $theme_version, false );
	wp_localize_script( 'twentytwenty-customize-controls', 'twentyTwentyBgColors', twentytwenty_get_customizer_color_vars() );
}

add_action( 'customize_controls_enqueue_scripts', 'twentytwenty_customize_controls_enqueue_scripts' );

/**
 * Enqueue scripts for the customizer preview.
 *
 * @since 1.0.0
 *
 * @return void
 */
function twentytwenty_customize_preview_init() {
	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_script( 'twentytwenty-customize-preview', get_theme_file_uri( '/assets/js/customize-preview.js' ), array( 'customize-preview', 'customize-selective-refresh', 'jquery' ), $theme_version, true );
	wp_localize_script( 'twentytwenty-customize-preview', 'twentyTwentyBgColors', twentytwenty_get_customizer_color_vars() );
	wp_localize_script( 'twentytwenty-customize-preview', 'twentyTwentyPreviewEls', twentytwenty_get_elements_array() );

	wp_add_inline_script(
		'twentytwenty-customize-preview',
		sprintf(
			'wp.customize.selectiveRefresh.partialConstructor[ %1$s ].prototype.attrs = %2$s;',
			wp_json_encode( 'cover_opacity' ),
			wp_json_encode( twentytwenty_customize_opacity_range() )
		)
	);
}

add_action( 'customize_preview_init', 'twentytwenty_customize_preview_init' );

/**
 * Get accessible color for an area.
 *
 * @since 1.0.0
 *
 * @param string $area The area we want to get the colors for.
 * @param string $context Can be 'text' or 'accent'.
 * @return string Returns a HEX color.
 */
function twentytwenty_get_color_for_area( $area = 'content', $context = 'text' ) {

	// Get the value from the theme-mod.
	$settings = get_theme_mod(
		'accent_accessible_colors',
		array(
			'content'       => array(
				'text'      => '#000000',
				'accent'    => '#cd2653',
				'secondary' => '#6d6d6d',
				'borders'   => '#dcd7ca',
			),
			'header-footer' => array(
				'text'      => '#000000',
				'accent'    => '#cd2653',
				'secondary' => '#6d6d6d',
				'borders'   => '#dcd7ca',
			),
		)
	);

	// If we have a value return it.
	if ( isset( $settings[ $area ] ) && isset( $settings[ $area ][ $context ] ) ) {
		return $settings[ $area ][ $context ];
	}

	// Return false if the option doesn't exist.
	return false;
}

/**
 * Returns an array of variables for the customizer preview.
 *
 * @since 1.0.0
 *
 * @return array
 */
function twentytwenty_get_customizer_color_vars() {
	$colors = array(
		'content'       => array(
			'setting' => 'background_color',
		),
		'header-footer' => array(
			'setting' => 'header_footer_background_color',
		),
	);
	return $colors;
}

/**
 * Get an array of elements.
 *
 * @since 1.0
 *
 * @return array
 */
function twentytwenty_get_elements_array() {

	// The array is formatted like this:
	// [key-in-saved-setting][sub-key-in-setting][css-property] = [elements].
	$elements = array(
		'content'       => array(
			'accent'     => array(
				'color'            => array( '.color-accent', '.color-accent-hover:hover', '.color-accent-hover:focus', ':root .has-accent-color', '.has-drop-cap:not(:focus):first-letter', '.wp-block-button.is-style-outline', 'a' ),
				'border-color'     => array( 'blockquote', '.border-color-accent', '.border-color-accent-hover:hover', '.border-color-accent-hover:focus' ),
				'background-color' => array( 'button:not(.toggle)', '.button', '.faux-button', '.wp-block-button__link', '.wp-block-file .wp-block-file__button', 'input[type="button"]', 'input[type="reset"]', 'input[type="submit"]', '.bg-accent', '.bg-accent-hover:hover', '.bg-accent-hover:focus', ':root .has-accent-background-color', '.comment-reply-link' ),
				'fill'             => array( '.fill-children-accent', '.fill-children-accent *' ),
			),
			'background' => array(
				'color'            => array( ':root .has-background-color', 'button', '.button', '.faux-button', '.wp-block-button__link', '.wp-block-file__button', 'input[type="button"]', 'input[type="reset"]', 'input[type="submit"]', '.wp-block-button', '.comment-reply-link', '.has-background.has-primary-background-color:not(.has-text-color)', '.has-background.has-primary-background-color *:not(.has-text-color)', '.has-background.has-accent-background-color:not(.has-text-color)', '.has-background.has-accent-background-color *:not(.has-text-color)' ),
				'background-color' => array( ':root .has-background-background-color' ),
			),
			'text'       => array(
				'color'            => array( 'body', '.entry-title a', ':root .has-primary-color' ),
				'background-color' => array( ':root .has-primary-background-color' ),
			),
			'secondary'  => array(
				'color'            => array( 'cite', 'figcaption', '.wp-caption-text', '.post-meta', '.entry-content .wp-block-archives li', '.entry-content .wp-block-categories li', '.entry-content .wp-block-latest-posts li', '.wp-block-latest-comments__comment-date', '.wp-block-latest-posts__post-date', '.wp-block-embed figcaption', '.wp-block-image figcaption', '.wp-block-pullquote cite', '.comment-metadata', '.comment-respond .comment-notes', '.comment-respond .logged-in-as', '.pagination .dots', '.entry-content hr:not(.has-background)', 'hr.styled-separator', ':root .has-secondary-color' ),
				'background-color' => array( ':root .has-secondary-background-color' ),
			),
			'borders'    => array(
				'border-color'        => array( 'pre', 'fieldset', 'input', 'textarea', 'table', 'table *', 'hr' ),
				'background-color'    => array( 'caption', 'code', 'code', 'kbd', 'samp', '.wp-block-table.is-style-stripes tbody tr:nth-child(odd)', ':root .has-subtle-background-background-color' ),
				'border-bottom-color' => array( '.wp-block-table.is-style-stripes' ),
				'border-top-color'    => array( '.wp-block-latest-posts.is-grid li' ),
				'color'               => array( ':root .has-subtle-background-color' ),
			),
		),
		'header-footer' => array(
			'accent'     => array(
				'color'            => array( 'body:not(.overlay-header) .primary-menu > li > a', 'body:not(.overlay-header) .primary-menu > li > .icon', '.modal-menu a', '.footer-menu a, .footer-widgets a', '#site-footer .wp-block-button.is-style-outline', '.wp-block-pullquote:before', '.singular:not(.overlay-header) .entry-header a', '.archive-header a', '.header-footer-group .color-accent', '.header-footer-group .color-accent-hover:hover' ),
				'background-color' => array( '.social-icons a', '#site-footer button:not(.toggle)', '#site-footer .button', '#site-footer .faux-button', '#site-footer .wp-block-button__link', '#site-footer .wp-block-file__button', '#site-footer input[type="button"]', '#site-footer input[type="reset"]', '#site-footer input[type="submit"]' ),
			),
			'background' => array(
				'color'            => array( '.social-icons a', 'body:not(.overlay-header) .primary-menu ul', '.header-footer-group button', '.header-footer-group .button', '.header-footer-group .faux-button', '.header-footer-group .wp-block-button:not(.is-style-outline) .wp-block-button__link', '.header-footer-group .wp-block-file__button', '.header-footer-group input[type="button"]', '.header-footer-group input[type="reset"]', '.header-footer-group input[type="submit"]' ),
				'background-color' => array( '#site-header', '.footer-nav-widgets-wrapper', '#site-footer', '.menu-modal', '.menu-modal-inner', '.search-modal-inner', '.archive-header', '.singular .entry-header', '.singular .featured-media:before', '.wp-block-pullquote:before' ),
			),
			'text'       => array(
				'color'               => array( '.header-footer-group', 'body:not(.overlay-header) #site-header .toggle', '.menu-modal .toggle' ),
				'background-color'    => array( 'body:not(.overlay-header) .primary-menu ul' ),
				'border-bottom-color' => array( 'body:not(.overlay-header) .primary-menu > li > ul:after' ),
				'border-left-color'   => array( 'body:not(.overlay-header) .primary-menu ul ul:after' ),
			),
			'secondary'  => array(
				'color' => array( '.site-description', 'body:not(.overlay-header) .toggle-inner .toggle-text', '.widget .post-date', '.widget .rss-date', '.widget_archive li', '.widget_categories li', '.widget cite', '.widget_pages li', '.widget_meta li', '.widget_nav_menu li', '.powered-by-wordpress', '.to-the-top', '.singular .entry-header .post-meta', '.singular:not(.overlay-header) .entry-header .post-meta a' ),
			),
			'borders'    => array(
				'border-color'     => array( '.header-footer-group pre', '.header-footer-group fieldset', '.header-footer-group input', '.header-footer-group textarea', '.header-footer-group table', '.header-footer-group table *', '.footer-nav-widgets-wrapper', '#site-footer', '.menu-modal nav *', '.footer-widgets-outer-wrapper', '.footer-top' ),
				'background-color' => array( '.header-footer-group table caption', 'body:not(.overlay-header) .header-inner .toggle-wrapper::before' ),
			),
		),
	);

	/**
	* Filters Twenty Twenty theme elements
	*
	* @since 1.0.0
	*
	* @param array Array of elements
	*/
	return apply_filters( 'twentytwenty_get_elements_array', $elements );
}


/**
 * Register and Enqueue Scripts for Guest Pass Theme.
 */
function guestpass_enqueue_script() {
	wp_enqueue_script( 'guestpass-tool-js', get_template_directory_uri() . '/js/iframeResizer.contentWindow.min.js', array(), '1.0.0', false );
}

add_action( 'wp_enqueue_scripts', 'guestpass_enqueue_script' );

add_shortcode( 'guest_pass', 'nab_guest_pass_generator' );


/**
 * Nabshow guest pass generator script
 *
 * @return string
 */
function nab_guest_pass_generator() {
	
	$results = FALSE;
	$dest = $src = $error = $booth = $code = '';
	$x_diff = $y_diff = 0;
	$ad_files = array();

	$ad_options = array(
		array(
			'width' => 300,
			'height' => 250,
			'logo_x' => 64,
			'logo_y' => 22,
			'logo_width' => 270,
			'logo_height' => 270,
			//'booth_x' => 485,
			//'booth_y' => 128,
			//'booth_size' => 92,
			'code_x' => 666,
			'code_y' => 233,
			'code_size' => 24,
			'color' => array('red'=>0,'grn'=>178,'blu'=>186),
			'padding' => 10,
		),
		array(
			'width' => 728,
			'height' => 90,
			'logo_x' => 24,
			'logo_y' => 24,
			'logo_width' => 225,
			'logo_height' => 225,
			//'booth_x' => 366,
			//'booth_y' => 108,
			//'booth_size' => 80,
			'code_x' => 472,
			'code_y' => 214,
			'code_size' => 24,
			'color' => array('red'=>0,'grn'=>178,'blu'=>186),
			'padding' => 10,
		),
		array(
			'width' => 440,
			'height' => 220,
			'logo_x' => 143,
			'logo_y' => 63,
			'logo_width' => 202,
			'logo_height' => 202,
			//'booth_x' => 100,
			//'booth_y' => 423,
			//'booth_size' => 60,
			'code_x' => 183,
			'code_y' => 522,
			'code_size' => 18,
			'color' => array('red'=>0,'grn'=>178,'blu'=>186),
			'padding' => 15,
		),
		array(
			'width' => 1200,
			'height' => 630,
			'logo_x' => 158,
			'logo_y' => 78,
			'logo_width' => 202,
			'logo_height' => 202,
			//'booth_x' => 115,
			//'booth_y' => 443,
			//'booth_size' => 62,
			'code_x' => 200,
			'code_y' => 546,
			'code_size' => 18,
			'color' => array('red'=>0,'grn'=>178,'blu'=>186),
			'padding' => 15,
		),
		array(
			'width' => 1080,
			'height' => 1080,
			'logo_x' => 46,
			'logo_y' => 43,
			'logo_width' => 277,
			'logo_height' => 277,
			//'booth_x' => 470,
			//'booth_y' => 150,
			//'booth_size' => 95,
			'code_x' => 672,
			'code_y' => 263,
			'code_size' => 24,
			'color' => array('red'=>0,'grn'=>178,'blu'=>186),
			'padding' => 15,
		),
		array(
			'width' => 1080,
			'height' => 1920,
			'logo_x' => 340,
			'logo_y' => 100,
			'logo_width' => 400,
			'logo_height' => 400,
			//'booth_x' => 200,
			//'booth_y' => 683,
			//'booth_size' => 132,
			'code_x' => 876,
			'code_y' => 821,
			'code_size' => 31,
			'color' => array('red'=>0,'grn'=>178,'blu'=>186),
			'padding' => 15,
		),
	);

	if (isset($_POST['action']) && $_POST['action'] == 'makeImage') :
		$results = TRUE;
		//$target_dir = "/wp-content/themes/guestpass/custom/";
	
		$wp_get_upload_dir = wp_get_upload_dir();
		$base_url   = $wp_get_upload_dir['baseurl'];
		$base_dir   = $wp_get_upload_dir['basedir'];
		$target_dir = $base_dir . '/custom/';
		if ( ! file_exists( $target_dir ) ) {
			wp_mkdir_p( $target_dir );
		}
	
		$target_file = $target_dir . basename($_FILES["logo"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$source_file = $_FILES["logo"]["tmp_name"];
	
		$filename =  $_FILES["logo"]["name"]; //  . $imageFileType
		$target_file = $target_dir . $filename;
		move_uploaded_file( $source_file, $target_file );
	
		$source_file = $base_url . '/custom/'. $filename;
		//$check_org = getimagesize($_FILES["logo"]["tmp_name"]);
		$check = getimagesize($target_file);
	
		if($check === false || ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
								&& $imageFileType != "gif")) {
			$error = 'Select a jpg, png or gif image file';
			$uploadOk = 0;
		}
		// Check file size
		elseif ($_FILES["logo"]["size"] > 500000) {
			$error = "Sorry, your file is too large.";
			$uploadOk = 0;
		}
		if ($uploadOk) {
			$current_timestamp = time();
	
			// Create image instances
			switch($imageFileType)
			{
				case 'png':
					$uploaded_logo = imagecreatefrompng($source_file);
					break;
				case 'gif':
					$uploaded_logo = imagecreatefromgif($source_file);
					break;
				case 'jpeg':
				case 'jpg':
					$uploaded_logo = imagecreatefromjpeg($source_file);
					break;
			}
			list($uploaded_width, $uploaded_height, $type, $attr) = getimagesize($source_file);
	
			foreach ($ad_options as $ad) {
				// Create Booth number image
				$booth_image = textToImage($_POST['booth'], $ad['booth_size'],$ad['color'],$ad['color'],$ad['padding'], get_stylesheet_directory() . '/fonts/Arial-BoldMT.otf');
	
				// Create Code image
				$code_image = textToImage($_POST['code'], $ad['code_size'],$ad['color'],$ad['color'],$ad['padding']/2, get_stylesheet_directory() . '/fonts/OpenSans.ttf');
	
				/*echo '<pre>';
				print_r($_POST);
				print_r($ad);
				print_r($booth_image);
				print_r($code_image);
				die('<br><---died here');*/
	
	
				//Scale and maintain aspect ratio of the uploaded logo image
				$old_x = imageSX($uploaded_logo);
				$old_y = imageSY($uploaded_logo);
	
				if($old_x > $old_y)
				{
					$thumb_w = $ad['logo_width'];
					$thumb_h = $old_y*($ad['logo_height']/$old_x);
				}
	
				if($old_x < $old_y)
				{
					$thumb_w = $old_x*($ad['logo_width']/$old_y);
					$thumb_h = $ad['logo_height'];
				}
	
				if($old_x == $old_y)
				{
					$thumb_w = $ad['logo_width'];
					$thumb_h = $ad['logo_height'];
				}
				$logo = ImageCreateTrueColor($thumb_w,$thumb_h);
				imagecopyresampled($logo,$uploaded_logo,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);
				imagealphablending($logo,true); //allows us to apply logo over ad
	
				// Center logo based on aspect ratio
				if ($thumb_w < $ad['logo_width']) {
					$x_diff = ($ad['logo_width'] - $thumb_w) / 2;
				}
				if ($thumb_h < $ad['logo_height']) {
					$y_diff = ($ad['logo_height'] - $thumb_h) / 2;
				}
	
				//Load the ad image
				//$ad_image = imagecreatefromjpeg('orig/custom_'.$ad['width'].'x'.$ad['height'].'.jpg');
				$ad_image = imagecreatefromjpeg( get_template_directory() . '/orig/custom_'.$ad['width'].'x'.$ad['height'].'.jpg' );
	
				imagealphablending($ad_image,true); //allows us to apply logo over ad
	
				//Apply logo to ad
				imagecopy($ad_image,$logo,$ad['logo_x']+$x_diff,$ad['logo_y']+$y_diff,0,0,$thumb_w,$thumb_h);
				//Apply booth number to ad
				imagecopy($ad_image,$booth_image,$ad['booth_x'],$ad['booth_y'],0,0,1000,1000);
				//Apply code to ad
				imagecopy($ad_image,$code_image,$ad['code_x'],$ad['code_y'],0,0,1000,1000);
				//Resize new image
				$ad_image = imagescale($ad_image, $ad['width'], $ad['height'], IMG_BICUBIC);
				$cropped = imagecropauto($ad_image, IMG_CROP_THRESHOLD, null, 0);
				if ($cropped !== false) { // in case a new image resource was returned
					imagedestroy($ad_image);    // we destroy the original image
					$ad_image = $cropped;       // and assign the cropped image to $im
				}
				//Save new image
				$filename = $target_dir . $current_timestamp . '_' . $_POST['booth'] . '_'.$ad['width'].'x'.$ad['height'].'.png';
				//array_push($ad_files, $filename);
	
				$fileurl = $base_url . '/custom/' . $current_timestamp . '_' . $_POST['booth'] . '_'.$ad['width'].'x'.$ad['height'].'.png';
				array_push($ad_files, $fileurl);
	
				$success = imagejpeg($ad_image,$filename);
	
				imagedestroy($logo);
				imagedestroy($ad_image);
				imagedestroy($booth_image);
				imagedestroy($code_image);
			}
	
			imagedestroy($uploaded_logo);
		} else {
			$results = FALSE;
		}
	endif;
	ob_start();
	?>
	<div style="clear: both;">
		<form id="customAdForm" name="customAdForm" method="post" action="" class="cmxform" enctype="multipart/form-data">
			<input type="hidden" name="action" value="makeImage">
			<fieldset>

				<!--<label for="booth">Booth: </label>
				<input id="booth" size="8" name="booth" class="required" value="<?php if (isset($_POST['booth'])) print $_POST['booth']; ?>" maxlength="7">

				&nbsp;&nbsp;&nbsp;--><label for="code">Code: </label>
				<input id="code" size="8" name="code" class="required" value="<?php if (isset($_POST['code'])) print $_POST['code']; ?>" maxlength="7">


				&nbsp;&nbsp;&nbsp;<label for="logo"> Logo (GIF, JPG, PNG, in RGB color mode, under 2MB): </label><input id="logo" name="logo" type="file" style="display:inline;" value="" class=""><?php print '<p>'.$error.'</p>'; ?><input type="submit"  style="display:inline;" value="Create ADS">

			</fieldset>
		</form>
	</div>
	<?php if ($results) : ?>
		<p>Click on a thumbnail below to download the custom ad to use on your website or social media to let people know that you will be participating in the Show.</p>
		<h3>Your Custom Web Ads</h3>
		<?php foreach($ad_files as $ad) : ?>
			<a href="<?php echo $ad; ?>"><img src="<?php echo $ad; ?>" class="customIMG"></a>&nbsp;
		<?php endforeach; ?>
		<br />
	<?php endif; ?>
	<div style="width:100%;padding-bottom:70px;"></div>
	<?php
	$html = ob_get_clean();
	return $html;
}

if ( ! function_exists('mb_substr_replace') ) {
		
	/**
	 * mb_substr_replace
	 *
	 * @param  mixed $string
	 * @param  mixed $replacement
	 * @param  mixed $start
	 * @param  mixed $length
	 * @param  mixed $encoding
	 * @return string
	 */
	function mb_substr_replace($string, $replacement, $start, $length = null, $encoding = "UTF-8") {
		if ( extension_loaded('mbstring') === true ) {
			$string_length = (is_null($encoding) === true) ? mb_strlen($string) : mb_strlen($string, $encoding);
			if ($start < 0) { $start = max(0, $string_length + $start); }
			else if ($start > $string_length) {$start = $string_length; }
			if ($length < 0){ $length = max(0, $string_length - $start + $length);  }
			else if ((is_null($length) === true) || ($length > $string_length)) { $length = $string_length; }
			if (($start + $length) > $string_length){$length = $string_length - $start;}
			if (is_null($encoding) === true) {  return mb_substr($string, 0, $start) . $replacement . mb_substr($string, $start + $length, $string_length - $start - $length); }
			return mb_substr($string, 0, $start, $encoding) . $replacement . mb_substr($string, $start + $length, $string_length - $start - $length, $encoding);
		}
		return (is_null($length) === true) ? substr_replace($string, $replacement, $start) : substr_replace($string, $replacement, $start, $length);
	}
}


/**
 * Generate image from text
 *
 * @param  mixed $text
 * @param  mixed $size
 * @param  mixed $color
 * @param  mixed $bg_color
 * @param  mixed $pad
 * @param  mixed $font
 * 
 * @return mixed $image
 */
function textToImage( $text, $size=24, $color=array('red'=>0,'grn'=>0,'blu'=>0), $bg_color=array('red'=>255,'grn'=>255,'blu'=>255), $pad=5, $font='./fonts/Arial-BoldMT.otf'){
	$separate_line_after_chars=40;
	$rotate=0;
	$padding=2;
	$transparent=true;
	$amount_of_lines= ceil(strlen($text)/$separate_line_after_chars);
	$x=explode("\n", $text); $final='';
	foreach($x as $key=>$value){
		$returnes='';
		do{ $first_part=mb_substr($value, 0, $separate_line_after_chars, 'utf-8');
			$value= "\n".mb_substr($value, $separate_line_after_chars, null, 'utf-8');
			$returnes .=$first_part;
		}  while( mb_strlen($value,'utf-8')>$separate_line_after_chars);
		$final .= $returnes."\n";
	}
	$text=$final;
	//Header("Content-type: image/jpg");
	$width=$height=$offset_x=$offset_y = 0;
	// get the font height.
	$bounds = ImageTTFBBox($size, $rotate, $font, "W");
	if ($rotate < 0)        {$font_height = abs($bounds[7]-$bounds[1]); }
    elseif ($rotate > 0)    {$font_height = abs($bounds[1]-$bounds[7]); }
	else { $font_height = abs($bounds[7]-$bounds[1]);}
	// determine bounding box.
	$bounds = ImageTTFBBox($size, $rotate, $font, $text);
	if ($rotate < 0){       $width = abs($bounds[4]-$bounds[0]);                    $height = abs($bounds[3]-$bounds[7]);
		$offset_y = $font_height;                               $offset_x = 0;
	}
    elseif ($rotate > 0) {  $width = abs($bounds[2]-$bounds[6]);                    $height = abs($bounds[1]-$bounds[5]);
		$offset_y = abs($bounds[7]-$bounds[5])+$font_height;    $offset_x = abs($bounds[0]-$bounds[6]);
	}
	else{                   $width = abs($bounds[4]-$bounds[6]);                    $height = abs($bounds[7]-$bounds[1]);
		$offset_y = $font_height;                               $offset_x = 0;
	}
	$image = imagecreate($width+($padding*$pad)+2,$height+($padding*$pad)+2);
	$background = ImageColorAllocate($image, $bg_color['red'], $bg_color['grn'], $bg_color['blu']);
	$foreground = ImageColorAllocate($image, $color['red'], $color['grn'], $color['blu']);
	$bg_color = imagecolorat($image,1,1);
	imagecolortransparent($image, $bg_color);
	ImageInterlace($image, true);
	// render the image
	ImageTTFText($image, $size, $rotate, $offset_x+$padding, $offset_y+$padding, $foreground, $font, $text);
	imagealphablending($image, true);
	imagesavealpha($image, true);
	// output JPG object.
	return $image;
}
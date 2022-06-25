<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NABShow_LV
 */
if ('production' === VIP_GO_APP_ENVIRONMENT) {
    // This code only runs on production
    $envclass = '';
} else {
    // This code runs everywhere except production
    $envclass = 'not_prod';
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1,
    minimum-scale=1, width=device-width, shrink-to-fit=no">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="icon" href="<?php echo esc_url(get_template_directory_uri() . '/assets/images/favicon.ico'); ?>">
    <meta name="facebook-domain-verification" content="owmeebj6quneelh1w2hdlz5ljsrxyk" />
    <meta name="google-site-verification" content="bxlFmG3yrAwWFAwi0WI6Bd_V5Ab78-ldZTGAGrgilTQ" />
    <?php wp_head(); ?>

	<!-- Dynamic Schema -->
	<?php
	$dymanic_schema = get_option( 'dymanic_schema' );
	if ( ! empty( $dymanic_schema ) ) {
		echo $dymanic_schema;
	}
	?>
	<!-- End Dynamic Schema -->

	<script data-ad-client="ca-pub-5149137553460967"
	  async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<?php
	$frontpageID = get_option( 'page_on_front' );
	if ( get_field( 'banner_date', $frontpageID ) ) {
		?>
	<style>
		.header__mainnav-cta.menu-item > a:before {
			content:  "<?php the_field( 'banner_date', $frontpageID ); ?>";
		}
	</style>
	<?php } ?>
  <meta name="google-site-verification" content="042y4f5mXlJAOAri3QG5MZ7hHgWUWI7k_kg2pcGEqj8" />
</head>

<body <?php body_class($envclass); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site nabshow_2021">
    <a class="skip-link screen-reader-text" href="#content">
        <?php
        esc_html_e('Skip to content', 'nabshow-lv');
        ?>
    </a>


  <header class="header">

	<nav class="header__mobile">
	  <button class="header__mobile-toggle js-mobile-toggle">
		<div class="header__mobile-toggle-icon"></div>
		<span class="header__mobile-toggle-text">Menu</span>
	  </button>
	  <a href="<?php echo esc_url( get_site_url() ); ?>" class="header__mobile-logo-link">
		<?php
		// check if show global menu option is selected
		$header_logo_id  = get_theme_mod( 'custom_logo' );
		$header_logo_img = wp_get_attachment_image_src( $header_logo_id, 'full' );
		$header_logo_url = $header_logo_img[0];
		if ( $header_logo_url ) {
			echo( "<img class='header__mainnav-logo' src='" . $header_logo_url . "'>" );
		} else {
			echo( "<img class='header__mobile-logo'
            src='/wp-content/themes/nabshow-lv-child-2021/assets/images/NAB_Show_Logo.png'>" );
		}
		?>
	  </a>
	  <?php
		/*
		<div class="header__mobile-cart cart">
		<a class="cart__link" href="https://amplify.nabshow.com/cart/">Cart</a>
		<span class="cart__count">0</span>
		</div>
		*/
		?>
	</nav>

    <div class="header__navwrapper">

      <nav class="header__mainnav">

		<a href="<?php echo esc_url( get_site_url() ); ?>" class="header__mainnav-logo-link">
			<?php
			// check if show global menu option is selected
			$header_logo_id  = get_theme_mod( 'custom_logo' );
			$header_logo_img = wp_get_attachment_image_src( $header_logo_id, 'full' );
			$header_logo_url = $header_logo_img[0];
			if ( $header_logo_url ) {
				echo( "<img class='header__mainnav-logo' src='" . $header_logo_url . "'>" );
			} else {
				echo( "<img class='header__mainnav-logo'
                src='/wp-content/themes/nabshow-lv-child-2021/assets/images/NAB_Show_Logo.png'>" );
			}
			?>
		</a>
		<?php
		wp_nav_menu(
			[
				'theme_location' => 'menu-main',
				'container'      => false,
				'menu_class'     => 'header__mainnav-menu menu',
			]
		);
		?>
		<?php // echo('<input type="text" class="st-default-search-input header__search">'); ?>
	  </nav>
	  <?php
		/* call global header shortcode from ecommerce passes plugin */
			do_action( 'nab_global_header' );
		?>
	</div>
  </header>
<div data-swiftype-name="body" data-swiftype-type="text">

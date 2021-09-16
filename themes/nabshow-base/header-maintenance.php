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

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, shrink-to-fit=no">
    <link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="icon" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/favicon.ico' ); ?>">
	<meta name="google-site-verification" content="bxlFmG3yrAwWFAwi0WI6Bd_V5Ab78-ldZTGAGrgilTQ" />
	<?php wp_head(); ?>

	<!-- Dynamic Schema -->
	<?php $dymanic_schema = get_option( 'dymanic_schema' );
	if ( ! empty( $dymanic_schema ) ) {
		echo $dymanic_schema;
	} ?>
	<!-- End Dynamic Schema -->

	<script data-ad-client="ca-pub-5149137553460967" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site nabshow_2021 maintenance-wrapper">
    <a class="skip-link screen-reader-text" href="#content">
		<?php
		esc_html_e( 'Skip to content', 'nabshow-lv' );
		?>
    </a>
    

  <header class="header">
    <nav class="header__mobile">
      <a href="<?php echo esc_url( get_site_url() ); ?>" class="header__mobile-logo-link">
        <?php
        // check if show global menu option is selected
        $header_logo_code = get_theme_mod( 'nab_header_logo_code' );
        if ( ! empty( $header_logo_code ) ) {
            echo $header_logo_code; // ignored use of wp_kses beacuse the code may vary and accept new tags/attributes in the future.
        } else {
            echo("<img class='header__mobile-logo' src='/wp-content/themes/nabshow-lv-child-2021/assets/images/NAB_Show_Logo.png'>");
        }
        ?>
      </a>   
    </nav>

    <div class="header__navwrapper">
      
      <nav class="header__mainnav">
        <?php do_action( 'nab_global_header' ); ?>
      </nav>
    </div>
  </header>  

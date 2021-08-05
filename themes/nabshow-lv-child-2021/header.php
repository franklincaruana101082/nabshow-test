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
    <meta name="facebook-domain-verification" content="owmeebj6quneelh1w2hdlz5ljsrxyk" />
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

<div id="page" class="site nabshow_2021">
    <a class="skip-link screen-reader-text" href="#content">
		<?php
		esc_html_e( 'Skip to content', 'nabshow-lv' );
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
        $header_logo_id = get_theme_mod( 'custom_logo' );
        $header_logo_img = wp_get_attachment_image_src( $header_logo_id, 'full');
        $header_logo_url = $header_logo_img[0];
        if ( $header_logo_url ) {
            echo("<img class='header__mainnav-logo' src='".$header_logo_url."'>");
        } else {
            echo("<img class='header__mobile-logo' src='/wp-content/themes/nabshow-lv-child-2021/assets/images/NAB_Show_Logo.png'>");
        }
        ?>
      </a>
      <?php /*
      <div class="header__mobile-cart cart">
        <a class="cart__link" href="https://amplify.nabshow.com/cart/">Cart</a>
        <span class="cart__count">0</span>
      </div>  
      */ ?>    
    </nav>

    <div class="header__navwrapper">
      
      <nav class="header__mainnav">
        
        <a href="<?php echo esc_url( get_site_url() ); ?>" class="header__mainnav-logo-link">
            <?php
            // check if show global menu option is selected
            $header_logo_id = get_theme_mod( 'custom_logo' );
            $header_logo_img = wp_get_attachment_image_src( $header_logo_id, 'full');
            $header_logo_url = $header_logo_img[0];
            if ( $header_logo_url ) {
                echo("<img class='header__mainnav-logo' src='".$header_logo_url."'>");
            } else {
                echo("<img class='header__mainnav-logo' src='/wp-content/themes/nabshow-lv-child-2021/assets/images/NAB_Show_Logo.png'>");
            }
            ?>
        </a>
        <?php wp_nav_menu( array( 'theme_location' => 'menu-main', 'container' => false, 'menu_class' => 'header__mainnav-menu menu' ) ); ?>
        <?php //echo('<input type="text" class="st-default-search-input header__search">');?>
      </nav>
      <?php do_action( 'nab_global_header' ); ?>
      <?php /*
      <div class="header__secondarynav">
        <nav class="header__brandnav">
          <?php wp_nav_menu( array( 'theme_location' => 'menu-brand', 'container' => false, 'menu_class' => 'header__brandnav-menu menu' ) ); ?>
        </nav>
        <nav class="header__utilitynav">
          <ul class="header__utilitynav-menu menu">
            <?php /*
            if ( is_user_logged_in() ) {
                $current_user       = wp_get_current_user();
                $user_images        = nab_amplify_get_user_images( $current_user->ID );
                $user_thumb         = $user_images['profile_picture'];
                $user_full_name     = get_user_meta( $current_user->ID, 'first_name', true ) . ' ' . get_user_meta( $current_user->ID, 'last_name', true );                                                     
                
                if ( empty( trim( $user_full_name ) ) ) {

                    $user_full_name = $current_user->display_name;
                }
                
                ?>
                <li class="menu__item _profile">
                    <a class="menu__link" href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-account' ) ); ?>">
                        <div class="author">
                            <div class="author__photo"><img src="<?php echo esc_url( $user_thumb ); ?>"/></div>
                            <span class="author__name"><?php echo $user_full_name; ?></span>
                        </div>
                    </a>
                </li>
            <?php } else { ?>
                <?php
                    $sign_up_page = get_page_by_path( NAB_SIGNUP_PAGE ); // @todo later replace this with VIP function
                    if ( isset( $sign_up_page ) && ! empty( $sign_up_page ) ) {
                        $sign_up_page_url = get_permalink( $sign_up_page->ID );
                ?>
                <li class="menu__item"><a href="<?php echo esc_url( $sign_up_page_url ); ?>" class="menu__link"><?php esc_html_e( 'Sign Up', 'nab-amplify' ); ?></a></li>
                <?php } ?>

                <li class="menu__item">
                    <a class="menu__link _login" href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>"><?php esc_html_e( 'Sign In', 'nab-amplify' ); ?></a>
                </li>
            <?php } ?>
            <?php /*
            <li class="cart">
                <a href="<?php echo esc_url( wc_get_cart_url() ); ?>">Cart</a>
                <span class="cart__count <?php echo esc_attr( $header_cart_class ) ?>"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
            </li>
            
            <li class="menu__item"><a href="#" class="menu__link">Sign Up</a></li>
            <li class="menu__item"><a href="#" class="menu__link">Sign In</a></li>
            <?php /*<li class="header__utilitynav-cart">
              <a class="cart__link" href="https://amplify.nabshow.com/cart/">Cart</a>
              <span class="cart__count ">0</span>
            </li>  ?>
          </ul>
        </nav>
      </div>  
        */?>
    </div>
  </header>  
<div data-swiftype-name="body" data-swiftype-type="text">
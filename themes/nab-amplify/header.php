<?php

/**
 * The header for our theme
 *
 * This
 * is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Amplify
 */

 $post_id = get_the_id();
 $post_type = get_post_type( $post_id );
 $cart_count = WC()->cart->get_cart_contents_count();
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<!-- Post ID: <?php echo $post_id ?>-->
	<!-- Post Type: <?php echo $post_type ?>-->
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="facebook-domain-verification" content="0w5cbue76vinu1cmjikcyz6tpbzbql" />

	<?php wp_head(); ?>
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
	<!-- Hotjar Tracking Code for https://nabshow.com -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:2192660,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>
<?php get_template_part('template-parts/tracking', 'segment'); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary" data-swiftype-index="false"><?php esc_html_e( 'Skip to content', 'nab-amplify' ); ?></a>
	
	<header id="masthead" class="header" data-swiftype-index="false">
		<nav class="header__mobile">
			<a href="<?php echo esc_url( get_site_url() ); ?>" class="header__logo">
				<?php
				// check if show global menu option is selected
				$nab_header_logo_code = get_theme_mod( 'nab_header_logo_code' );
				if ( ! empty( $nab_header_logo_code ) ) {
					echo $nab_header_logo_code; // ignored use of wp_kses beacuse the code may vary and accept new tags/attributes in the future.
				} else {
					echo("<img class='menu__logo' src='/wp-content/themes/nab-amplify/assets/images/nab-amplify.png' width='157'>");
				}
				?>
				
			</a>
			<?php if ($cart_count): ?>
			<div class="cart">
				<a href="<?php echo esc_url( wc_get_cart_url() ); ?>">Cart</a>
				<?php $header_cart_class = WC()->cart->get_cart_contents_count() > 0 ? '' : 'has-no-product'; ?>
				<span class="cart__count  <?php echo esc_attr( $header_cart_class ) ?>"><?php echo $cart_count; ?></span>
			</div>
			<?php endif; ?>
			<div class="header__mobile-toggle js-mobile-toggle">
				<div class="header__menu-icon"></div>
			</div>
		</nav>
		<div class="header__navwrapper">
			<nav class="header__mainnav">
				<a href="<?php echo esc_url( get_site_url() ); ?>" class="header__logo">
					<?php
					// check if show global menu option is selected
					$nab_header_logo_code = get_theme_mod( 'nab_header_logo_code' );
					if ( ! empty( $nab_header_logo_code ) ) {
						echo $nab_header_logo_code; // ignored use of wp_kses beacuse the code may vary and accept new tags/attributes in the future.
					} else {
						echo("<img class='menu__logo' src='/wp-content/themes/nab-amplify/assets/images/nab-amplify.png' width='157'>");
					}
					?>
					
				</a>
				<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'container' => false ) ); ?>
			</nav>
			<nav class="header__brandnav">
				<?php wp_nav_menu( array( 'theme_location' => 'menu-2' ) ); ?>
			</nav>
			<nav class="header__utilitynav">
				<ul class="menu">
				<?php
					if ( is_user_logged_in() ) {
						$current_user    	= wp_get_current_user();
						$user_images     	= nab_amplify_get_user_images( $current_user->ID );
						$user_thumb      	= $user_images['profile_picture'];
						$my_profile_link 	= bp_core_get_user_domain( $current_user->ID );
						$user_full_name		= get_user_meta( $current_user->ID, 'first_name', true ) . ' ' . get_user_meta( $current_user->ID, 'last_name', true );														
						
						if ( empty( trim( $user_full_name ) ) ) {

							$user_full_name	= $current_user->display_name;
						}
						
						?>
						<li class="menu__item _profile">
							<a class="menu__link" href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-account' ) ); ?>">
								<div class="author">
									<div class="author__photo"><img src="<?php echo esc_url( $user_thumb ); ?>"/></div>
									<span class="author__name"><?php echo $user_full_name; ?></span>
								</div>
							</a>
							<?php /*
							<div class="menu__profile-links nab-profile-dropdown">
								<ul>
									<li><a href="<?php echo esc_url( $my_profile_link ); ?>"><?php esc_html_e( 'View Profile', 'nab-amplify' ); ?></a></li>
									<li><a href="<?php echo esc_url( bp_loggedin_user_domain() . bp_get_messages_slug() ); ?>"><?php esc_html_e( 'Inbox', 'nab-amplify' ); ?></a></li>
									<li><a href="<?php echo esc_url( add_query_arg( array( 'connections' => 'friends' ), wc_get_account_endpoint_url( 'my-connections' ) ) ); ?>"><?php esc_html_e( 'Connections', 'nab-amplify' ); ?></a></li>
									<li><a href="<?php echo esc_url( wc_get_account_endpoint_url( 'my-purchases' ) ); ?>"><?php esc_html_e( 'Access My Content', 'nab-amplify' ); ?></a></li>
									<li><a href="<?php echo esc_url( wc_get_account_endpoint_url( 'orders' ) ); ?>"><?php esc_html_e( 'Order History', 'nab-amplify' ); ?></a></li>
									<li><a href="<?php echo esc_url( wc_get_account_endpoint_url( 'my-bookmarks' ) ); ?>"><?php esc_html_e( 'Bookmarks', 'nab-amplify' ); ?></a></li>
									<li><a href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-account' ) ); ?>"><?php esc_html_e( 'Edit Account', 'nab-amplify' ); ?></a></li>											
									<li><a href="<?php echo esc_url( wc_logout_url() ); ?>"><?php esc_html_e( 'Sign Out', 'nab-amplify' ); ?></a></li>
								</ul>
							</div>
							*/ ?>
						</li>
					<?php } else { ?>
						<?php
							$current_url = get_permalink();
							$sign_up_page = get_page_by_path( NAB_SIGNUP_PAGE ); // @todo later replace this with VIP function
							if ( isset( $sign_up_page ) && ! empty( $sign_up_page ) ) {
								$sign_up_page_url = get_permalink( $sign_up_page->ID );
								if($current_url) {
									$sign_up_page_url = get_permalink( $sign_up_page->ID ) . '?r=' . $current_url;
								}
						?>
						<li class="menu__item"><a href="<?php echo esc_url( $sign_up_page_url ); ?>" class="menu__link"><?php esc_html_e( 'Sign Up', 'nab-amplify' ); ?></a></li>
						<?php } 
							
							$login_url = wc_get_page_permalink( 'myaccount' );
							if($current_url) {
								$login_url = wc_get_page_permalink( 'myaccount' ) . '?r=' . $current_url;
							}

						?>

						<li class="menu__item">
							<a class="menu__link _login" href="<?php echo esc_url( $login_url ); ?>"><?php esc_html_e( 'Sign In', 'nab-amplify' ); ?></a>
						</li>
					<?php } ?>
					<?php if ($cart_count): ?>
					<li class="cart">
						<a href="<?php echo esc_url( wc_get_cart_url() ); ?>">Cart</a>
						<span class="cart__count <?php echo esc_attr( $header_cart_class ) ?>"><?php echo $cart_count; ?></span>
					</li>
					<?php endif; ?>
					
				</ul>
			</nav>
			
		</div>
		

		<?php /*
		<div class="header-bottom">
			<div class="container">
				<div class="header-bottom-inner">
					<div class="nab-logos">
						<a href="javascript:void(0)">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/images/serendipity-logo.png" />
						</a>
					</div>
					<?php
						if ( ! is_search() ) {
							?>
							<div class="nab-header-search">
								<?php get_search_form(); ?>
							</div>
							<?php
						}

						$cart_page_url = wc_get_cart_url();
					?>
					<div class="header-bottom-actions">
						<?php nab_get_bp_notification_menu();
                        if (is_user_logged_in()) {
                            ?>						
						<div class="nab-suggetion">
							<a href="https://nab-amplify-c076.nolt.io/top" target="_blank" data-bp-tooltip="Suggest an Idea">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/images/bulb.svg" alt="Suggest an Idea" />
							</a>
						</div>
						<?php
                        } ?>
					</div>
				</div>
			</div>
		</div>
		*/ ?>
	</header><!-- #masthead -->
	<?php
		//if ( ! is_search() ) {
			?>
				<?php get_search_form(); ?>
			<?php
		//}

		$cart_page_url = wc_get_cart_url();
	?>
	<div class="site-content" data-swiftype-name="body" data-swiftype-type="text">
        <?php
        // If NOT in My account dashboard pages
		if ( ( is_account_page() && is_user_logged_in() ) || bp_current_component() ) {

			get_template_part( 'template-parts/content', 'header' );

            if ( isset( $_COOKIE[ 'nab_amp_login_redirect' ] ) && ! empty( $_COOKIE[ 'nab_amp_login_redirect' ] ) ) {
                ?>
                <div style="margin: 0 auto;text-align: center;">
                    <a href="<?php echo esc_url( $_COOKIE[ 'nab_amp_login_redirect' ] ); ?>" class="woocommerce-button btn return-btn">Click Here to Access Your Content</a>
                </div>
                <?php
			}

		} else if ( is_singular( 'company' ) ) {

			get_template_part( 'template-parts/content', 'company-header' );

		} else {
			/*?>
			<div class="container">
				<?php
				if ( ! is_account_page() && ! is_page( NAB_SIGNUP_PAGE ) ) {
					// woocommerce_breadcrumb();
				}
				?>
			</div>
			<?php*/
		}
		?>
		

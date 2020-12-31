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

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
	<script>
        !function(){var analytics=window.analytics=window.analytics||[];if(!analytics.initialize)if(analytics.invoked)window.console&&console.error&&console.error("Segment snippet included twice.");else{analytics.invoked=!0;analytics.methods=["trackSubmit","trackClick","trackLink","trackForm","pageview","identify","reset","group","track","ready","alias","debug","page","once","off","on","addSourceMiddleware","addIntegrationMiddleware","setAnonymousId","addDestinationMiddleware"];analytics.factory=function(e){return function(){var t=Array.prototype.slice.call(arguments);t.unshift(e);analytics.push(t);return analytics}};for(var e=0;e<analytics.methods.length;e++){var key=analytics.methods[e];analytics[key]=analytics.factory(key)}analytics.load=function(key,e){var t=document.createElement("script");t.type="text/javascript";t.async=!0;t.src="https://cdn.segment.com/analytics.js/v1/" + key + "/analytics.min.js";var n=document.getElementsByTagName("script")[0];n.parentNode.insertBefore(t,n);analytics._loadOptions=e};analytics.SNIPPET_VERSION="4.13.1";
            analytics.load("FaBOk3PZeDOlEDxOiqp0RXO3Q8KwBEEo");
            analytics.page();
        }}();
    </script>
    <script src="https://cdn.broadstreetads.com/init-2.min.js"></script>
    <script>broadstreet.watch({ networkId: 6638 })</script>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'nab-amplify' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="header-top">
			<div class="container">
				<div class="header-inner">
					<div class="nab-logos">
						<a href="<?php echo get_site_url(); ?>">
							<?php
							// check if show global menu option is selected
							$nab_header_logo_code = get_theme_mod( 'nab_header_logo_code' );
							if ( ! empty( $nab_header_logo_code ) ) {
								echo $nab_header_logo_code; // ignored use of wp_kses beacuse the code may vary and accept new tags/attributes in the future.
							}
							?>
						</a>
					</div>

					<nav id="site-navigation" class="main-navigation">
						<div class="nab-profile-menu">
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
								<div class="nab-profile">
	                                <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-account' ) ); ?>">
									    <div class="nab-avatar-wrp">
	                                        <div class="nab-avatar"><img src="<?php echo esc_url( $user_thumb ); ?>"/></div>
	                                        <span class="nab-profile-name"><?php echo $user_full_name; ?></span>
									    </div>
	                                </a>
									<div class="nab-profile-dropdown">
										<ul>
											<li><a href="<?php echo esc_url( $my_profile_link ); ?>"><?php esc_html_e( 'View Profile', 'nab-amplify' ); ?></a></li>
											<li><a href="<?php echo esc_url( bp_loggedin_user_domain() . bp_get_messages_slug() ); ?>"><?php esc_html_e( 'Inbox', 'nab-amplify' ); ?></a></li>
											<li><a href="<?php echo esc_url( add_query_arg( array( 'connections' => 'friends' ), wc_get_account_endpoint_url( 'my-connections' ) ) ); ?>"><?php esc_html_e( 'Connections', 'nab-amplify' ); ?></a></li>
											<li><a href="<?php echo esc_url( wc_get_account_endpoint_url( 'my-purchases' ) ); ?>"><?php esc_html_e( 'Access My Content', 'nab-amplify' ); ?></a></li>
											<li><a href="<?php echo esc_url( wc_get_account_endpoint_url( 'orders' ) ); ?>"><?php esc_html_e( 'Order History', 'nab-amplify' ); ?></a></li>
											<li><a href="<?php echo esc_url( wc_get_account_endpoint_url( 'my-bookmarks' ) ); ?>"><?php esc_html_e( 'Bookmarks', 'nab-amplify' ); ?></a></li>
											<li><a href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-account' ) ); ?>"><?php esc_html_e( 'Edit Account', 'nab-amplify' ); ?></a></li>											
	                                        <li><a href="<?php echo esc_url( wc_logout_url() ); ?>"><?php esc_html_e( 'Logout', 'nab-amplify' ); ?></a></li>
										</ul>
									</div>
								</div>
							<?php } else { ?>
								<div class="nab-profile nab-sign-in">
									<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>"><?php esc_html_e( 'Sign In', 'nab-amplify' ); ?></a>
								</div>
							<?php } ?>
						</div>
						<div class="nab-header-cart">
							<a href="<?php echo esc_url( wc_get_cart_url() ); ?>"><i class="fa fa-shopping-cart"></i></a>
							<?php $header_cart_class = WC()->cart->get_cart_contents_count() > 0 ? '' : 'has-no-product'; ?>
							<span class="nab-cart-count <?php echo esc_attr( $header_cart_class ) ?>"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
						</div>
						<div class="nab-logo-right">
							<div class="nab-logo-right-inner">
								<a href="javascript:void(0)"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/nabshows-logo-updated.png" /></a>
								<div class="nab-logo-right-dropdown">
									<ul>
										<li class="active"><a href="<?php echo get_site_url(); ?>">NAB Amplify</a></li>
										<li><a href="https://nabshow.com/2021/">NAB Show</a></li>
										<li><a href="https://nabshow.com/ny2020/">NAB Show New York</a></li>
										<li><a href="https://radio.nabshow.com/">NAB Radio Show</a></li>
										<li><a href="https://smte.nabshow.com/">NAB Show SMTE</a></li>
									</ul>
								</div>
							</div>
						</div>
					</nav><!-- #site-navigation -->

				</div>
			</div>
		</div>

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
						<?php nab_get_bp_notification_menu(); ?>
						<div class="nab-header-message">
						    <div class="message-wrapper">
						        <div class="message-icons-wrap">
						        	<a href="javascript:void(0)">
						        		<i class="fa fa-envelope" aria-hidden="true"></i>
						            	<span id="nab-pending-messages" class="nab-pending-messages count no-alert">0</span>
						        	</a>
						        </div>
						    </div>
						</div>
						<div class="nab-suggetion">
							<a href="https://nab-amplify-c076.nolt.io/top" target="_blank" data-bp-tooltip="Suggest an Idea">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/images/bulb.svg" alt="Suggest an Idea" />
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header><!-- #masthead -->
	<div class="site-content">
        <?php
        // If NOT in My account dashboard pages
		if ( ( is_account_page() && is_user_logged_in() ) || bp_current_component() ) {

			get_template_part( 'template-parts/content', 'header' );

            if ( isset( $_COOKIE[ 'nab_amp_login_redirect' ] ) && ! empty( $_COOKIE[ 'nab_amp_login_redirect' ] ) ) {
                ?>
                <div style="margin: 0 auto;text-align: center;">
                    <a href="<?php echo esc_url( $_COOKIE[ 'nab_amp_login_redirect' ] ); ?>" class="woocommerce-button button return-btn">Click Here to Access Your Content</a>
                </div>
                <?php
			}

		} else if ( is_singular( 'company' ) ) {

			get_template_part( 'template-parts/content', 'company-header' );

		} else {
			?>
			<div class="container">
				<?php
				if ( ! is_account_page() && ! is_page( NAB_SIGNUP_PAGE ) ) {
					// woocommerce_breadcrumb();
				}
				?>
			</div>
			<?php
		}
		?>
		<div class="container">

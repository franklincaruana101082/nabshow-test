<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * My Account navigation.
 *
 * @since 2.6.0
 */

global $wp;

global $wp;

if ( ! empty( $wp->query_vars ) ) {
	foreach ( $wp->query_vars as $page_title => $value ) {
		// Ignore pagename param.
		if ( 'pagename' === $page_title ) {
			continue;
		}
	}
}
$page_title = str_replace( '-', ' ', $page_title );
switch ( $page_title ) {
    case 'edit account':
        $page_title = 'edit my account';
        break;

    case 'edit address':
        $page_title = 'edit addresses';
	    break;
}

do_action( 'woocommerce_account_navigation' ); ?>

<div class="woocommerce-MyAccount-content">

    <header class="entry-header account_custom_title">
        <h1 class="entry-title"><?php esc_html_e( $page_title ); ?></h1>
    </header>

	<?php
	/**
	 * My Account content.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_content' );
	?>
</div>

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
    case 'edit address':
        $page_title = 'edit address';
	    break;
    case 'orders':
        $page_title = 'order history';
	    break;
	case 'my purchases':
		$page_title = 'Access My Content';
		break;
}

// Hide title.
$show_title      = 1;
$hide_title_from = array( 'my connections', 'my events', 'my bookmarks' );
if ( in_array( $page_title, $hide_title_from, true ) ) {
	$show_title = 0;
}

do_action( 'woocommerce_account_navigation' ); ?>

<div class="woocommerce-MyAccount-content">

	<?php if ( 1 === $show_title ) { ?>
    <header class="entry-header account_custom_title">
	<?php if( 'pagename' === $page_title  ) { ?>
        <h1 class="entry-title">Welcome to NAB Amplify<sup style="font-size: 50%;top: -1.2em;">TM</sup></h1>
	<?php } else { ?>
		<h1 class="entry-title"><?php esc_html_e( $page_title ); ?></h1>
	<?php } ?>
    </header>
	<?php } ?>

	<?php
	/**
	 * My Account content.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_content' );
	?>
</div>

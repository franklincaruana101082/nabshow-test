<?php
/**
 * Template Name: Edit My Profile
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

do_action( 'woocommerce_before_account_navigation' );
?>
    <main id="primary" class="site-main">

        <div class="entry-content">
            <div class="woocommerce">

                <nav class="woocommerce-MyAccount-navigation">
                    <ul>
						<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
                            <li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
                                <a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
                            </li>
						<?php endforeach; ?>
                    </ul>
                </nav>

				<?php get_template_part( 'template-parts/content', 'edit-my-profile' ); ?>
    </main>
<?php do_action( 'woocommerce_after_account_navigation' );

get_footer();

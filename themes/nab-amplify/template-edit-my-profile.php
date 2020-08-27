<?php
/**
 * Template Name: Edit My Profile
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$user_id   = get_current_user_id();
$user_data = get_user_meta( $user_id );

$profile_picture    = $user_data['profile_picture'][0];
$banner_picture     = $user_data['banner_picture'][0];
$professional_title = $user_data['professional_title'][0];

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

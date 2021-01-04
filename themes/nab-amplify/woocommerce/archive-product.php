<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

?>
    <div class="element-with-sidebar">
        <div class="left-side">
            <div class="product-head">
				<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
                    <h2 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h2>
				<?php endif;
				do_action( 'woocommerce_archive_description' );
				?>
                <div class="product-layout">
                    <span class="grid"></span>
                    <span class="list"></span>
                </div>
            </div>
			<?php
			if ( woocommerce_product_loop() ) {

				/**
				 * Hook: woocommerce_before_shop_loop.
				 *
				 * @hooked woocommerce_output_all_notices - 10
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );

				woocommerce_product_loop_start();

				if ( wc_get_loop_prop( 'total' ) ) {
					while ( have_posts() ) {
						the_post();

						/**
						 * Hook: woocommerce_shop_loop.
						 */
						do_action( 'woocommerce_shop_loop' );

						wc_get_template_part( 'content', 'product' );
					}
				}

				woocommerce_product_loop_end();

				/**
				 * Hook: woocommerce_after_shop_loop.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			} else {
				/**
				 * Hook: woocommerce_no_products_found.
				 *
				 * @hooked wc_no_products_found - 10
				 */
				do_action( 'woocommerce_no_products_found' );
			}
			?>
			<h3>Registration for additional events is coming soon!</h3>
			<p><a href="https://amplify.nabshow.com/">Sign up for email updates</a> to be the first to know when new events are announced, registration opens and more.</p>
			<p class="small">
			<!--<i>The full pass price is shown here. Member, group and student discounts are available for select passes. Click the pass for more details.</i><br /><br />-->
			Looking for how to access digital content you purchased? Visit <a href="https://amplify.nabshow.com/my-account/my-purchases/">My Purchases</a> and click on the event you wish to access. <a href="https://amplify.nabshow.com/faqs/">View the FAQs</a> for more information.</p>
        </div> <!-- .left-side -->

        <div class="right-side">
            <div class="right-side-top">
                <h3>Product Filter</h3>
                <?php $shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>
                <a href="<?php esc_url( $shop_page_url ); ?>" id="clear-filter">see all</a>
            </div>
            <div class="woo-sidebar">
				<?php
				do_action( 'nab_amplify_woocommerce_before_shop_loop' );
				get_sidebar(); ?>
            </div>
        </div>
    </div>
<?php
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );

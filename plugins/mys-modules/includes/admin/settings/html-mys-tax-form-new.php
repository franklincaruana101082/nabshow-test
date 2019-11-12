<?php
/**
 * HTML for New Taxonomy Page.
 *
 * @package MYS Modules
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

//Prevent  unauthorized users
if ( ! current_user_can( 'manage_options' ) ) {
	wp_die( esc_html__( 'You do not have sufficient permissions to access this page.' ) );
}
?>
<div class="form-field term-group">
	<label><?php esc_html_e( 'Featured', '' ); ?></label>
	<input type="checkbox" name="featured_tag"/>
</div>
<div class="form-field term-group">
	<label for="tax-image-id"><?php esc_html_e( 'Image', '' ); ?></label>
	<input type="hidden" id="tax-image-id" name="tax-image-id" class="custom_media_url" value="">
	<div id="tax-image-wrapper"></div>
	<p>
		<input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php esc_html_e( 'Add Image', 'hero-theme' ); ?>"/>
		<input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php esc_html_e( 'Remove Image', 'hero-theme' ); ?>"/>
	</p>
</div>

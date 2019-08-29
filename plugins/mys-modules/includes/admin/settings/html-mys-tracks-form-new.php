<div class="form-field term-group">
    <label><?php esc_html_e( 'Featured', '' ); ?></label>
    <input type="checkbox" name="featured_tag"/>
</div>
<div class="form-field term-group">
    <label for="tracks-image-id"><?php esc_html_e( 'Image', '' ); ?></label>
    <input type="hidden" id="tracks-image-id" name="tracks-image-id" class="custom_media_url" value="">
    <div id="tracks-image-wrapper"></div>
    <p>
        <input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php esc_html_e( 'Add Image', 'hero-theme' ); ?>"/>
        <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php esc_html_e( 'Remove Image', 'hero-theme' ); ?>"/>
    </p>
</div>

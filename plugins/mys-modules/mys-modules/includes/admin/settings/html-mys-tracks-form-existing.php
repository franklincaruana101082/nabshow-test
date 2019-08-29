<tr class="form-field term-group-wrap">
    <th scope="row">
        <label for=""><?php esc_html_e( 'Featured', '' ); ?></label>
    </th>
    <td>
		<?php $is_featured = get_term_meta( $term->term_id, 'featured_tag', true ); ?>
        <input type="checkbox" name="featured_tag" <?php if ( isset( $is_featured ) && ! empty( $is_featured ) ) { ?> checked <?php } ?>/>
    </td>
</tr>
<tr class="form-field term-group-wrap">
    <th scope="row">
        <label for="tracks-image-id"><?php esc_html_e( 'Image', 'hero-theme' ); ?></label>
    </th>
    <td>
		<?php $image_id = get_term_meta( $term->term_id, 'tracks-image-id', true ); ?>
        <input type="hidden" id="tracks-image-id" name="tracks-image-id" value="<?php echo esc_attr( $image_id ); ?>">
        <div id="tracks-image-wrapper">
			<?php if ( $image_id ) { ?>
				<?php echo wp_get_attachment_image( $image_id, 'thumbnail' ); ?>
			<?php } ?>
        </div>
        <p>
            <input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php esc_html_e( 'Add Image', 'hero-theme' ); ?>"/>
            <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php esc_html_e( 'Remove Image', 'hero-theme' ); ?>"/>
        </p>
    </td>
</tr>

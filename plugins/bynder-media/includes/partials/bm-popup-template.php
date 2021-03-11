<?php
/**
 * Assets Popup HTML.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$bm_assets    = $this->bm_body;
$requested_by = $this->requested_by;
?>
<!--<div class="bm-media-count-wrap">
    <span class="bm-media-count">496 media</span>
</div>-->
<div class="bm-media-main">
	<?php
	foreach ( $bm_assets as $asset ) {
		$asset_name = $asset->name;
		$asset_type = $asset->type;
		//$asset_img = $asset->thumbnails->Featured;
		$asset_img   = $asset->thumbnails->thul;
		$derivatives = $asset->mediaItems;

		// Skip if its not an image.
	    if ( 'image' !== $asset_type ) {
	        continue;
        }

		// Skip if there are no derivatives.
	    if ( 0 === count( $derivatives ) ) {
	        continue;
        }

		// If featured image is requested, skip if featured derivative is absent.
		if ( 'profile_picture' === $requested_by ) {
			foreach ( $derivatives as $derv ) {
				$pass = 0;
				if ( 'Featured' === $derv->name ) {
					$pass = 1;
				}
			}
			if ( 0 === $pass ) {
				continue;
			}
		}
		?>
        <div class="bm-item">
            <div class="bm-item-inner">
                <div class="bm-img">
                    <img src="<?php echo esc_attr( $asset_img ) ?>"/>
                </div>
                <div class="bm-content-wrap">
                    <h4 class="bm-img-name"><?php echo esc_html( $asset_name ) ?></h4>
                    <div class="bm-derivatives-section">
						<?php foreach ( $derivatives as $derv ) { ?>
                            <div class="bm-radio-container">
                                <div class="bm-radio-wrp">
                                    <input type="radio" value="<?php echo esc_url( $derv->publicUrl ) ?>" data-type="<?php echo esc_url( $derv->type ) ?>" name="bm-derivatives" id="<?php echo esc_html( $derv->publicUrl ) ?>" data-name="<?php echo esc_html( $derv->name ) ?>">
                                    <span class="bm-radio"></span>
                                </div>
                                <label for="<?php echo esc_html( $derv->publicUrl ) ?>"><?php echo esc_html( $derv->name ) ?></label>
                            </div>
						<?php } ?>
                    </div>
                    <div class="bm-btn-wrap">
                        <a class="bm-btn" href="javascript:void(0)">Select</a>
                    </div>
                </div>
            </div>
        </div>
	<?php } ?>
</div>

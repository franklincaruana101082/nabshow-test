<?php
/**
 * Assets Popup HTML.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$bm_assets    = $this->bm_body;
//$requested_by = $this->requested_by;
?>
<?php

if ( 0 === count( $bm_assets ) ) { ?>
    <p id="bm-msg">No Assets found.!</p>
<?php } else {

	foreach ( $bm_assets as $asset ) {
		$asset_name = $asset['name'];
		$asset_type = $asset['type'];
		//$asset_img = $asset['thumbnails']['Featured'];
		$asset_img   = isset( $asset['thumbnails']['webimage'] ) ? $asset['thumbnails']['webimage'] : '';
		$derivatives = $asset['mediaItems'];

		// Skip if its not an image or does not exist.
		if ( 'image' !== $asset_type || empty( $asset_img ) ) {
			continue;
		}

		// Skip if there are no derivatives.
		/*if ( 0 === count( $derivatives ) ) {
			continue;
		}*/

		// If featured image is requested, skip if featured derivative is absent.
		$pass  = 0;
		$class = '';
		if ( $this->is_admin ) {
			foreach ( $derivatives as $derv ) {
				$pass = 0;
				if ( 'Featured' === $derv['name'] ) {
					$pass = 1;
				}
			}
			if ( 0 === $pass ) {
				$class = 'no-featured';
			} else {
				$class = 'featured';
            }
		}
		?>
        <div class="bm-item <?php echo esc_attr( $class ) ?>">
            <div class="bm-item-inner">
                <div class="bm-img">
                    <img src="<?php echo esc_attr( $asset_img ) ?>"/>
                </div>
                <div class="bm-content-wrap">
                    <h4 class="bm-img-name" title="<?php echo esc_html( $asset_name ) ?>"><?php echo mb_strimwidth( $asset_name, 0, 40, '...' ); ?></h4>
                    <div class="bm-derivatives-section">

                        <div class="bm-radio-container">
                            <div class="bm-radio-wrp">
                                <input type="radio" value="<?php echo esc_url( $asset_img ) ?>" data-type="Webimage" name="bm-derivatives" id="<?php echo esc_url( $asset_img ) ?>" data-name="Original">
                                <span class="bm-radio"></span>
                            </div>
                            <label for="<?php echo esc_url( $asset_img ) ?>">Original</label>
                        </div>

						<?php foreach ( $derivatives as $derv ) { ?>
                            <div class="bm-radio-container">
                                <div class="bm-radio-wrp">
                                    <input type="radio" value="<?php echo esc_url( $derv['publicUrl'] ) ?>" data-type="<?php echo esc_url( $derv['type'] ) ?>" name="bm-derivatives" id="<?php echo esc_html( $derv['publicUrl'] ) ?>" data-name="<?php echo esc_html( $derv['name'] ) ?>">
                                    <span class="bm-radio"></span>
                                </div>
                                <label for="<?php echo esc_html( $derv['publicUrl'] ) ?>"><?php echo esc_html( $derv['name'] ) ?></label>
                            </div>
						<?php } ?>
                    </div>
                    <div class="bm-btn-wrap">
                        <a class="bm-btn" href="javascript:void(0)">Select</a>
                    </div>
                </div>
            </div>
        </div>
	<?php }
} ?>

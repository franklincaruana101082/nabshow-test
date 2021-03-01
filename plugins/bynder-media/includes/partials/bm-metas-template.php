<?php
/**
 * Assets Metas HTML.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$bm_metas = $this->bm_body;

$keep_only = array(
	'AssetType',
	'AssetSubtype',

	/*'UserType',
	'UserTypeName',
	'EventType',
	'Channel',*/

	/*'ContentSubject',
	'ContentSubjectType',
	'ContentType',
	'content-type',
	'Community',
	'Persona',*/
);

$show_when = array(
	'AssetSubtype' => 'AssetType',
	'UserTypeName' => 'UserType',
	/*'ContentSubjectType' => 'ContentSubject',*/
);

foreach ( $bm_metas as $meta_name => $mval ) {

	if ( ! in_array( $meta_name, $keep_only, true ) ) {
		continue;
	}

	$type            = $mval['type'];
	$is_multi_select = $mval['isMultiselect'];

	if ( 0 !== count( $mval['options'] ) ) {
		?>
        <div class="single-meta" <?php if ( array_key_exists( $meta_name, $show_when ) ) { ?> data-show-when="<?php echo esc_attr( $show_when[ $meta_name ] ); ?>" <?php } ?>>
            <label class="bm-meta-label"><?php echo esc_html( $mval['label'] ); ?></label>
            <div class="bm-meta-value" data-name="<?php echo esc_attr( $mval['name'] ); ?>">
				<?php if ( 'select' === $type && 0 === $is_multi_select ) { ?>

                    <select name="metas[<?php echo esc_attr( $mval['id'] ); ?>]" id="metas[<?php echo esc_attr( $mval['id'] ); ?>]">
                        <option value="">Select</option>
						<?php foreach ( $mval['options'] as $option ) { ?>
                            <option value="<?php echo esc_attr( $option['id'] ); ?>" data-linked-options="<?php echo esc_attr( implode( ',', $option['linkedOptionIds'] ) ) ?>" data-name-option="<?php echo esc_html( $option['name'] ) ?>"><?php echo esc_html( $option['displayLabel'] ) ?></option>
						<?php } ?>
                    </select>

				<?php } else if ( 'select' === $type && 1 === $is_multi_select ) { ?>

					<?php foreach ( $mval['options'] as $option ) { ?>
                        <div class="bm-cb-box" data-linked-options="<?php echo esc_attr( implode( ',', $option['linkedOptionIds'] ) ) ?>">
                            <input type="checkbox" name="metas[<?php echo esc_attr( $mval['id'] ); ?>][]" id="metas[<?php echo esc_attr( $option['id'] ); ?>]" value="<?php echo esc_attr( $option['id'] ); ?>" data-name-option="<?php echo esc_html( $option['name'] ) ?>">
                            <label class="meta-cb-labels" for="metas[<?php echo esc_attr( $option['id'] ); ?>]"><?php echo esc_html( $option['displayLabel'] ) ?></label>
                        </div>
					<?php } ?>
				<?php } else { ?>
                    <input type="text" name="metas[<?php echo esc_attr( $mval['id'] ); ?>]" id="metas[<?php echo esc_attr( $mval['id'] ); ?>]" value="">
				<?php } ?>
            </div>
        </div>
	<?php }
}

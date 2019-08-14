<?php
/**
 * This file contains all shortcodes functions located in this file.
 *
 *
 * @package NABShow_LV
 */

/**
 * Create dropdown box
 * @param $atts
 * @return string
 */
function nabshow_lv_dropdown_func( $atts ) {
    $atts = shortcode_atts( array(
        'first_option' => '',
        'is_faq'       => false,
    ), $atts );
    ob_start();
    ?>
        <select id="<?php echo $atts['is_faq'] ? esc_attr('faq-category-drp') : ''; ?>" class="<?php echo ! $atts['is_faq'] ? esc_attr('plan-your-show-drp') : esc_attr('faq-category-drp'); ?>">
            <?php
            if ( isset( $atts['first_option'] ) && ! empty( $atts['first_option'] ) ) {
            ?>
                <option value=""><?php echo esc_html( $atts['first_option'] ); ?></option>
            <?php
            }
            if ( ! $atts['is_faq'] ) {
            ?>        
                <option value="/not-to-be-missed-archive/">Options 1</option>
                <option value="/not-to-be-missed-archive/">Options 2</option>
                <option value="/not-to-be-missed-archive/">Options 3</option>
                <option value="/not-to-be-missed-archive/">Options 4</option>
                <option value="/not-to-be-missed-archive/">Options 5</option>
            <?php
            }?>
        </select>
    <?php
    $html = ob_get_clean();
    return $html;
}

/**
 * Fetch latest instagram feed.
 * @param $atts
 * @return string
 */
function nabshow_lv_latest_instagram_post_func($atts){
$atts = shortcode_atts( array(
	'count' => 1,
    'access_token' => '2203194498.1d37e34.b17b7e141fac431fb4c0fda279d72cd6',
), $atts );

	$url = 'https://api.instagram.com/v1/users/self/media/recent/?access_token='.$atts['access_token'].'&count='.$atts['count'];
	$latest_image_url          = get_transient( 'nab-latest-instagram-post' . $atts['access_token'].$atts['count'] );

	if ( false === $latest_image_url ) {
		$response = wp_safe_remote_get($url);
		$body = wp_remote_retrieve_body( $response );
		$json = json_decode( $body );
		$latest_image_url = $json->data[0]->images->standard_resolution->url;

		set_transient( 'nab-latest-instagram-post' . $atts['access_token'].$atts['count'], $latest_image_url, 20 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );
	}
ob_start();
?>
    <div><img src="<?php echo esc_url($latest_image_url); ?>" class="insta-latest"/></div>
<?php
	$html = ob_get_clean();
    return $html;
}

/**
 * Create filter for schedule at a glance page
 * @return string
 */
function nabshow_lv_schedule_at_a_glance_filter() {
    ob_start();
    ?>
        <div class="schedule-glance-filter">
            <div class="date">
                <label>Date</label>
                <div class="schedule-select">
                    <select id="date">
                        <option>Select a Date</option>
                    </select>
                </div>
            </div>
            <div class="pass-type">
                <label>Is Open To</label>
                <div class="schedule-select">
                    <select id="pass-type">
                        <option>Select a Pass Time</option>
                    </select>
                </div>
            </div>
            <div class="location">
                <label>Location</label>
                <div class="schedule-select">
                    <select id="location">
                        <option>Select a Location</option>
                    </select>
                </div>
            </div>
            <div class="type">
                <label>Type</label>
                <div class="schedule-select">
                    <select id="type">
                        <option>Select a Type</option>
                    </select>
                </div>
            </div>
            <div>
                <label>Name</label>
                <div class="schedule-select">
                    <input type="text" placeholder="Start typing to filter by name..." name="">
                </div>
            </div>
        </div>
    <?php
    $html = ob_get_clean();
    return $html;
}
<?php
/**
 * The Template for joining meeting via browser
 *
 * This template can be overridden by copying it to yourtheme/video-conferencing-zoom/join-web-browser.php.
 *
 * @package    Video Conferencing with Zoom API/Templates
 * @since      3.0.0
 * @modified   3.3.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $zoom;

if ( video_conference_zoom_check_login() ) {
	if ( ! empty( $zoom['api']->state ) && $zoom['api']->state === "ended" ) {
		echo "<h3>" . __( 'This meeting has been ended by host.', 'video-conferencing-with-zoom-api' ) . "</h3>";
		die;
	}

	/**
	 * Trigger before the content
	 */
	do_action( 'vczoom_jbh_before_content', $zoom );
	?>
    <div id="dpen-zoom-browser-meeting" class="dpen-zoom-browser-meeting-wrapper">
        <div id="dpen-zoom-browser-meeting--container">
			<?php
			$bypass_notice = apply_filters( 'vczapi_api_bypass_notice', false );
			if ( ! $bypass_notice ) {
				?>
                <div class="dpen-zoom-browser-meeting--info">
					<?php if ( ! is_ssl() ) { ?>
                        <p style="line-height: 1.5;">
                            <strong style="color:red;"><?php _e( '!!!ALERT!!!: ', 'video-conferencing-with-zoom-api' ); ?></strong><?php _e(
								'Browser did not detect a valid SSL certificate. Audio and Video for Zoom meeting will not work on a non HTTPS site, please install a valid SSL certificate to allow audio and video in your Meetings via browser.', 'video-conferencing-with-zoom-api' ); ?>
                        </p>
					<?php } ?>
                    <div class="dpen-zoom-browser-meeting--info__browser"></div>
                </div>
			<?php } ?>
            <form class="dpen-zoom-browser-meeting--meeting-form" id="dpen-zoom-browser-meeting-join-form" action="">
                <div class="form-group">
                    <input type="text" name="display_name" id="display_name" value="" placeholder="Your Name Here" class="form-control" required>
                </div>
				<?php if ( ! isset( $_GET['pak'] ) ) { ?>
                    <div class="form-group">
                        <input type="password" name="meeting_password" id="meeting_password" value="" placeholder="Meeting Password" class="form-control" required>
                    </div>
					<?php
				}

				$bypass_lang = apply_filters( 'vczapi_api_bypass_lang', false );
				if ( ! $bypass_lang ) {
					?>
                    <div class="form-group">
                        <select id="meeting_lang" name="meeting-lang" class="form-control">
                            <option value="en-US">English</option>
                            <option value="de-DE">German Deutsch</option>
                            <option value="es-ES">Spanish Español</option>
                            <option value="fr-FR">French Français</option>
                            <option value="jp-JP">Japanese 日本語</option>
                            <option value="pt-PT">Portuguese Portuguese</option>
                            <option value="ru-RU">Russian Русский</option>
                            <option value="zh-CN">Chinese 简体中文</option>
                            <option value="zh-TW">Chinese 繁体中文</option>
                            <option value="ko-KO">Korean 한국어</option>
                            <option value="vi-VN">Vietnamese Tiếng Việt</option>
                            <option value="it-IT">Italian italiano</option>
                        </select>
                    </div>
					<?php
				}
				?>

                <button type="submit" class="btn btn-primary" id="dpen-zoom-browser-meeting-join-mtg">
					<?php _e( 'Join', 'video-conferencing-with-zoom-api' ); ?>
                </button>
            </form>
        </div>
    </div>
	<?php
	/**
	 * Trigger before the content
	 */
	do_action( 'vczoom_jbh_after_content' );
} else {
	echo "<h3>" . __( 'You do not have enough priviledge to access this page. Please login to continue or contact administrator.', 'video-conferencing-with-zoom-api' ) . "</h3>";
	die;
}

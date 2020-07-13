<?php
/**
 * View: Virtual Events Metabox Zoom API auth intro text.
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/admin-views/zoom/api/intro-text.php
 *
 * See more documentation about our views templating system.
 *
 * @since   1.0.0
 *
 * @version 1.0.0
 *
 * @link    http://m.tri.be/1aiy
 *
 * @var array $allowed_html Which HTML elements are used for wp_kses.
 */

$guide = sprintf(
	// translators: the two placeholders are the opening and closing tag of the HTML anchor tag.
	_x(
		'Our %1$ssetup guide%2$s will walk you through the process.',
		'Zoom API integration setup guide link; the placeholders are the opening and closing anchor tag HTML.',
		'events-virtual'
	),
	'<a href="' . esc_url( 'http://m.tri.be/ve-zoom' ) . '" target="_blank">',
	'</a>'
);
?>
<h3 id="tribe-zoom-application-credentials" class="tribe-settings-zoom-application__title">
	<?php echo esc_html_x( 'Zoom', 'API connection header', 'events-virtual' ); ?>
</h3>
<p>
	<?php
	echo esc_html_x(
		'You need to connect your site to your Zoom account to be able to generate Zoom links for your virtual events.',
		'Settings Description',
		'events-virtual'
	);
	?>
	<?php echo wp_kses( $guide, $allowed_html ); ?>
</p>

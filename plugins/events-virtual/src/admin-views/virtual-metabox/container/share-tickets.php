<?php
/**
 * View: Virtual Events Metabox Share on Ticket Emails section.
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/admin-views/metabox/show.php
 *
 * See more documentation about our views templating system.
 *
 * @since   1.0.0
 * @since   1.0.2 Add check for ticket provider as return of get_event_ticket_provider has changed.
 *
 * @version 1.0.2
 *
 * @link    http://m.tri.be/1aiy
 *
 * @var string   $metabox_id The current metabox id.
 * @var \WP_Post $post       The current event post object, as decorated by the `tribe_get_event` function.
 *
 * @see tribe_get_event() For the format of the event object.
 */

if ( ! class_exists( 'Tribe__Tickets__Tickets' ) ) {
	return;
}

use Tribe\Events\Virtual\Event_Meta;
$provider = Tribe__Tickets__Tickets::get_event_ticket_provider( $post->ID );
if ( is_object( $provider ) ) {
	$provider = $provider->class_name;
}

if (
	empty( $provider )
	|| 'Tribe__Tickets__RSVP' === $provider
	|| ! array_key_exists( $provider, \Tribe__Tickets__Tickets::modules() )
) {
	return;
}
?>
<li>
	<label for="<?php echo esc_attr( "{$metabox_id}-ticket-email-link" ); ?>">
		<input
			id="<?php echo esc_attr( "{$metabox_id}-ticket-email-link" ); ?>"
			name="<?php echo esc_attr( "{$metabox_id}[ticket-email-link]" ); ?>"
			type="checkbox"
			value="yes"
			<?php checked( $post->virtual_ticket_email_link ); ?>
		/>
		<?php esc_html_e( 'Include link in ticket emails', 'events-virtual' ); ?>
	</label>
</li>

<?php
/**
 * Meeting link for ticket emails.
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events-virtual/email/ticket-email-link.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://m.tri.be/1aiy
 *
 * @version 1.0.0
 *
 * @var WP_Post $event      The event post object with properties added by the `tribe_get_event` function.
 *
 * @see tribe_get_event() For the format of the event object.
 */

// Don't print anything when this event is not virtual or the URL isn't present.
if ( ! $event->virtual || empty( $event->virtual_url ) ) {
	return;
}

// Compatibility with ET <= 4.12.1.
$hooked = did_action( 'tribe_tickets_ticket_email_after_details' );
?>
<?php if ( ! $hooked ) : ?>
	<?php $this->template( 'email/ticket-email-whitespace' ); ?>
<?php endif; ?>
<table class="virtual-event-ticket-email__join" border="0" cellpadding="0" cellspacing="0" width="100%" align="center">
	<tr>
		<td>
			<h6 style="color:#909090 !important; margin:0 0 4px 0; font-family: 'Helvetica Neue', Helvetica, sans-serif; text-transform:uppercase; font-size:13px; font-weight:700 !important;"><?php esc_html_e( 'Join', 'virtual-events' ); ?></h6>
			<a href="<?php echo esc_url( $event->virtual_url ); ?>"><?php echo esc_html( $event->virtual_url ); ?></a>
		</td>
	</tr>
</table>
<?php if ( $hooked ) : ?>
	<?php $this->template( 'email/ticket-email-whitespace' ); ?>
<?php endif; ?>

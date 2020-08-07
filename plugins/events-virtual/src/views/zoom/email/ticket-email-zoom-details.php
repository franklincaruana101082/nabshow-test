<?php
/**
 * Zoom details section for ticket emails.
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events-virtual/zoom/email/ticket-email-zoom-details.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://m.tri.be/1aiy
 *
 * @version 1.0.0
 *
 * @var WP_Post $event The event post object with properties added by the `tribe_get_event` function.
 *
 * @see tribe_get_event() For the format of the event object.
 */

// Don't print anything when this event is not virtual. Or if we're missing both pieces.
if ( ! $event->virtual || ( empty( $event->zoom_join_url ) && empty( $event->zoom_global_dial_in_numbers ) ) ) {
	return;
}

// Compatibility with ET <= 4.12.1.
$hooked = did_action( 'tribe_tickets_ticket_email_after_details' );
?>
<?php if ( ! $hooked ) : ?>
	<?php $this->template( 'email/ticket-email-whitespace' ); ?>
<?php endif; ?>
<table class="tribe-events-virtual-email-zoom-details" style="width: 100%;">
	<tr>
		<?php if ( ! empty( $event->zoom_join_url ) ) : ?>
			<?php $this->template( 'zoom/email/details/join-header' ); ?>
		<?php endif; ?>
		<?php if ( ! empty( $event->zoom_global_dial_in_numbers ) ) : ?>
			<?php $this->template( 'zoom/email/details/dial-in-header' ); ?>
		<?php endif; ?>
	</tr>
	<tr>
		<?php if ( ! empty( $event->zoom_join_url ) ) : ?>
			<?php $this->template( 'zoom/email/details/join-content', [ 'event' => $event ] ); ?>
		<?php endif; ?>
		<?php if ( ! empty( $event->zoom_global_dial_in_numbers ) ) : ?>
			<?php $this->template( 'zoom/email/details/dial-in-content', [ 'event' => $event ] ); ?>
		<?php endif; ?>
	</tr>
</table>
<?php if ( $hooked ) : ?>
	<?php $this->template( 'email/ticket-email-whitespace' ); ?>
<?php endif; ?>

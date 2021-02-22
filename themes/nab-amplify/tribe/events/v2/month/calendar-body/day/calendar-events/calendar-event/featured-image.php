<?php
/**
 * View: Month View - Calendar Event Featured Image
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/month/calendar-body/day/calendar-events/calendar-event/featured-image.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://m.tri.be/1aiy
 *
 * @version 5.0.0
 *
 * @var WP_Post $event The event post object with properties added by the `tribe_get_event` function.
 *
 * @see tribe_get_event() For the format of the event object.
 *
 */

$event_url = tribe_get_event_meta( $event->ID, '_EventURL', true );
$featured_image   = nab_amplify_get_featured_image( $event->ID );

if ( empty( $featured_image ) || null === $featured_image ) {
	return;
}
?>
<div class="ne-check tribe-events-calendar-month__calendar-event-featured-image-wrapper">
    <a
            href="<?php echo esc_url( $event_url ); ?>"
            target="_blank"
            title="<?php echo esc_attr( $event->title ); ?>"
            rel="bookmark"
            class="tribe-events-calendar-month__calendar-event-featured-image-link"
    >
        <img
                src="<?php echo esc_url( $featured_image ); ?>"
                class="tribe-events-calendar-month__calendar-event-featured-image"
        />
    </a>
</div>

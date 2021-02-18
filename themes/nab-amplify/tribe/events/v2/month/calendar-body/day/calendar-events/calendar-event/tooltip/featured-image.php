<?php
/**
 * View: Month View - Calendar Event Tooltip Featured Image
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/month/calendar-body/day/calendar-events/calendar-event/tooltip/featured-image.php
 *
 * See more documentation about our views templating system.
 *
 * @link {INSERT_ARTCILE_LINK_HERE}
 *
 * @version 5.0.0
 *
 * @var WP_Post $event The event post object with properties added by the `tribe_get_event` function.
 *
 * @see tribe_get_event() For the format of the event object.
 */

if ( ! $event->thumbnail->exists ) {
	return;
}

$event_url = tribe_get_event_meta( $post_id, '_EventURL', true );
$featured_image   = nab_amplify_get_featured_image( $post_id );
?>
<div class="tribe-events-calendar-month__calendar-event-tooltip-featured-image-wrapper">
	<a
		href="<?php echo esc_url( $event_url ); ?>"
		target="_blank"
		title="<?php echo esc_attr( $event->title ); ?>"
		rel="bookmark"
		class="tribe-events-calendar-month__calendar-event-tooltip-featured-image-link"
	>
		<img
			src="<?php echo esc_url( $featured_image ); ?>" class="tribe-events-calendar-month__calendar-event-tooltip-featured-image"
		/>
	</a>
</div>

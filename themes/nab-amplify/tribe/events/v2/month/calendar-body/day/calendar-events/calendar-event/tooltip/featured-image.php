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
			src="<?php echo esc_url( $event->thumbnail->full->url ); ?>"
			<?php if ( ! empty( $event->thumbnail->srcset ) ) : ?>
				srcset="<?php echo esc_attr( $event->thumbnail->srcset ); ?>"
			<?php endif; ?>
			<?php if ( ! empty( $event->thumbnail->alt ) ) : ?>
				alt="<?php echo esc_attr( $event->thumbnail->alt ); ?>"
			<?php endif; ?>
			<?php if ( ! empty( $event->thumbnail->title ) ) : ?>
				title="<?php echo esc_attr( $event->thumbnail->title ); ?>"
			<?php endif; ?>
			class="tribe-events-calendar-month__calendar-event-tooltip-featured-image"
		/>
	</a>
</div>

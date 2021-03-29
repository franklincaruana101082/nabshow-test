<?php
/**
 * View: List View - Single Event Title
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/list/event/title.php
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

$event->permalink   = tribe_get_event_meta( $event->ID, '_EventURL', true );
?>
<?php
$company_id = get_field( 'nab_selected_company_id', $event->ID );
if ( ! empty( $company_id ) ) {	
	?>
	<div class="event-company">
		<p class="event-company-link"><a href="<?php echo esc_url( get_the_permalink( $company_id ) ); ?>"><?php echo esc_html( get_the_title( $company_id ) ); ?></a></p>
	</div>
	<?php
}
?>
<h3 class="tribe-events-calendar-list__event-title tribe-common-h6 tribe-common-h4--min-medium">
	<a
		href="<?php echo esc_url( $event->permalink ); ?>"
		title="<?php echo esc_attr( $event->title ); ?>"
		rel="bookmark"
		class="tribe-events-calendar-list__event-title-link tribe-common-anchor-thin"
	>
		<?php
		// phpcs:ignore
		echo $event->title;
		?>
	</a>
</h3>

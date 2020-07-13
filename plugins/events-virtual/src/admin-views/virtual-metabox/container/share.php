<?php
/**
 * View: Virtual Events Metabox Share on RSVP Emails section.
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/admin-views/metabox/share.php
 *
 * See more documentation about our views templating system.
 *
 * @since   1.0.0
 *
 * @version 1.0.0
 *
 * @link    http://m.tri.be/1aiy
 *
 * @var string   $metabox_id The current metabox id.
 * @var \WP_Post $post       The current event post object, as decorated by the `tribe_get_event` function.
 *
 * @see tribe_get_event() For the format of the event object.
 */

// Bail if Event Tickets isn't active.
if ( ! class_exists( 'Tribe__Tickets__Main' ) ) {
	return;
}
?>

<tr>
	<td class='tribe-table-field-label'><?php esc_html_e( 'Share:', 'events-virtual' ); ?></td>
	<td>
		<ul>
			<li>
				<label for="<?php echo esc_attr( "{$metabox_id}-rsvp-email-link" ); ?>">
					<input
						id="<?php echo esc_attr( "{$metabox_id}-rsvp-email-link" ); ?>"
						name="<?php echo esc_attr( "{$metabox_id}[rsvp-email-link]" ); ?>"
						type="checkbox"
						value="yes"
						<?php checked( $post->virtual_rsvp_email_link ); ?>
					/>
					<?php esc_html_e( 'Include link in RSVP emails', 'events-virtual' ); ?>
				</label>
			</li>
			<?php
			$this->template(
				'virtual-metabox/container/share-tickets',
				[
					'metabox_id' => $metabox_id,
					'post'       => $post,
				]
			);
			?>
		</ul>
	</td>
</tr>

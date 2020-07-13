<?php
/**
 * Class that handles template modifications for Event Tickets emails.
 *
 * @since   1.0.0
 *
 * @package Tribe\Events\Virtual
 */

namespace Tribe\Events\Virtual;

/**
 * Class Email.
 *
 * @since   1.0.0
 *
 * @package Tribe\Events\Virtual
 */
class Email {
	/**
	 * An instance of the front-end template rendering handler.
	 *
	 * @since 1.0.0
	 *
	 * @var Template
	 */
	protected $template;

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param Template $template An instance of the front-end temlate rendering handler.
	 */
	public function __construct( Template $template ) {
		$this->template = $template;
	}

	/**
	 * Insert virtual details into ticket email template.
	 *
	 * @since 1.0.0
	 *
	 * @param array<string,mixed> $ticket Ticket data.
	 * @param WP_Post             $event  Event post object.
	 */
	public function insert_virtual_info_into_ticket_email( $ticket, $event ) {
		// Bail if Event Tickets isn't active.
		if ( ! class_exists( 'Tribe__Tickets__Main' ) ) {
			return;
		}

		// Bail if we're missing info.
		if ( empty( $ticket ) || empty( $event ) ) {

			return;
		}

		// Make sure we have the event object.
		$event_obj = tribe_get_event( $event );

		// Bail if we don't have a provider.
		if ( empty( $ticket['provider'] ) ) {
			return;
		}

		if ( 'Tribe__Tickets__RSVP' === $ticket['provider'] ) {
			if ( empty( $event_obj->virtual_rsvp_email_link ) ) {

				// Or we've toggled off injection for RSVP.
				return;
			}
		} elseif ( empty( $event_obj->virtual_ticket_email_link ) ) {
			// Or if we've toggled off injection for tickets.
			return;
		}

		$args = [
			'event' => $event_obj,
		];

		/**
		 * Filter the template used for the email injection.
		 *
		 * @since 1.0.0
		 *
		 * @param string              $template_name The template path, relative to src/views.
		 * @param array<string,mixed> $args          The template arguments.
		 */
		$template_name = apply_filters(
			'tribe_events_virtual_ticket_email_template',
			'email/ticket-email-link',
			$args
		);

		$this->template->template( $template_name, $args, true );
	}


	/**
	 * Use old filter and regex to inject virtual event data.
	 *
	 * @TODO @stephen: Kill this when the tribe_tickets_ticket_email_after_details action is in place in ET.
	 *
	 * @since 1.0.0
	 *
	 * @param string             $html      The current HTML.
	 * @param string             $slug      Slug for this template.
	 * @param array              $data      The Data that will be used on this template.
	 *
	 * @return string $html            The final HTML
	 */
	public function filter_ticket_email_content( $html, $slug, $data ) {
		// Won't get far without a ticket.
		if ( empty( $data['tickets'] ) ) {
			return $html;
		}

		// Wrong template.
		if ( 'tickets/email' !== $slug ) {
			return $html;
		}

		// Compatibility with ET <= 4.12.1.
		if ( did_action( 'tribe_tickets_ticket_email_after_details' ) ) {
			return $html;
		}

		foreach ( $data['tickets'] as $ticket ) {
			$event = tribe_get_event( $ticket['event_id'] );

			// I'm sorry Dave, I can't do that.
			if ( ! $event ) {
				continue;
			}

			// Ticket type & settings checks.
			if ( 'rsvp' === $ticket['provider_slug'] ) {
				if ( empty( $event->virtual_rsvp_email_link ) ) {
					// It's an RSVP and we've toggled that off.
					continue;
				}
			} elseif ( empty( $event->virtual_ticket_email_link ) ) {
				// It's a Ticket and we've toggled that off.
				continue;
			}

			ob_start();
			$this->insert_virtual_info_into_ticket_email( $ticket, $event );
			$new_content = ob_get_clean();
		}

		if ( empty( $new_content ) ) {
			return $html;
		}

		$delimiter = '<table class="whiteSpace';
		$sections  = explode( $delimiter, $html );

		foreach ( $sections as $index => $section ) {
			if ( false === stripos( $section, '<table class="ticket-details' ) ) {
				continue;
			}

			// Insert template.
			$sections[ $index ] .= $new_content;
		}

		$html = implode( $delimiter, $sections );

		return $html;
	}
}

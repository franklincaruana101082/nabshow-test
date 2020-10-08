<?php
/**
 * Shortcode Tribe_Tickets_Additional_Field.
 *
 * @package Tribe\Extensions\Tickets\Additional_Fields
 * @since   1.0.0
 */

namespace Tribe\Extensions\Tickets\Additional_Fields\Shortcodes;

/**
 * Class for Shortcode Tribe_Tickets_Additional_Field.
 * @since   1.0.0
 * @package Tribe\Extensions\Tickets\Tribe_Tickets_Additional_Field
 */
class Tribe_Tickets_Additional_Field extends \Tribe\Extensions\Tickets\Shortcodes\Shortcodes\Shortcode_Abstract {

	/**
	 * {@inheritDoc}
	 */
	protected $slug = 'tribe_tickets_additional_field';

	/**
	 * {@inheritDoc}
	 */
	protected $default_arguments = [
		'ticket_id'         => null,
		'field'             => '',
	];

	/**
	 * {@inheritDoc}
	 */
	public function get_html() {
		$context = tribe_context();

		if ( is_admin() && ! $context->doing_ajax() ) {
			return '';
		}

		$ticket_id = $this->get_argument( 'ticket_id' );
		$field     = $this->get_argument( 'field' );

		return $this->get_additional_field( $ticket_id, $field );
	}

	/**
	 * Gets the additional field
	 *
	 * @param WP_Post|int $ticket   the post/event we're viewing.
	 * @param string      $field_id the additional field we want to retrieve.
	 *
	 * @return string HTML.
	 */
	public function get_additional_field( $ticket, $field ) {

		if ( ! tribe( 'tickets.additional-fields.fields' )->field_exist( $field ) ) {
			return '';
		}

		if ( empty( $ticket ) ) {
			return '';
		}

		if ( is_numeric( $ticket ) ) {
			$ticket = get_post( $ticket );
		}

		// if password protected then do not display content
		if ( post_password_required() ) {
			return '';
		}

		$ticket_id = $ticket->ID;

		$meta       = tribe( 'tickets.additional-fields.fields' );
		$field_type = $meta->get_field_type( $field );

		switch ( $field_type ) {
			case 'url':
				$html = $this->get_url_render( $ticket_id, $field );
				break;
			case 'email':
				$html = $this->get_email_render( $ticket_id, $field );
				break;
			default:
				$html = $meta->get_field_value( $ticket_id, $meta->get_field_id( $field ), true );
		}

		/**
		 * Filter `tribe_tickets_additional_field_shortcode_html`.
		 *
		 * @since 1.0.0
		 *
		 * @param string $html     The HTML rendered by the shortcode.
		 * @param int    $ticket_id The ticket ID coming from the shortcode parameter.
		 * @param string $field     The field key coming from the shortcode parameter.
		 */
		$html = apply_filters( 'tribe_tickets_additional_field_shortcode_html', $html, $ticket_id, $field );

		return $html;
	}

	/**
	 * Gets the additional render, when it's URL type
	 *
	 * @param WP_Post|int $ticket   the post/event we're viewing.
	 * @param string      $field_id the additional field we want to retrieve.
	 *
	 * @return string The resulting HTML.
	 */
	public function get_url_render( $ticket_id, $field ) {
		$meta  = tribe( 'tickets.additional-fields.fields' );
		$url = $meta->get_field_value( $ticket_id, $meta->get_field_id( $field ), true );

		return '<a href="' . $url . '">' . $url . '</a>';
	}


	/**
	 * Gets the additional render, when it's Email type
	 *
	 * @param WP_Post|int $ticket   the post/event we're viewing.
	 * @param string      $field_id the additional field we want to retrieve.
	 *
	 * @return string The resulting HTML.
	 */
	public function get_email_render( $ticket_id, $field ) {
		$meta  = tribe( 'tickets.additional-fields.fields' );
		$email = $meta->get_field_value( $ticket_id, $meta->get_field_id( $field ), true );

		return '<a href="mailto:' . $email . '">' . $email . '</a>';
	}

}

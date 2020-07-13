<?php
/**
 * An extension of The Events Calendar base repository to support Virtual functions.
 *
 * @since   1.0.1
 * @package Tribe\Events\Virtual\Repositories
 */

namespace Tribe\Events\Virtual\Repositories;

use Tribe\Events\Virtual\Event_Meta;

/**
 * Class Event
 *
 * @package Tribe\Events\Virtual\Repositories
 */
class Event extends \Tribe__Repository__Decorator {

	/**
	 * Event constructor.
	 *
	 * @since 1.0.1
	 */
	public function __construct() {
		if ( tribe()->isBound( 'events-pro.event-repository' ) ) {
			// If there's a PRO repository, decorate that.
			$this->decorated = tribe( 'events-pro.event-repository' );
		} else {
			// Decorate The Events Calendar repository.
			$this->decorated = tribe( 'events.event-repository' );
		}
		$this->decorated->add_schema_entry( 'virtual', array( $this, 'filter_by_virtual' ) );
	}

	/**
	 * Filters events to include only those that match the provided virtual state.
	 *
	 * @since 1.0.1
	 *
	 * @param bool $virtual Whether the events should be virtual or not.
	 */
	public function filter_by_virtual( $virtual = true ) {
		$this->decorated->by( (bool) $virtual ? 'meta_exists' : 'meta_not_exists', Event_Meta::$key_virtual, '#' );
	}
}

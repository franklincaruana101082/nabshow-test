<?php
/**
 * Provides methods to route requests to a class method parsing a string route.
 *
 * @since   1.0.0
 *
 * @package Tribe\Events\Virtual\Traits
 */

namespace Tribe\Events\Virtual\Traits;

use Tribe__Utils__Array as Arr;

/**
 * Trait With_String_Routing
 *
 * @since   1.0.0
 *
 * @package Tribe\Events\Virtual\Tests\Traits
 *
 * @property array<string> $string_routes An array defining the string routes handled by the object.
 */
trait With_String_Routing {

	/**
	 * Routes a request to a handler based on a string route.
	 *
	 * Each handler is an entry in the same format that would be used to define a callable using an array:
	 * `[ $object, $method ]`. The handlers will not be called directly, though, as they will be fed into the `tribe`
	 * service locator to be built first.

	 * @since 1.0.0
	 *
	 * @param string $route The route, in string, pipe-concatenated form, to handle.
	 *
	 * @return bool Whether the string route was handled or not.
	 */
	public function route( $route ) {
		if ( empty( $this->string_routes ) ) {
			return false;
		}

		$frags   = explode( '|', $route );
		$data    = array_splice( $frags, - 1, 1 );
		$handler = Arr::get( $this->string_routes, $frags, false );

		if ( false === $handler ) {
			return false;
		}

		if ( is_array( $handler ) && 2 === count( $handler ) ) {
			$instance = is_object( $handler[0] ) ? $handler[0] : tribe( $handler[0] );
			$method   = $handler[1];

			call_user_func( [ $instance, $method ], reset( $data ) );

			return true;
		}

		if ( is_callable( $handler ) ) {
			return $handler( reset( $data ) );
		}

		return false;
	}
}

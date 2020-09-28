<?php

namespace AutomateWoo;

/**
 * Coupon management class.
 *
 * @since 2.9
 */
class Coupons {


	/**
	 * Offset coupon cleaning event to avoid overloading the 4 hour worker
	 */
	public static function schedule_clean_expired() {
		if ( AW()->options()->clean_expired_coupons ) {
			Events::schedule_event( time() + ( MINUTE_IN_SECONDS * 5 ), 'automatewoo/coupons/clean_expired' );
		}
	}

	/**
	 * Get expired coupons to delete.
	 *
	 * @since 4.8.1
	 *
	 * @return array
	 */
	protected static function get_coupons_to_delete() {
		$limit         = (int) apply_filters( 'automatewoo/coupons/clean_expired_limit', 20 );
		$deletion_date = self::get_deletion_date();

		if ( ! $deletion_date ) {
			return [];
		}

		$query_args = [
			'fields'         => 'ids',
			'post_type'      => 'shop_coupon',
			'post_status'    => 'any',
			'posts_per_page' => $limit,
			'orderby'        => 'date',
			'order'          => 'ASC',
			'no_found_rows'  => true,
			'meta_query'     => [
				[
					'key'   => '_is_aw_coupon',
					'value' => true,
				],
				[
					'key'     => 'date_expires',
					'value'   => $deletion_date->getTimestamp(),
					'compare' => '<',
				],
			],
		];

		$query = new \WP_Query( $query_args );

		return $query->posts;
	}


	/**
	 * Delete a set amount of expired coupons that were generated by AW
	 */
	public static function clean_expired() {
		$coupons       = self::get_coupons_to_delete();
		$did_delete    = false;
		$deletion_date = self::get_deletion_date();

		foreach ( $coupons as $coupon_id ) {
			// Double check coupon should be deleted
			if ( self::coupon_should_be_deleted( $coupon_id, $deletion_date ) ) {
				$did_delete = true;
				wp_delete_post( $coupon_id, true );
			}
		}

		// If any coupons were deleted there may be more, so schedule another batch
		if ( $did_delete ) {
			Events::schedule_event( time() + 5, 'automatewoo/coupons/clean_expired' );
		}
	}

	/**
	 * Get coupon deletion date.
	 *
	 * Coupons which an expiry date before this date should be deleted.
	 *
	 * @since 4.8.1
	 *
	 * @return DateTime|false
	 */
	protected static function get_deletion_date() {
		$days_to_keep_expired = absint( apply_filters( 'automatewoo/coupons/days_to_keep_expired', 14 ) );
		return aw_normalize_date( "-$days_to_keep_expired days" );
	}

	/**
	 * Determine if a coupon should be deleted.
	 *
	 * @since 4.8.1
	 *
	 * @param int      $coupon_id
	 * @param DateTime $deletion_date Optionally set the coupon deletion date.
	 *
	 * @return bool
	 */
	protected static function coupon_should_be_deleted( $coupon_id, $deletion_date = null ) {
		$coupon        = new \WC_Coupon( $coupon_id );
		$deletion_date = $deletion_date ?: self::get_deletion_date();

		if ( ! $coupon || ! $coupon->get_date_expires() || ! $deletion_date ) {
			return false;
		}

		if ( ! $coupon->get_meta( '_is_aw_coupon' ) ) {
			return false;
		}

		return $coupon->get_date_expires() < $deletion_date;
	}

}
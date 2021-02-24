<?php

/**
 * Estimate_Ranges Controller
 *
 * @package Sprout_Invoice
 * @subpackage Estimate_Ranges
 */
class SI_Estimate_Ranges extends SI_Controller {


	public static function init() {

		add_filter( 'si_line_item_columns', array( __CLASS__, 'add_range_column' ), 10, 3 );

		add_filter( 'si_format_front_end_line_item_value', array( __CLASS__, 'format_front_end_ranges' ), PHP_INT_MAX, 3 );

		add_filter( 'si_line_item_totals', array( __CLASS__, 'modify_line_item_totals' ), 10, 2 );

	}

	///////////
	// Admin //
	///////////

	public static function add_range_column( $columns = array(), $type = '', $item_data = array() ) {

		if ( SI_Estimate::POST_TYPE !== get_post_type() ) {
			return $columns;
		}

		if ( is_single() ) {

			if ( ! isset( $item_data['ranges'] ) || 0.01 > $item_data['ranges'] ) {
				return $columns;
			}

			unset( $columns['rate'] );
			unset( $columns['qty'] );

			$columns['total']['label'] = __( 'Min&nbsp;/&nbsp;Max Amount', 'sprout-invoices' );

			return $columns;
		}

		$columns['ranges'] = array(
				'label' => sprintf( 'Estimate Range&nbsp;<span class="helptip" title="%s"></span>', __( 'This percentage will be used to calculate the range total.', 'sprout-invoices' ) ),
				'type' => 'small-input',
				'placeholder' => 0,
				'calc' => false,
				'hide_if_parent' => true,
				'weight' => 25,
			);

		return $columns;
	}

	public static function format_front_end_ranges( $value = '', $column_slug = '', $item_data = array() ) {

		if ( SI_Estimate::POST_TYPE !== get_post_type() ) {
			return $value;
		}

		if ( ! isset( $item_data['ranges'] ) || 0.01 > $item_data['ranges'] ) {
			return $value;
		}
		switch ( $column_slug ) {
			case 'ranges':
				$value = false;
				break;
			case 'total':
					$subtotal = ( $item_data['rate'] * $item_data['qty'] );
					$rangeab = ($item_data['ranges'] / 2) / 100;
					$above = $subtotal + ( $subtotal * $rangeab );
					$below = $subtotal - ( $subtotal * $rangeab );
					$value = sprintf( '%1$s&nbsp;/&nbsp;%2$s', sa_get_formatted_money( $below ), sa_get_formatted_money( $above ) );
				break;
			default:
				break;
		}

		return $value;
	}

	public static function modify_line_item_totals( $totals = array(), $doc_id = 0 ) {
		if ( ! $doc_id ) {
			$doc_id = get_the_id();
		}

		if ( SI_Estimate::POST_TYPE !== get_post_type( $doc_id ) ) {
			return $totals;
		}

		$line_items = si_get_doc_line_items( $doc_id );
		if ( empty( $line_items ) ) {
			return $totals;
		}

		$has_ranges = false;
		$sbtotalabove = $totals['subtotal']['value'];
		$sbtotalbelow = $totals['subtotal']['value'];
		$totalabove = $totals['total']['value'];
		$totalbelow = $totals['total']['value'];
		foreach ( $line_items as $position => $item_data ) {
			$calc = 0;
			$line_total = 0;
			if ( isset( $item_data['ranges'] ) && 0.00 < $item_data['ranges'] ) {
				$line_total = $item_data['total'];
				$rangeab = ($item_data['ranges'] / 2) / 100;
				$calc = ( $line_total * $rangeab );
				$sbtotalbelow = $sbtotalbelow - $calc;
				$sbtotalabove = $sbtotalabove + $calc;
				$totalbelow = $totalbelow - $calc;
				$totalabove = $totalabove + $calc;
				$has_ranges = true;
			}
		}

		if ( ! $has_ranges ) {
			return $totals;
		}

		$totals['subtotal']['label'] = __( 'Estimated Subtotal', 'sprout-invoices' );
		$totals['subtotal']['formatted'] = sprintf( '%1$s - %2$s', sa_get_formatted_money( $sbtotalbelow ), sa_get_formatted_money( $sbtotalabove ) );

		$totals['total']['label'] = __( 'Estimated Total', 'sprout-invoices' );
		$totals['total']['formatted'] = sprintf( '%1$s - %2$s', sa_get_formatted_money( $totalbelow ), sa_get_formatted_money( $totalabove ) );

		return $totals;

	}
}

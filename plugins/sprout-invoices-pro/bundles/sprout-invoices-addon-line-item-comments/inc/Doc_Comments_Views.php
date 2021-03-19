<?php

/**
 * Doc Comments Controller
 *
 * @package Sprout_Invoice
 * @subpackage Doc_Comments
 */
class SI_Doc_Comments_Views extends SI_Doc_Comments {

	public static function init() {

		// Enqueue
		add_action( 'si_head', array( __CLASS__, 'si_add_stylesheet' ) );

		// Add comment options for the line items
		add_action( 'si_get_front_end_line_item_post_row', array( __CLASS__, 'add_line_item_comment_form' ), 10, 4 );
		add_action( 'si_get_front_end_line_item_pre_row', array( __CLASS__, 'toggle_line_item_comments' ), 10, 4 );

	}

	//////////////
	// Enqueue //
	//////////////

	public static function si_add_stylesheet() {
		echo '<script type="text/javascript" src="' . SA_ADDON_DOC_COMMENTS_URL . '/resources/front-end/js/doc_comments.js"></script>';
	}


	///////////////
	// Frontend //
	///////////////

	public static function add_line_item_comment_form( $data = array(), $position = 1.0, $prev_type = '', $has_children = false ) {
		if ( ! $has_children ) {
			$_id = self::get_comment_line_item_id( $position, get_the_id() );
			$comments = self::get_line_item_comments( get_the_id(), $_id );
			echo '<div class="line_items_comments_wrap">'; // a wrapper is used to keep ajax loading simple
			print self::load_addon_view( 'public/line-items-comments', array(
					'doc_id' => get_the_id(),
					'position' => $_id,
					'comments' => $comments,
			), false );
			echo '</div>';
		}
	}


	public static function toggle_line_item_comments( $data = array(), $position = 1.0, $prev_type = '', $has_children = false ) {
		if ( ! $has_children ) {
			$_id = self::get_comment_line_item_id( $position, get_the_id() );
			$comments = self::get_line_item_comments( get_the_id(), $_id );
			$active = ( ! empty( $comments ) ) ? 'has_comments' : '' ;
			$toggle = '<a href="javascript:void(0)" class="li_comments_toggle '.$active.'" data-li_position="'.str_replace( '.', '-', $_id ).'"><svg width="20" height="20" viewBox="0 0 40 40"><g transform="scale(0.03125 0.03125)"><path d="M480 128c-50.666 0-99.582 7.95-145.386 23.628-42.924 14.694-81.114 35.436-113.502 61.646-60.044 48.59-93.112 110.802-93.112 175.174 0 35.99 10.066 70.948 29.92 103.898 20.686 34.34 51.898 65.794 90.26 90.958 30.44 19.968 50.936 51.952 56.362 87.95 0.902 5.99 1.63 12.006 2.18 18.032 2.722-2.52 5.424-5.114 8.114-7.794 24.138-24.040 56.688-37.312 90.322-37.312 5.348 0 10.718 0.336 16.094 1.018 19.36 2.452 39.124 3.696 58.748 3.696 50.666 0 99.58-7.948 145.384-23.628 42.926-14.692 81.116-35.434 113.504-61.644 60.046-48.59 93.112-110.802 93.112-175.174 0-64.372-33.066-126.582-93.112-175.174-32.388-26.212-70.578-46.952-113.504-61.646-45.804-15.678-94.718-23.628-145.384-23.628zM480 0v0c265.096 0 480 173.914 480 388.448s-214.904 388.448-480 388.448c-25.458 0-50.446-1.62-74.834-4.71-103.106 102.694-222.172 121.108-341.166 123.814v-25.134c64.252-31.354 116-88.466 116-153.734 0-9.106-0.712-18.048-2.030-26.794-108.558-71.214-177.97-179.988-177.97-301.89 0-214.534 214.904-388.448 480-388.448zM996 870.686c0 55.942 36.314 104.898 92 131.772v21.542c-103.126-2.318-197.786-18.102-287.142-106.126-21.14 2.65-42.794 4.040-64.858 4.040-95.47 0-183.408-25.758-253.614-69.040 144.674-0.506 281.26-46.854 384.834-130.672 52.208-42.252 93.394-91.826 122.414-147.348 30.766-58.866 46.366-121.582 46.366-186.406 0-10.448-0.45-20.836-1.258-31.168 72.57 59.934 117.258 141.622 117.258 231.676 0 104.488-60.158 197.722-154.24 258.764-1.142 7.496-1.76 15.16-1.76 22.966z"></path></g></svg></a>';
			echo apply_filters( 'si_toggle_line_item_comments', $toggle );
		}
	}
}

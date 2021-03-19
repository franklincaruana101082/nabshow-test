<?php

/**
 * Doc Comments Controller
 *
 * @package Sprout_Invoice
 * @subpackage Doc_Comments
 */
class SI_Doc_Comments_Admin extends SI_Doc_Comments {

	public static function init() {

		if ( is_admin() ) {
			// Enqueue
			add_action( 'admin_enqueue_scripts', array( __CLASS__, 'register_resources' ) );
			add_action( 'admin_enqueue_scripts', array( __CLASS__, 'admin_enqueue' ), 20 );

			add_action( 'si_line_item_build_option_action_row', array( __CLASS__, 'add_option_action' ), 10, 4 );

			// Add comments to history
			add_action( 'si_doc_history_records_pre_sort', array( __CLASS__, 'add_comments_to_history' ), 10, 3 );

			// Filter from widget and others places
			add_action( 'pre_get_comments', array( __CLASS__, 'hide_comments' ) );

		}

	}

	//////////////
	// Enqueue //
	//////////////

	public static function register_resources() {
		// admin js
		wp_register_script( 'si_doc_comments', SA_ADDON_DOC_COMMENTS_URL . '/resources/admin/js/comments.js', array( 'jquery' ), self::SI_VERSION );
	}

	public static function admin_enqueue() {
		add_thickbox();
		wp_enqueue_script( 'si_doc_comments' );
	}

	////////////
	// admin //
	////////////

	public static function add_option_action( $data = array(), $items = array(), $position = 1.0, $children = array() ) {
		$doc_id = get_the_id();
		if ( ! $doc_id ) {
			return;
		}
		if ( empty( $children ) ) {
			$_id = self::get_comment_line_item_id( $position );
			$comments = self::get_line_item_comments( get_the_id(), $_id );
			$active = ( ! empty( $comments ) ) ? 'has_comments' : '' ;
			$toggle = '<div class="item_action item_comments show_doc_comments_modal '.$active.'" data-doc_id="'.$doc_id.'" data-li_position="'.$_id.'"><span class="dashicons dashicons-format-chat"></span></div>';
			echo apply_filters( 'si_admin_option_action_comments', $toggle );
		}
	}

	///////////
	// Admin //
	///////////


	public static function add_comments_to_history( $history = array(), $doc_id = 0, $filtered = true ) {
		$comment_ids = array();
		$comments = self::get_doc_comments( $doc_id );
		foreach ( $comments as $comment ) {
			$comment_ids[] = $comment->comment_ID;
		}
		return array_merge( $comment_ids, $history );
	}

		/**
	 * Exclude comments from showing in Recent Comments widgets
	 *
	 * @since 1.4.1
	 * @param obj $query WordPress Comment Query Object
	 * @return void
	 */
	public static function hide_comments( $query ) {
		if ( is_admin() ) {
			return;
		}
	    global $wp_version;

		if ( version_compare( floatval( $wp_version ), '4.1', '>=' ) ) {

			if ( isset( $query->query_vars['type'] ) && self::DOC_COMMENT_TYPE === $query->query_vars['type'] ) {
				return;
			}

			$types = array();
			if ( isset( $query->query_vars['type__not_in'] ) ) {
				$type = ( is_array( $query->query_vars['type__not_in'] ) ) ? $query->query_vars['type__not_in'] : array( $query->query_vars['type__not_in'] ) ;
			}
			$types[] = self::DOC_COMMENT_TYPE;
			$query->query_vars['type__not_in'] = $types;
		}
	}
}

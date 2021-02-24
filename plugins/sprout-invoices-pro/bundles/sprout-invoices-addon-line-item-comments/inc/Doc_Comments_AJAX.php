<?php

/**
 * Doc Comments Controller
 *
 * @package Sprout_Invoice
 * @subpackage Doc_Comments
 */
class SI_Doc_Comments_AJAX extends SI_Doc_Comments {

	public static function init() {

		// localize
		add_filter( 'si_admin_scripts_localization',  array( __CLASS__, 'ajax_l10n' ) );

		// callbacks
		add_action( 'wp_ajax_sa_create_doc_comment',  array( get_class(), 'maybe_create_doc_comment' ), 10, 0 );
		add_action( 'wp_ajax_nopriv_sa_create_doc_comment',  array( get_class(), 'maybe_create_doc_comment' ), 10, 0 );

		// VIEWS
		add_action( 'wp_ajax_sa_comments_view',  array( __CLASS__, 'comments_view' ), 10, 0 );
		add_action( 'wp_ajax_nopriv_sa_comments_view',  array( get_class(), 'comments_view' ), 10, 0 );
		add_action( 'wp_ajax_sa_comments_admin_view',  array( __CLASS__, 'comments_admin_view' ), 10, 0 );

	}

	//////////////////
	// Localization //
	//////////////////

	public static function ajax_l10n( $js_object = array() ) {
		$js_object['doc_comments_modal_title'] = __( 'Line Item Discussion', 'sprout-invoices' );
		$js_object['doc_comments_modal_url'] = admin_url( 'admin-ajax.php?action=sa_comments_admin_view&height=300' );
		$js_object['doc_comments_success_message'] = __( 'Comment Added!', 'sprout-invoices' );
		return $js_object;
	}



	////////////////
	// AJAX View //
	////////////////


	public static function comments_view() {
		if ( isset( $_REQUEST['doc_id'] ) ) {
			$doc_id = $_REQUEST['doc_id'];
		}

		if ( ! $doc_id ) {
			self::ajax_fail( 'No doc id' );
		}

		$position = '';
		if ( isset( $_REQUEST['li_position'] ) ) {
			$position = $_REQUEST['li_position'];
		}

		$_id = self::get_comment_line_item_id( $position, $doc_id );
		$comments = self::get_line_item_comments( $doc_id, $_id );
		print self::load_addon_view( 'public/line-items-comments', array(
				'doc_id' => $doc_id,
				'position' => $_id,
				'comments' => $comments,
		), false );
		exit();
	}

	public static function comments_admin_view() {
		if ( ! current_user_can( 'edit_sprout_invoices' ) ) {
			self::ajax_fail( 'User cannot create new posts!' );
		}

		if ( isset( $_REQUEST['doc_id'] ) ) {
			$doc_id = $_REQUEST['doc_id'];
		}

		if ( ! $doc_id ) {
			self::ajax_fail( 'No doc id' );
		}

		$position = '';
		if ( isset( $_REQUEST['li_position'] ) ) {
			$position = $_REQUEST['li_position'];
		}

		$_id = self::get_comment_line_item_id( $position, $doc_id );
		$comments = self::get_line_item_comments( $doc_id, $_id );
		self::load_addon_view( 'admin/section/comments-modal', array(
				'comments' => $comments,
				'position' => $position,
				'doc_id' => $doc_id,
		), false );
		exit();
	}

	//////////////
	// Callback //
	//////////////

	public static function maybe_create_doc_comment() {
		if ( ! isset( $_REQUEST['doc_comment_sec'] ) ) {
			self::ajax_fail( 'Forget something?' ); }

		$nonce = $_REQUEST['doc_comment_sec'];
		if ( ! wp_verify_nonce( $nonce, SI_Controller::NONCE ) ) {
			self::ajax_fail( 'Not going to fall for it!' ); }

		if ( ! isset( $_REQUEST['comment'] ) ) {
			self::ajax_fail( 'No comment submitted.' );
		}

		if ( $_REQUEST['comment'] == '' ) {
			self::ajax_fail( 'No comment submitted.' );
		}

		if ( ! isset( $_REQUEST['id'] ) ) {
			self::ajax_fail( 'No doc associated.' );
		}

		$doc_id = (int) $_REQUEST['id'];
		$doc = si_get_doc_object( $doc_id );
		if ( ! is_a( $doc, 'SI_Estimate' ) && ! is_a( $doc, 'SI_Invoice' ) ) {
			self::ajax_fail( 'Not correct post type.' );
		}

		$comment = esc_textarea( $_REQUEST['comment'] );
		$item_position = ( isset( $_REQUEST['item_position'] ) ) ? (float) $_REQUEST['item_position'] : 0 ;

		$comment_id = self::create_comment( $doc_id, self::comment_data( $doc_id, $comment ), $item_position );
		if ( ! $comment_id ) {
			self::ajax_fail( 'Something went wrong.' );
		}

		$response_data = array(
				'comment' => $comment,
				'comment_id' => $comment_id,
				'position' => $item_position,
				'response' => __( 'Comment Received', 'sprout-invoices' ),
			);
		header( 'Content-type: application/json' );
		if ( self::DEBUG ) { header( 'Access-Control-Allow-Origin: *' ); }
		echo wp_json_encode( $response_data );
		exit();
	}
}

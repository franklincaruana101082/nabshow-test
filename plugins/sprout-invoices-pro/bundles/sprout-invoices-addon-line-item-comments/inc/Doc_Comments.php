<?php

/**
 * Doc Comments Controller
 *
 * @package Sprout_Invoice
 * @subpackage Doc_Comments
 */
class SI_Doc_Comments extends SI_Controller {
	const DOC_COMMENT_TYPE = 'si_doc_comment';
	const DOC_COMMENT_META_POS = 'si_line_item_id';

	private static $meta_keys = array();

	public static function init() {
		// child classes
	}

	public static function get_comment_line_item_id( $position = 0.00, $doc_id = 0 ) {
		if ( ! $doc_id ) {
			$doc_id = get_the_id();
		}
		$id = si_get_line_item_value( $doc_id, $position, '_id' );
		if ( '' === $id ) {
			// fallback to the line item position if this line item is pre 9.0
			return $position;
		}
		return $id;
	}

	public static function create_comment( $doc_id = 0, $data = array(), $line_item = 0 ) {
		if ( ! $doc_id ) {
			$doc_id = get_the_ID();
		}
		$doc = si_get_doc_object( $doc_id );
		if ( ! is_a( $doc, 'SI_Estimate' ) && ! is_a( $doc, 'SI_Invoice' ) ) {
			return 0;
		}

		$defaults = array(
			'comment_post_ID' => $doc_id,
			'comment_content' => __( 'Comment N/A', 'sprout-invoices' ),
			'user_id' => 0,
			'comment_author_email' => 'unknown',
			'comment_author' => 'unknown',
			'comment_author_url' => 'unknown',
			'comment_type' => self::DOC_COMMENT_TYPE,
			'comment_parent' => 0,
			'comment_author_IP' => '127.0.0.1',
			'comment_agent' => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.10) Gecko/2009042316 Firefox/3.0.10 (.NET CLR 3.5.30729)',
			'comment_date' => current_time( 'mysql' ),
			'comment_approved' => 1,
		);
		$data = wp_parse_args( $data, $defaults );

		$comment_id = wp_insert_comment( $data );

		if ( $line_item ) {
			add_comment_meta( $comment_id, self::DOC_COMMENT_META_POS, $line_item );
		}
		do_action( 'si_insert_doc_comment', $comment_id, $doc, $data, $line_item );
		return $comment_id;
	}


	public static function get_doc_comments( $doc_id = 0 ) {
		if ( ! $doc_id ) {
			$doc_id = get_the_ID();
		}
		$args = array(
			'post_id' => $doc_id,
			'type' => self::DOC_COMMENT_TYPE,
			'order' => 'ASC',
			);
		$query = new WP_Comment_Query;
		$comments = $query->query( $args );
		return $comments;
	}

	public static function get_line_item_comments( $doc_id = 0, $id = 0 ) {
		if ( ! $doc_id ) {
			$doc_id = get_the_ID();
		}
		$args = array(
			'post_id' => (int) $doc_id,
			'type' => self::DOC_COMMENT_TYPE,
			'order' => 'ASC',
			'meta_query' => array(
				'relation' => 'OR',
				array(
					'key' => self::DOC_COMMENT_META_POS,
					'value' => (float) $id,
					),
				),
			);
		$query = new WP_Comment_Query;
		$comments = $query->query( $args );
		return $comments;
	}

	public static function comment_data( $doc_id = 0, $comment = '' ) {
		$user_id = 0;
		$author_email = __( 'unknown', 'sprout-invoices' );
		$author = __( 'unknown', 'sprout-invoices' );
		$author_url = __( 'unknown', 'sprout-invoices' );

		$user = wp_get_current_user();
		$doc = si_get_doc_object( $doc_id );

		// If the user isn't logged in than determine comment info from
		// the docs client info
		if ( ! $user->exists() ) {
			$client = $doc->get_client();
			if ( ! is_wp_error( $client ) ) {
				$client_users = $client->get_associated_users();
				$client_user_id = array_shift( $client_users );
				$user = get_userdata( $client_user_id );
			}
		}

		// Use the user data to set the comment info
		if ( $user->exists() ) {
			$user_id = $user->ID;
			$author_email = $user->user_email;
			$author = $user->display_name;
			$author_url = $user->website;
		}
		$data = array(
			'comment_post_ID' => $doc_id,
			'comment_content' => $comment,
			'user_id' => $user_id,
			'comment_author_email' => $author_email,
			'comment_author' => $author,
			'comment_author_url' => $author_url,
		);
		return $data;
	}


	//////////////
	// Utility //
	//////////////

	public static function load_addon_view( $view, $args, $allow_theme_override = true ) {
		add_filter( 'si_views_path', array( __CLASS__, 'addons_view_path' ) );
		$view = self::load_view( $view, $args, $allow_theme_override );
		remove_filter( 'si_views_path', array( __CLASS__, 'addons_view_path' ) );
		return $view;
	}

	public static function load_addon_view_to_string( $view, $args, $allow_theme_override = true ) {
		ob_start();
		self::load_addon_view( $view, $args, $allow_theme_override );
		return ob_get_clean();
	}

	public static function addons_view_path() {
		return SA_ADDON_DOC_COMMENTS_PATH . '/views/';
	}
}

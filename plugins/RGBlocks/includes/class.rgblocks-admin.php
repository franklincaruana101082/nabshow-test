<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package RGBlocks
 * @since 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class RGBlocks_Admin
 */
class RGBlocks_Admin {

	/**
	 * RGBlocks_Admin constructor.
	 */
	function __construct() {

		add_action( 'enqueue_block_editor_assets', array( $this, 'rgblocks_add_block_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'rgblocks_add_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'rgblocks_add_admin_scripts' ) );

		// Action to add taxonomy to wp_block post type
		add_action( 'init', array( $this, 'rgblocks_add_block_category_taxonomy' ) );

		// Action to enable thumbnail in wp_block post type
		add_action( 'registered_post_type', array( $this, 'rgblocks_enable_block_thumbnail' ), 10, 2 );

		// Filter for add custom post where
		add_filter( 'posts_where', array( $this, 'rgblocks_set_custom_post_title_search' ), 10, 2 );
	}

	/**
	 * Register RGBlocks with script and style
	 */
	public function rgblocks_add_block_scripts() {

		wp_enqueue_script(
			'rgblocks-gutenberg-block',
			RGBLOCKS_URL . 'assets/js/gutenberg-block/block.build.js',
			array(
				'wp-blocks',
				'wp-i18n',
				'wp-element',
				'wp-editor',
				'wp-components',
			)
		);
		wp_enqueue_style( 'rgblocks-gutenberg-block-backend-css', RGBLOCKS_URL . 'assets/css/block.css', array( 'wp-edit-blocks' ) );
		register_block_type(
			'rgblocks-gutenberg-block/custom-block',
			array(
				'editor_script' => 'rgblocks-gutenberg-block',
				'editor_style'  => 'rgblocks-gutenberg-block-backend-css',
			)
		);
	}

	/**
	 * Added admin style for RGBlocks
	 */
	public function rgblocks_add_admin_styles() {
		wp_enqueue_style( 'font-awesome-css', 'https://use.fontawesome.com/releases/v5.7.2/css/all.css', false );
		wp_enqueue_style( 'font-awesome', RGBLOCKS_URL . 'assets/css/font-awesome.min.css', array() );
		wp_enqueue_style( 'add-google-fonts', 'https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700,800', false );
		wp_enqueue_style( 'rgblocks-gutenberg-block-backend-css', RGBLOCKS_URL . 'assets/css/block.css', array( 'wp-edit-blocks' ) );
	}

	/**
	 * RGBlocks Admin script
	 */
	public function rgblocks_add_admin_scripts() {
		wp_enqueue_script( array( 'jquery-ui-core', 'jquery-ui-tabs' ) );
	}

	/**
	 * Create block category taxonomy for wp_block post type
	 */
	public function rgblocks_add_block_category_taxonomy() {

		$labels = array(
			'name'              => _x( 'Category', 'taxonomy general name', 'nabshow-lv' ),
			'singular_name'     => _x( 'Category', 'taxonomy singular name', 'nabshow-lv' ),
			'search_items'      => __( 'Search Categories', 'nabshow-lv' ),
			'all_items'         => __( 'All Categories', 'nabshow-lv' ),
			'parent_item'       => __( 'Parent Category', 'nabshow-lv' ),
			'parent_item_colon' => __( 'Parent Category:', 'nabshow-lv' ),
			'edit_item'         => __( 'Edit Category', 'nabshow-lv' ),
			'update_item'       => __( 'Update Category', 'nabshow-lv' ),
			'add_new_item'      => __( 'Add New Category', 'nabshow-lv' ),
			'new_item_name'     => __( 'New Genre Category', 'nabshow-lv' ),
			'menu_name'         => __( 'Categories', 'nabshow-lv' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'block-category' ),
		);

		register_taxonomy( 'block-category', array( 'wp_block' ), $args );

	}

	/**
	 * Enable thumbnail support for wp_block post type
	 * @param $post_type
	 */
	public function rgblocks_enable_block_thumbnail( $post_type, $post_type_args ) {

		// Return, if post type not wp_block
		if ( 'wp_block' !== $post_type ) return;

		//Display wp_block post type in menu
		$post_type_args->show_in_menu        = true;
		$post_type_args->show_ui             = true;
		$post_type_args->_builtin            = false;
		$post_type_args->menu_icon           = 'dashicons-screenoptions';
		$post_type_args->labels->menu_name   = 'Reusable Blocks';

		global $wp_post_types;
        $wp_post_types[ $post_type ] = $post_type_args;

		// Adding thumbnail support for wp_block
		add_post_type_support( 'wp_block', 'thumbnail' );
	}

	/**
	 * Added search_rgb_title parameter in post where
	 * @param $where
	 * @param $query
	 * @return string
	 */
	public function rgblocks_set_custom_post_title_search( $where, $query ) {
		global $wpdb;

		$search_rgb_title = $query->get( 'search_rgb_title' );

		if ( $search_rgb_title ) {
			$where .= " AND $wpdb->posts.post_title LIKE '%$search_rgb_title%'";
		}

		return $where;
	}
}

$rgblocks_admin = new RGBlocks_Admin();
<?php
/**
 * RGBlocks Admin class
 *
 * Handles the script, style and admin functionality of plugin
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

		// Action to add Reusable block as admin menu
		add_action( 'admin_menu', array( $this, 'rgblocks_add_admin_menu' ), 10 );

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
			),
			'1.0'
		);
		wp_enqueue_style( 'rgblocks-gutenberg-block-backend-css', RGBLOCKS_URL . 'assets/css/block.css', array( 'wp-edit-blocks' ) , '1.0' );
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
			'name'              => _x( 'Category', 'taxonomy general name', 'rgblocks' ),
			'singular_name'     => _x( 'Category', 'taxonomy singular name', 'rgblocks' ),
			'search_items'      => __( 'Search Categories', 'rgblocks' ),
			'all_items'         => __( 'All Categories', 'rgblocks' ),
			'parent_item'       => __( 'Parent Category', 'rgblocks' ),
			'parent_item_colon' => __( 'Parent Category:', 'rgblocks' ),
			'edit_item'         => __( 'Edit Category', 'rgblocks' ),
			'update_item'       => __( 'Update Category', 'rgblocks' ),
			'add_new_item'      => __( 'Add New Category', 'rgblocks' ),
			'new_item_name'     => __( 'New Genre Category', 'rgblocks' ),
			'menu_name'         => __( 'Categories', 'rgblocks' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_in_rest'      => true,
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
	public function rgblocks_enable_block_thumbnail( $post_type ) {

		// Return, if post type not wp_block
		if ( 'wp_block' !== $post_type ) return;

		// Adding thumbnail support for wp_block
		add_post_type_support( 'wp_block', 'thumbnail' );
	}

	/**
	 * Add Reusable block as a admin menu
	 */
	public function rgblocks_add_admin_menu() {

		add_menu_page( 'Reusable Blocks', 'Reusable Blocks', 'edit_posts', 'edit.php?post_type=wp_block', '', 'dashicons-editor-table', 22 );

		add_submenu_page( 'edit.php?post_type=wp_block', 'Add New', 'Add New','edit_posts', 'post-new.php?post_type=wp_block');

		add_submenu_page( 'edit.php?post_type=wp_block', 'Categories', 'Categories','edit_posts', 'edit-tags.php?taxonomy=block-category&post_type=wp_block');
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
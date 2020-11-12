<?php

function nab_amplify_plugin_block_categories( $categories ) {
	return array_merge(
		array(
			array(
				'slug'  => 'nab_amplify',
				'title' => __( 'Nab Amplify' ),
			),
		),
		$categories
	);
}

/**
 * enqueue Block Files
 */
function amplify_block_editor_assets()
{

    wp_register_script(
        'amplify_theme_block',
        get_template_directory_uri() . '/blocks/block.build.js',
        array('wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'wp-components')
    );

    // editor css
    wp_enqueue_style('amplify-jquery-ui-css', get_template_directory_uri() . '/assets/css/jquery-ui.css');
    wp_register_style(
        'amplify_theme_block',
        get_template_directory_uri() . '/assets/css/block.css'
    );
    wp_enqueue_style('amplify-font-css', get_template_directory_uri() . '/assets/fonts/fonts.css');
    
    wp_enqueue_script('amplify-tab-front-tab-js', get_template_directory_uri() . '/blocks/block/tabs/assets/js/tab.js', array('jquery'), null, true);
    wp_register_script(
        'amplify_tab_block',
        get_template_directory_uri() . '/assets/js/jquery-ui.js',
        array('wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'wp-components')
    );
    wp_enqueue_script('amplify-tab-jquery-js', get_template_directory_uri() . '/assets/js/jquery-ui.js', array('jquery'), null, true);

    register_block_type('rg/blocks', array(
        'editor_script' => 'amplify_theme_block',
        'editor_style'  => 'amplify_theme_block',
    ));
}

/**
 * enqueue Block Front Files
 */
function amplify_block_front_assets()
{
    // Front css
    wp_enqueue_style('amplify-jquery-ui-front-css', get_template_directory_uri() . '/assets/css/jquery-ui.css');
    wp_enqueue_style('amplify-block-front-style', get_template_directory_uri() . '/assets/css/block-front.css');
    wp_enqueue_script('amplify-tab-front-jquery-js', get_template_directory_uri() . '/assets/js/jquery-ui.js', array('jquery'), null, true);
    wp_enqueue_script('amplify-block-front-js', get_template_directory_uri() . '/blocks/custom.js', array('jquery'), null, true);
    wp_enqueue_script('amplify-tab-front-tab-js', get_template_directory_uri() . '/blocks/block/tabs/assets/js/tab.js', array('jquery'), null, true);
    
}
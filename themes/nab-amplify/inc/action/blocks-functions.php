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
    wp_register_style(
        'amplify_theme_block',
        get_template_directory_uri() . '/assets/css/block.css'
    );

    wp_enqueue_style('amplify-font-css', get_template_directory_uri() . '/assets/fonts/fonts.css');

    register_block_type('rg/blocks', array(
        'editor_script' => 'amplify_theme_block',
        'editor_style'  => 'amplify_theme_block',
    ));
}


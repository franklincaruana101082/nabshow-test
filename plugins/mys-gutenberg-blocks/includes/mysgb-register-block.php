<?php

/**
 * Exit if accessed directly
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

$slider_attributes = $this->mysgb_get_common_slider_attributes();

$dynamic_slider_attr = array(
	'itemToFetch'  => array(
		'type'    => 'number',
		'default' => 10,
	),
	'postType'     => array(
		'type'    => 'string',
		'default' => 'post',
	),
	'taxonomies'   => array(
		'type'    => 'array',
		'default' => [],
		'items'   => [
			'type' => 'string'
		]
	),
	'terms'        => array(
		'type' => 'string'
	),
	'orderBy'      => array(
		'type'    => 'string',
		'default' => 'date'
	),
	'displayTitle' => array(
		'type'    => 'boolean',
		'default' => false
	)
);

register_block_type( 'mys/dynamic-slider', array(
		'attributes'      => array_merge( $dynamic_slider_attr, $slider_attributes ),
		'render_callback' => array( $this, 'mysgb_dynamic_slider_render_callback' ),
	)
);

$session_slider_attr = array(
	'itemToFetch'      => array(
		'type'    => 'number',
		'default' => 10,
	),
	'listingPage'      => array(
		'type'    => 'boolean',
		'default' => false
	),
	'postType'         => array(
		'type'    => 'string',
		'default' => 'sessions',
	),
	'taxonomies'       => array(
		'type'    => 'array',
		'default' => [],
		'items'   => [
			'type' => 'string'
		]
	),
	'terms'            => array(
		'type' => 'string'
	),
	'orderBy'          => array(
		'type'    => 'string',
		'default' => 'date'
	),
	'layout'           => array(
		'type'    => 'string',
		'default' => 'with-featured'
	),
	'sliderLayout'     => array(
		'type'    => 'string',
		'default' => 'layout-1'
	),
	'metaDate'         => array(
		'type'    => 'boolean',
		'default' => false
	),
	'sessionDate'      => array(
		'type' => 'string',
	),
	'taxonomyRelation' => array(
		'type'    => 'boolean',
		'default' => false
	),
	'listingType'      => array(
		'type'    => 'string',
		'default' => 'none'
	),
	'withContent'      => array(
		'type'    => 'boolean',
		'default' => false
	),
	'upcomingSession'  => array(
		'type'    => 'boolean',
		'default' => false
	)

);

register_block_type( 'mys/sessions-slider', array(
		'attributes'      => array_merge( $session_slider_attr, $slider_attributes ),
		'render_callback' => array( $this, 'mysgb_session_slider_render_callback' ),
	)
);

$exhibitors_slider_attr = array(
	'itemToFetch'      => array(
		'type'    => 'number',
		'default' => 10,
	),
	'listingPage'      => array(
		'type'    => 'boolean',
		'default' => false
	),
	'postType'         => array(
		'type'    => 'string',
		'default' => 'exhibitors',
	),
	'taxonomies'       => array(
		'type'    => 'array',
		'default' => [],
		'items'   => [
			'type' => 'string'
		]
	),
	'terms'            => array(
		'type' => 'string'
	),
	'orderBy'          => array(
		'type'    => 'string',
		'default' => 'date'
	),
	'taxonomyRelation' => array(
		'type'    => 'boolean',
		'default' => false
	),
	'withThumbnail'    => array(
		'type'    => 'boolean',
		'default' => false
	)
);

register_block_type( 'mys/exhibitors-slider', array(
		'attributes'      => array_merge( $exhibitors_slider_attr, $slider_attributes ),
		'render_callback' => array( $this, 'mysgb_exhibitors_slider_render_callback' ),
	)
);

$speakers_slider_attr = array(
	'itemToFetch'     => array(
		'type'    => 'number',
		'default' => 10,
	),
	'listingPage'     => array(
		'type'    => 'boolean',
		'default' => false
	),
	'postType'        => array(
		'type'    => 'string',
		'default' => 'speakers',
	),
	'taxonomies'      => array(
		'type'    => 'array',
		'default' => [],
		'items'   => [
			'type' => 'string'
		]
	),
	'terms'     => array(
		'type' => 'string'
	),
	'slideShape'    => array(
		'type'    => 'string',
		'default' => 'circle'
	),
	'orderBy'         => array(
		'type'    => 'string',
		'default' => 'date'
	),
	'withThumbnail'  => array(
		'type'    => 'boolean',
		'default' => false
	),
	'displayName'   => array(
		'type'    => 'boolean',
		'default' => true
	),
	'displayTitle'   => array(
		'type'    => 'boolean',
		'default' => true
	),
	'displayCompany' => array(
		'type'    => 'boolean',
		'default' => true
	)

);

register_block_type( 'mys/speaker-slider', array(
		'attributes'      => array_merge( $speakers_slider_attr, $slider_attributes ),
		'render_callback' => array( $this, 'mysgb_speaker_slider_render_callback' ),
	)
);

$sponsors_slider_attr = array(
	'layout'      => array(
		'type'    => 'string',
		'default' => 'without-title',
	),
	'itemToFetch' => array(
		'type'    => 'number',
		'default' => 10,
	),
	'listingPage' => array(
		'type'    => 'boolean',
		'default' => false
	),
	'postType'    => array(
		'type'    => 'string',
		'default' => 'sponsors',
	),
	'taxonomies'  => array(
		'type'    => 'array',
		'default' => [],
		'items'   => [
			'type' => 'string'
		]
	),
	'terms'       => array(
		'type' => 'string'
	),
	'orderBy'     => array(
		'type'    => 'string',
		'default' => 'date'
	)
);

register_block_type( 'mys/sponsors-partners', array(
		'attributes'      => array_merge( $sponsors_slider_attr, $this->mysgb_get_common_slider_attributes( 6 ) ),
		'render_callback' => array( $this, 'mysgb_sponsors_partners_render_callback' ),
	)
);

register_block_type( 'mys/product-winner', array(
		'attributes'      => array(
			'itemToFetch' => array(
				'type'    => 'number',
				'default' => 10,
			),
			'postType'    => array(
				'type'    => 'string',
				'default' => 'not-to-be-missed',
			),
			'taxonomies'  => array(
				'type'    => 'array',
				'default' => [],
				'items'   => [
					'type' => 'string'
				]
			),
			'terms'       => array(
				'type' => 'string'
			),
			'orderBy'     => array(
				'type'    => 'string',
				'default' => 'date'
			),
			'showFilter'  => array(
				'type'    => 'boolean',
				'default' => false
			)
		),
		'render_callback' => array( $this, 'mysgb_product_winner_render_callback' ),
	)
);

$tracks_slider_attr = array(
	'itemToFetch'  => array(
		'type'    => 'number',
		'default' => 10,
	),
	'order'        => array(
		'type'    => 'string',
		'default' => 'ASC'
	),
	'featuredTag'  => array(
		'type'    => 'boolean',
		'default' => false
	),
	'categoryType' => array(
		'type'    => 'string',
		'default' => 'tracks'
	),
	'categoryHalls' => array(
		'type'    => 'array',
		'default' => [],
		'items'   => [
			'type' => 'string'
		]
	)

);

register_block_type( 'mys/tracks-slider', array(
		'attributes'      => array_merge( $tracks_slider_attr, $slider_attributes ),
		'render_callback' => array( $this, 'mysgb_category_slider_render_callback' ),
	)
);

register_block_type( 'mys/product-categories', array(
		'attributes'      => array(
			'itemToFetch' => array(
				'type'    => 'number',
				'default' => 10
			),
			'layoutType'  => array(
				'type'    => 'string',
				'default' => 'listing'
			),
			'showFilter'  => array(
				'type'    => 'boolean',
				'default' => false
			)
		),
		'render_callback' => array( $this, 'mysgb_product_categories_render_callback' ),
	)
);

$product_slider_attr = array(
	'itemToFetch' => array(
		'type'    => 'number',
		'default' => 10,
	),
	'postType'    => array(
		'type'    => 'string',
		'default' => 'not-to-be-missed',
	),
	'taxonomies'  => array(
		'type'    => 'array',
		'default' => [],
		'items'   => [
			'type' => 'string'
		]
	),
	'terms'       => array(
		'type' => 'string'
	),
	'orderBy'     => array(
		'type'    => 'string',
		'default' => 'date'
	)
);

register_block_type( 'mys/product-slider', array(
		'attributes'      => array_merge( $product_slider_attr, $slider_attributes ),
		'render_callback' => array( $this, 'mysgb_product_slider_render_callback' ),
	)
);

<?php

/**
 * Template part for displaying owned (admin) companies.
 *
 * @package Amplify
 */

$current_user = wp_get_current_user();
$user_id      = $current_user->ID;

$query_args = array(
	'post_type'      => 'company',
	'posts_per_page' => - 1,
	'post_status'    => 'publish',
	'order_by'       => 'title',
	'order'          => 'ASC'
);

$query_args['meta_query'] = array(
	array(
		'key'     => 'company_user_id',
		'value'   => '"' . $user_id . '"',
		'compare' => 'LIKE'
	)
);

$my_companies = new WP_Query( $query_args );

if ( $my_companies->have_posts() ) { ?>


    <p>Below are those company profiles that currently list you as an admin. Not seeing a company you need the ability to edit? Contact the POC listed for your companyon NAB Amplify, click the button to claim or listing at the bottom of your company page, or get in touch with your sales rep.</p>

    <ul class="colgrid _5up" id="content-my-companies">

		<?php while ( $my_companies->have_posts() ) {

			$my_companies->the_post();

			$cm_img   = nab_amplify_get_featured_image( get_the_ID() );
			$cm_link  = get_the_permalink();
			$cm_title = get_the_title();

			?>
            <li class="wp-summary content_card my-company">
                <div class="result">
                    <img src="<?php echo esc_url( $cm_img ); ?>" class="result__image" alt="<?php echo esc_attr( $cm_title ) ?>"/>
                    <h4 class="result__title"><?php echo esc_html( $cm_title ) ?></h4>
                    <a href="<?php echo esc_attr( $cm_link ) ?>" class="button result__button _gradientpink">View Now</a>
                </div>
            </li>
			<?php
		} ?>
    </ul>
	<?php wp_reset_postdata();
} else {
	?>
    <p>You do not have administrator privileges of any company.</p>
	<?php
}

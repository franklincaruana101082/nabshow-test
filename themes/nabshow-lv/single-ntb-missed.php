<?php
get_header();

global $wpdb;
?>

    <div class="not-to-be-missed-single">
        <div class="header-banner">
			<?php
			$image = get_field('banner_featured_image');

//			echo "<pre>"; print_r($image); echo "</pre>";

			if( $image ) { ?>

				<img src="<?php echo esc_url($image['url'] )?>">

			<?php }
			?>
            <div class="container">
                <div class="banner-details">
                    <h1><?php wp_title( '' ); ?></h1>
                    <span class="sub-category">- Category, Category</span>
                </div>
            </div>
        </div>
        <div id="primary" class="container">
            <div class="page-main">
                <div class="row mb40">
                    <div class="col-lg-12">
						<?php
						if ( have_posts() ) {
							while ( have_posts() ) {
								the_post();
								the_content();
							}
						}

						?>
                    </div>
                </div>

				<?php

				$current_post_ID = get_the_ID();
				$cross_tag_query = nabshow_lv_cross_tag_relation_posts( $current_post_ID );
				?>
                <div class="row">

					<?php
					if ( $cross_tag_query->have_posts() ) {
						while ( $cross_tag_query->have_posts() ) {
							$cross_tag_query->the_post();

							$tag_post_id = get_the_ID();

							if ( $tag_post_id === $current_post_ID ) {
								continue;
							}

							?>
                            <div class="col-lg-6">
                                <div class="cross-promo-box">
                                    <h2 class="title"><?php echo esc_html( get_the_title() ) ?></h2>
                                    <p><?php echo esc_html( get_the_excerpt() ); ?></p>
                                    <a href="<?php echo esc_url( get_the_permalink() ); ?>">Learn More</a>
                                </div>
                            </div>

							<?php
						}
					}

					?>
                </div>
            </div>
        </div><!-- #primary -->
    </div>

<?php

get_footer();
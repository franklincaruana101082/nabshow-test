<?php
/**
 * Template Name: Related Content
 *
 * @package  NABShow_LV
 * */
get_header();

?>
    <div id="primary" class="container">
        <div class="page-main related-content-page">
            <div class="row head-section">
                <div class="col-lg-8 col-xl-9">
                    <h1 class="page-title"><?php wp_title( '' ); ?></h1>
                    <span class="date">Dates and Times</span>
                    <a href="#" class="location">Location</a>
                    <p>
						<?php
						if ( have_posts() ) :
							while ( have_posts() ) :
								the_post();
								the_content();
							endwhile;
						endif; ?>
                    </p>
                </div>
                <div class="col-lg-4 col-xl-3">
                    <div class="registration-access">
                        <h2 class="title">Registration Access</h2>
                        <img src="http://nabshow.md-staging.com/wp-content/uploads/2019/07/related-content-w3.jpg"
                             alt="Registration Access">

                        <p>Open to all Conference Flex and Conference Flex 3-Pack Holders</p>
                        <a href="#" class="btn-primary">Get Your Pass</a>
                    </div>
                </div>
            </div>
			<?php
			$children = get_pages( array( 'child_of' => get_the_id(), 'parent' => get_the_id() ) );
			if ( ! empty( $children ) ) {
				?>
                <div class="row">
                    <?php
                    foreach ( $children as $child ) {
                    ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="related-content-box">
                            <img class="logo"
                                 src="<?php echo has_post_thumbnail($child->ID) ? esc_url( get_the_post_thumbnail_url($child->ID) ) : esc_url( nabshow_lv_get_empty_thumbnail_url() ); ?>"
                                 alt="Related Logo">
                            <h2 class="title"><?php echo esc_html($child->post_title); ?></h2>
                            <span class="sub-title">Booth Number</span>
                            <p><?php echo esc_html(get_the_excerpt($child->ID)); ?></p>
                            <a href="<?php echo esc_url(get_permalink($child->ID)); ?>" class="read-more btn-with-arrow">Read More</a>
                        </div>
                    </div>
                        <?php } ?>
                </div>
			<?php } ?>
        </div>
    </div><!-- #primary -->
<?php
get_footer();
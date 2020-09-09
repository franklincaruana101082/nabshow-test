<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package NABShow_NY
 */

get_header();

?>

    <div id="internal-banner" class="wp-block-nab-multipurpose-gutenberg-block has-full is-block-center has-background-size has-background-opacity has-background-opacity-50" style="background-image:url(https://nabshow.com/ny2020/wp-content/uploads/sites/5/2020/05/homepage-hero.jpg);margin-top:-40px;margin-bottom:0px">
		<div class="wp-block-nab-multipurpose-gutenberg-block has-fixed is-block-center" style="padding-top:40px;padding-bottom:20px">
			<h1 style="color:#ffffff" class="title nab-title">Channels</h1>
		</div>
	</div>
	<div id="primary" class="container">
		<main id="main" class="site-main">
            <div class="breadcrumbs-nospace">
	            <?php
	                echo do_shortcode('[nab_yoast_breadcumb]');
	            ?>
	        </div>
            <?php if ( have_posts() ) : ?>

                <?php
                /* Start the Loop */
                while ( have_posts() ) :
                    the_post();

                    ?>
                    <div id="post-<?php the_ID(); ?>" class="channel-archive-list">
                        <div class="channel-title-info">
                            <h2 class="entry-title">
                                <a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
                            </h2>                        
                        </div>                    

                        <div class="channel-detail-info">
                            <p><?php echo esc_html( get_the_excerpt() ); ?></p>
                            <a href="<?php echo esc_url( get_the_permalink() ); ?>" class="read-more-link">Read More</a>
                        </div>
                    </div>
                    <?php

                endwhile;

                the_posts_navigation();

            else :

                get_template_part( 'template-parts/content', 'none' );

            endif;
            ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

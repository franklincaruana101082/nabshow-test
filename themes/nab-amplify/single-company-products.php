<?php
/**
 * The template for displaying all single company product
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Amplify
 */

get_header();
?>

	<main id="primary" class="site-main single_php">
		<?php
while (have_posts()):
    the_post();

    ?>
			            <article id="post-<?php the_ID();?>" <?php post_class();?>>
			                <header class="entry-header">
			                    <?php
    the_title('<h1 class="entry-title">', '</h1>');
    ?>
			                </header><!-- .entry-header -->
			                <?php
    $author_full_name = get_the_author_meta('first_name') . ' ' . get_the_author_meta('last_name');

    if (empty(trim($author_full_name))) {

        $author_full_name = get_the_author();
    }
    $preview_main_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');

    ?>
			                <h4 class="article-byline">Posted by <?php echo esc_html($author_full_name); ?></h4>

			                <div class="nab-preview-slider-main">
			                    <div class="nab-preview-slider-inner">
			                        <div class="nab-preview-main">
			                            <img src="<?php echo $preview_main_src[0]; ?>" alt="">
			                        </div>
			                        <div class="nab-preview-items-main">
			                            <?php $product_medias = get_field('product_media');
    if (!empty($product_medias)) {
        foreach ($product_medias as $product_media) {
            if (!empty($product_media['product_media_file'])) {
                ?>
			                            <div class="nab-preview-item">
			                                <img src="<?php echo $product_media['product_media_file']['url']; ?>" alt="">
			                            </div>
			                            <?php
    }
        }
    }?>

			                        </div>
			                    </div>
			                </div>

			                <div class="single-product-content">
			                    <div class="single-product-main">
			                        <div class="single-product-col left-col">
			                           <?php the_content();?>
			                        </div>
			                        <div class="single-product-col right-col">
			                            <div class="black-bg-box author-details-box">
			                                <div class="author-info">
			                                    <div class="author-image">
			                                        <?php echo bp_core_fetch_avatar(array('item_id' => get_the_author_ID(), 'type' => 'full')); ?>
			                                    </div>
			                                    <div class="author-details">
			                                        <h3 class="author-title"><?php echo get_the_author_meta('user_nicename', get_the_author_ID()); ?></h3>
			                                        <span class="author-subtitle">Posting Company</span>
			                                    </div>
			                                </div>
			                                <div class="author-info-content">
			                                    <p><?php echo get_the_author_meta('description', get_the_author_ID()); ?></p>
			                                    <div class="action-wrap">
			                                        <div><a href="<?php echo bp_core_get_user_domain(get_the_author_meta('ID')); ?>" class="btn-link">View author profile</a></div>
			                                        <div><a href="<?php echo get_the_permalink(get_field('nab_selected_company_id')); ?>" class="btn-link">View company profile</a></div>
			                                        <div><?php echo nab_get_company_message_button(get_field('nab_selected_company_id'), 'Message Point of Contact'); ?></div>
			                                    </div>
			                                </div>
			                            </div>
			                            <div class="black-bg-box product-specs-box">
			                                <h2>Product Specs</h2>
											<?php $product_specs = explode(',',get_field('product_specs'));
                                                if (!empty($product_specs)) {
                                                    ?>
											<ul>
												<?php foreach ($product_specs as $spec) {
                                                        ?>
											<li><?php echo strip_tags($spec); ?></li>
											<?php
                                                    } ?>
											</ul>
											<?php
                                                } ?>
			                            </div>
			                            <div class="ad-wrapper">

			                            </div>
			                        </div>
			                    </div>
			                </div>
			                <div class="company-products related-content">

			                <?php
    $tags = get_the_terms(get_the_ID(), 'company-product-tag');

    if ($tags) {
        ?>

		                        <?php
    $first_tag = $tags[0]->term_id;
        $args      = array(
            'post_type'      => 'company-products',
            'post__not_in'   => array(get_the_ID()),
            'tax_query'      => array(
                array(
                    'taxonomy' => 'company-product-tag',
                    'field'    => 'id',
                    'terms'    => $first_tag,
                ),
            ),
            'posts_per_page' => '3',
        );
        $my_query = new WP_Query($args);
        if ($my_query->have_posts()) {?>
	        <div class="amp-item-main">
			                <div class="amp-item-heading">
			                    <h3>Related Products</h3> </div>
			                <div class="amp-item-wrap" id="company-products-list">
	                            <?php
    while ($my_query->have_posts()): $my_query->the_post();
                $thumbnail_url    = has_post_thumbnail() ? get_the_post_thumbnail_url() : nab_placeholder_img();
                $product_link     = get_the_permalink();
                $product_category = get_the_terms(get_the_ID(), 'company-product-category');
                ?>
						                        <div class="amp-item-col">
						                            <div class="amp-item-inner">
						                                <div class="amp-item-cover">
						                                    <img src="<?php echo esc_url($thumbnail_url); ?>" alt="Product Image">
						                                </div>
						                                <div class="amp-item-info">
						                                    <div class="amp-item-content">
						                                        <h4>
						                                            <a href="<?php echo esc_url($product_link); ?>"><?php echo esc_html(get_the_title()); ?></a>
						                                        </h4>
						                                        <?php
        if (!empty($product_category) && !is_wp_error($product_category)) {

                    ?>
						                                            <span class="product-company"><?php echo esc_html($product_category[0]->name); ?></span>
						                                            <?php
        }
                ?>
						                                        <div class="amp-actions">
						                                            <div class="search-actions nab-action">
						                                                <a href="<?php echo esc_url($product_link); ?>" class="button">View Product</a>
						                                            </div>
						                                        </div>
						                                    </div>
						                                </div>
						                            </div>
						                        </div>
						                    <?php
    endwhile;?>
	    </div></div></div>
	    <?php
    }
        wp_reset_query();
        ?>

			     <?php
    }?>

			                <footer class="entry-footer">
			                    <?php nab_amplify_entry_footer();?>
			                </footer><!-- .entry-footer -->
			            </article><!-- #post-<?php the_ID();?> -->
			            <?php
    // If comments are open or we have at least one comment, load up the comment template.
    if (comments_open() || get_comments_number()):
        comments_template();
    endif;

endwhile; // End of the loop.
?>

	</main><!-- #main -->

<?php
get_footer();

<?php
/**
 * Template part for displaying thought gallery post listing
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package NABShow_LV
 */
?>
<article class="post-wrap post-list row tg-cards">
    <div class="is-left-col col-sm-4 col-xs-12">
        <div class="post-thumb is-image">
            <a href="<?php echo esc_url( get_the_permalink() ); ?>" rel="bookmark">
                <img width="350" height="350"
                     src="<?php echo has_post_thumbnail() ? esc_url( get_the_post_thumbnail_url() ) : esc_url( nabshow_lv_get_empty_thumbnail_url() ); ?>"
                     alt="<?php echo esc_attr( get_the_title() ); ?>"/>
            </a>
        </div>
    </div>
    <div class="is-right-col col-sm-8 col-xs-12">
        <div class="post-header">
            <div class="cat-listing">
                <?php
                $tax_thought_galleries = get_the_terms( get_the_ID(), 'thought-gallery-category' );
                $i                     = 0;

                if ( $tax_thought_galleries && ! is_wp_error( $tax_thought_galleries ) ) {

                    foreach ( $tax_thought_galleries as $tax_thought_gallery ) {
                        $i ++;
                        $term_link = get_term_link( $tax_thought_gallery->slug, 'thought-gallery-category' );

                        if ( $term_link && ! is_wp_error( $term_link ) ) {
                            ?>

                            <a href="<?php echo esc_url( $term_link ); ?>"
                            title="<?php echo esc_attr( $tax_thought_gallery->name ); ?>" rel="tag"
                            class="cat-info <?php echo esc_attr( $tax_thought_gallery->slug ); ?>"><?php echo esc_html( $tax_thought_gallery->name ); ?></a>
                            <?php
                        }

                        if ( sizeof( $tax_thought_galleries ) > $i ) {
                            ?>
                            ,
                            <?php
                        }

                    }
                }
                ?>
            </div>
            <h2 class="post-title is-medium-title">
                <a href="<?php echo esc_url( get_the_permalink() ); ?>"
                   rel="bookmark"><?php echo esc_html( get_the_title() ); ?></a>
            </h2>
            <div class="post-meta-info">
                <span class="meta-info-decs"><?php echo esc_html( 'by' ); ?></span>
                <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ); ?>"> <?php echo esc_html( get_the_author() ); ?> </a>
            </div>
            <p class="post-excerpt"><?php echo esc_html( nabshow_lv_excerpt() ); ?>
                <a class="btn" href="<?php echo esc_url( get_the_permalink() ); ?>"
                   rel="bookmark"><?php echo esc_html( 'read more' ); ?></a></p>
        </div>
</article>
<div class="item">
    <a href="<?php echo esc_url( get_the_permalink() ); ?>">
        <div class="tg-imgbox">
            <img src="<?php echo has_post_thumbnail() ? esc_url( get_the_post_thumbnail_url() ) : esc_url( nabshow_lv_get_empty_thumbnail_url() ); ?>"
                 alt="<?php echo esc_attr( get_the_title() ); ?>"/>
        </div>
    </a>
    <div class="tg-imgCap">
        <span class="tg-catlist">
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
                           title="<?php echo esc_attr( $tax_thought_gallery->name ); ?>"
                           rel="tag"><?php echo esc_html( $tax_thought_gallery->name ); ?></a>
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
        </span>
        <a href="<?php echo esc_url( get_the_permalink() ); ?>"><h4
                    class="tg-title"><?php echo esc_html( get_the_title() ); ?></h4></a>
        <span class="tg-author"> By <a
                    href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ); ?>"> <?php echo esc_html( get_the_author() ); ?> </a></span>
    </div>
</div>
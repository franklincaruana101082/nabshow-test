<?php

// Create company followers table
add_action( 'init', 'nab_create_company_followers_table' );

/**
 * Create Database table for company followers.
 */
function nab_create_company_followers_table() {

    global $wpdb;

    if ( get_option( 'nab_company_followers_version' ) < 1 ) {

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        $charset_collate    = $wpdb->get_charset_collate();
        $table_name         = $wpdb->prefix . 'nab_company_followers';

        $table_sql = "CREATE TABLE `$table_name` (
                `id` bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `company_id` bigint(20) NOT NULL,
                `follower_id` bigint(20) NOT NULL,
                `following_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                KEY company_id (company_id),
                KEY follower_id (follower_id)
                ) {$charset_collate};";

        dbDelta( $table_sql );

		update_option( 'nab_company_followers_version', 1 );
    }

}


/**
 * Display follow button if user not already follow otherwise display message button with company admin link.
 *
 * @param  int $company_id
 * @param  int $user_id
 * @param  boolean $search_page
 */
function nab_get_follow_button( $company_id, $user_id, $search_page = false ) {

    if ( empty( $company_id ) || empty( $user_id ) ) {

        return;
    }

    $user_following = nab_is_user_following( $company_id, $user_id );

    if ( ! $user_following ) {

        ?>
        <div class="search-actions">
            <div class="generic-button">
                <a href="javascript:void(0);" class="follow-btn btn" data-action="follow" data-item="<?php echo esc_attr( $company_id ); ?>">Follow</a>
            </div>
        </div>
        <?php
    } else if ( is_search() || $search_page ) {
        ?>
        <div class="search-actions">
            <a href="<?php echo esc_url( get_the_permalink( $company_id ) ); ?>" class="btn">View</a>
        </div>
        <?php
    }
}


/**
 * Display Unfollow button.
 *
 * @param  int $company_id
 * @param  int $user_id
 */
function nab_get_unfollow_button( $company_id, $user_id ) {

    if ( empty( $company_id ) || empty( $user_id ) ) {

        return;
    }

    $user_following = nab_is_user_following( $company_id, $user_id );

    if ( $user_following ) {
        ?>
        <div class="generic-button unfollow-btn">
            <a href="javascript:void(0);" class="follow-btn btn" data-action="unfollow" data-item="<?php echo esc_attr( $company_id ); ?>">UnFollow</a>
        </div>
        <?php
    }
}

/**
 * Display message button if company have admin user.
 *
 * @param  int $company_id
 */
function nab_get_company_message_button( $company_id, $text = 'Message' ) {

    if ( empty( $company_id ) ) {

        return;
    }

    $company_admin_id = get_field( 'company_user_id', $company_id );

    if ( ! empty( $company_admin_id ) ) {

        $private_massage_link = wp_nonce_url( bp_loggedin_user_domain() . bp_get_messages_slug() . '/compose/?r=' . bp_core_get_username( $company_admin_id[0] ) );
        ?>
        <div class="search-actions">
            <?php
            bp_send_message_button( array(
                    'id'         => 'private_message_' . $company_admin_id[0],
                    'link_class' => 'button add',
                    'link_text'  => $text,
                    'link_href'  => $private_massage_link,
                )
            );
            ?>
        </div>
        <?php
    }
}


/**
 * This function determine whether user follow the company or not.
 *
 * @param  int $company_id
 * @param  int $user_id
 *
 * @return boolean
 */
function nab_is_user_following( $company_id, $user_id ) {

    global $wpdb;

    $following = false;

    if ( empty( $company_id ) || empty( $user_id ) ) {

        return $following;
    }

    $table_name     = $wpdb->prefix . 'nab_company_followers';
    $prepare_sql    = $wpdb->prepare( "SELECT company_id FROM `$table_name` WHERE follower_id = %d AND company_id = %d", $user_id, $company_id );
    $user_follow    = $wpdb->get_row( $prepare_sql );

    if ( ! empty( $user_follow ) ) {

        $following = $user_follow->company_id ? true : false;
    }

    return $following;
}


/**
 * Add new follower to the table.
 *
 * @param  int $company_id
 * @param  int $user_id
 * @return mixed
 */
function nab_add_new_company_follower( $company_id, $user_id ) {

    global $wpdb;

    if ( empty( $company_id ) || empty ( $user_id ) ) {

        return false;
    }

    $current_time   = current_time( 'Y-m-d H:i:s' );
    $table_name     = $wpdb->prefix . 'nab_company_followers';

    $inserted = $wpdb->insert(
        $table_name,
        array(
            'company_id'        => $company_id,
            'follower_id'       => $user_id,
            'following_date'    => $current_time
        ),
        array(
            '%d',
            '%d',
            '%s'
        )
    );

    return $inserted;
}


/**
 * Remove follower user.
 *
 * @param  int $company_id
 * @param  int $user_id
 * @return mixed
 */
function nab_remove_company_follower( $company_id, $user_id ) {

    global $wpdb;

    $success = false;

    if ( empty( $company_id ) || empty ( $user_id ) ) {

        return $success;
    }

    $user_following = nab_is_user_following( $company_id, $user_id );

    if ( $user_following ) {

        $table_name = $wpdb->prefix . 'nab_company_followers';
        $success    = $wpdb->delete(
            $table_name,
            array(
                'company_id'    => $company_id,
                'follower_id'   => $user_id
            ),
            array(
                '%d',
                '%d'
            )
        );
    }

    return $success;
}

//Ajax for manage company follow or unfollow
add_action( 'wp_ajax_nab_company_follow_action', 'nab_company_follow_action_callback' );
add_action( 'wp_ajax_nopriv_nab_company_follow_action', 'nab_company_follow_action_callback' );


/**
 * Ajax for handle Follow or Unfollow user action.
 */
function nab_company_follow_action_callback() {

    check_ajax_referer( 'nab-ajax-nonce', 'nabNonce' );

    $company_id     = filter_input( INPUT_POST, 'item_id', FILTER_SANITIZE_NUMBER_INT );
    $action         = filter_input( INPUT_POST, 'item_action', FILTER_SANITIZE_STRING );
    $search_page    = filter_input( INPUT_POST, 'search_page', FILTER_SANITIZE_STRING );
    $result         = array( 'success' => false );

    if ( empty( $company_id ) || ! in_array( $action, array( 'follow', 'unfollow', true ) ) ) {

        echo wp_json_encode( $result );

        wp_die();
    }

    if ( is_user_logged_in() ) {

        $user_id = get_current_user_id();

        if ( 'follow' === $action ) {

            $following = nab_add_new_company_follower( $company_id, $user_id );

            if ( $following ) {

                $button = '';

                if ( 'yes' === strtolower( $search_page ) ) {

                    ob_start();

                    ?>
                    <div class="search-actions">
                        <a href="<?php echo esc_url( get_the_permalink( $company_id ) ); ?>" class="btn">View</a>
                    </div>
                    <?php
                    $button = ob_get_clean();
                }

                ob_start();

                nab_get_unfollow_button( $company_id, $user_id );

                $unfollow_btn = ob_get_clean();

                $result[ 'success' ]        = true;
                $result[ 'message_btn' ]    = $button;
                $result[ 'unfollow_btn' ]   = $unfollow_btn;
            }
        } else if ( 'unfollow' === $action ) {

            $unfollow = nab_remove_company_follower( $company_id, $user_id );

            if ( $unfollow ) {

                ob_start();

                nab_get_follow_button( $company_id, $user_id );

                $button = ob_get_clean();

                $result[ 'success' ]    = true;
                $result[ 'follow_btn' ] = $button;
            }
        }
    }

    echo wp_json_encode( $result );

	wp_die();
}

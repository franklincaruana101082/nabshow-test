<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

//Prevent  unauthorized users
if ( ! current_user_can( 'manage_options' ) ) {
    wp_die( esc_html( 'You do not have sufficient permissions to access this page.' ) );
}

require_once( plugin_dir_path( __FILE__ ) . 'html-mysgb-header.php' );

?>

<div class="mys-section-left">
    <div class="mys-main-table res-cl">
        <div class="mys-head">
            <h2>MYS Script and Style Setting</h2>
        </div>
        <form method="post" action="options.php">
            <?php

            settings_fields( 'mysgb-settings-group' );
            do_settings_sections( 'mysgb-settings-group' );

            ?>

            <table class="table-outer syn-table history-table">
                <tbody>
                    <tr>
                        <td class="checkbox-row">
                            <input type="checkbox" name="mysgb_disable_script" value="yes" <?php checked( 'yes', get_option( 'mysgb_disable_script' ) ); ?> />
                        </td>
                        <td class="details-row">Disable script/js to load from plugin</td>
                    </tr>
                    <tr>
                        <td class="checkbox-row">
                            <input type="checkbox" name="mysgb_disable_style" value="yes" <?php checked( 'yes', get_option( 'mysgb_disable_style' ) ); ?> />
                        </td>
                        <td class="details-row">Disable style/css to load from plugin</td>
                    </tr>
                </tbody>
            </table>

            <?php submit_button(); ?>

        </form>
    </div>
</div>
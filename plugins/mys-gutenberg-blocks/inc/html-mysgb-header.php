<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
?>
<header class="mys-header">
    <div class="mys-logo-main">
        <img src="<?php echo esc_url( plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/logo.png' ); ?>" alt="logo" />
    </div>
    <div class="mys-header-right">
        <div class="logo-detail">
            <strong>Map Your Show Blocks</strong>
            <span>Version 1.0.0</span>
        </div>
    </div>
    <?php
        $current_page = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_STRING );
    ?>
    <div class="mys-menu-main">
        <nav>
            <ul>
                <li>
                    <a class="mystore_plugin <?php echo "mysgb-about" === $current_page  ? esc_attr('active') : ''; ?>" href="<?php echo esc_url( admin_url('/admin.php?page=mysgb-about') ); ?>">About Plugin</a>
                </li>
                <li>
                    <a class="mystore_plugin <?php echo "mysgb-settings" === $current_page ? esc_attr('active') : ''; ?>" href="<?php echo esc_url( admin_url('/admin.php?page=mysgb-settings') ); ?>">Settings</a>
                </li>
            </ul>
        </nav>
    </div>
</header>
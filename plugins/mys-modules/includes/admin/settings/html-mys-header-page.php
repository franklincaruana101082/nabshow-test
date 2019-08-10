<header class="mys-header">
    <div class="mys-logo-main">
        <img src="<?php echo MYS_PLUGIN_URL . '/assets/images/logo.png'; ?>">
    </div>
    <div class="mys-header-right">
        <div class="logo-detail">
            <strong>Map Your Show Modules</strong>
            <span>Version 1.1.1</span>
        </div>
    </div>
    <div class="mys-menu-main">
        <nav>
            <ul>
	            <?php

	            if( "1" === get_option('nab_mys_show_wizard') ) {
		            $step = get_option('nab_mys_wizard_step');
		            ?>
                    <li>
                        <a class="mystore_plugin active" href="javascript:void(0)">Setup Wizard</a>
                    </li>
                    <li>
                        <a class="mystore_plugin" href="javascript:void(0)">Step <?php echo $step; ?></a>
                    </li>
                    <?php
	            } else {
	            ?>
                <li>
                    <a class="mystore_plugin <?php echo ( "mys-about" === $_GET['page'] ) ? 'active' : ''; ?>" href="/wp-admin/admin.php?page=mys-about">About Plugin</a>
                </li>
                <li>
                    <a class="mystore_plugin <?php echo ( "mys-dashboard" === $_GET['page'] ) ? 'active' : ''; ?>" href="/wp-admin/admin.php?page=mys-dashboard">Dashboard</a>
                </li>
                <li>
                    
                </li>
                <li>
                    <a class="mystore_plugin <?php echo ( "mys-syn" === $_GET['page'] ) ? 'active' : ''; ?>" href="/wp-admin/admin.php?page=mys-syn">Sync</a>
                </li>
                <li>
                    <a class="mystore_plugin <?php echo ( "mys-history" === $_GET['page'] ) ? 'active' : ''; ?>" href="/wp-admin/admin.php?page=mys-history">History</a>
                </li>
                <li>
                    <a class="mystore_plugin <?php echo ( "mys-setting" === $_GET['page'] || "mys-login" === $_GET['page'] ) ? 'active' : ''; ?>" href="/wp-admin/admin.php?page=mys-setting">Settings</a>
                    <ul class="sub-menu">
                        <li>
                            <a class="mystore_plugin <?php echo ( "mys-login" === $_GET['page'] ) ? 'active' : ''; ?>" href="/wp-admin/admin.php?page=mys-login">Configuration</a>
                        </li>
                    </ul>
                </li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</header>
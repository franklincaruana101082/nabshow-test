<?php
/******************************************************************************************
 * Copyright (C) Smackcoders. - All Rights Reserved under Smackcoders Proprietary License
 * You can contact Smackcoders at email address info@smackcoders.com.
 *******************************************************************************************/

namespace Smackcoders\FCSV;

if ( ! defined( 'ABSPATH' ) )
    exit; // Exit if accessed directly

class Plugin{
    private static $instance = null;
    private static $string = 'com.smackcoders.smackcsv';

    public static function getInstance() {
        if (Plugin::$instance == null) {
            Plugin::$instance = new Plugin;
           
            return Plugin::$instance;
        }
        return Plugin::$instance;
    }

    public function getPluginSlug(){
        return Plugin::$string;
    }
}
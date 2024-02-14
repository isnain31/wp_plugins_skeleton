<?php
/**
* Plugin Name: movie-data
* Plugin URI: https://www.movie-data.local/
* Description: This plugins shows you some movie list using a shortcode in the content
* Version: 0.1
* Author: Isnain
* Author URI: https://www.movide-data.local/
**/
namespace Movie_Data;

require_once __DIR__ . '/autoloader.php';

use Movie_Data\Infra\Core\Init_Plugin;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}



register_activation_hook( __FILE__, array('Movie_Data\Infra\Core\Plugins_Installer', 'install' ) );
register_deactivation_hook( __FILE__, array('Movie_Data\Infra\Core\Plugins_Uninstaller', 'uninstall' ) );

class Movie_Data_Plugin{


    public static function init(): void
    {
        $init_plugin = new Init_Plugin();
        $init_plugin->start();
    }

}

if ( version_compare( PHP_VERSION, '8.0.0', '>=' ) ) {
    Movie_Data_Plugin::init();
}



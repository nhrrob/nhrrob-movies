<?php
/**
 * Plugin Name: NHR Movies
 * Plugin URI: http://wordpress.org/plugins/nhrrob-movies/
 * Description: A plugin to manage movies using Laravel's Eloquent ORM and Blade templating.
 * Author: Nazmul Hasan Robin
 * Author URI: https://profiles.wordpress.org/nhrrob/
 * Version: 1.0.0
 * Requires at least: 6.0
 * Requires PHP: 7.4
 * Text Domain: nhrrob-movies
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Autoload dependencies
require_once __DIR__ . '/vendor/autoload.php';

/**
 * The main plugin class
 */
final class Nhrrob_Movies {

    /**
     * Plugin version
     *
     * @var string
     */
    const nhrrob_movies_version = '1.0.0';

    /**
     * Class construcotr
     */
    public function __construct() {
        $this->define_constants();

        add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
    }

    /**
     * Define the required plugin constants
     *
     * @return void
     */
    public function define_constants() {
        define( 'NHRROB_MOVIES_VERSION', self::nhrrob_movies_version );
        define( 'NHRROB_MOVIES_FILE', __FILE__ );
        define( 'NHRROB_MOVIES_PATH', __DIR__ );
        define( 'NHRROB_MOVIES_URL', plugins_url( '', NHRROB_MOVIES_FILE ) );
        define( 'NHRROB_MOVIES_PUBLIC', NHRROB_MOVIES_URL . '/public' );
        define( 'NHRROB_MOVIES_PLUGIN_DIR', plugin_dir_path( NHRROB_MOVIES_FILE ) );
        define( 'NHRROB_MOVIES_APP_PATH', NHRROB_MOVIES_PATH . '/app' );
        define( 'NHRROB_MOVIES_VIEWS_PATH', NHRROB_MOVIES_PATH . '/resources/views' );
        define( 'NHRROB_MOVIES_PUBLIC_PATH', NHRROB_MOVIES_PATH . '/public' );
    }

    /**
     * Initialize the plugin
     *
     * @return void
     */
    public function init_plugin() {
        new Nhrrob\Movies\Classes\Assets();

        if ( is_admin() ) {
            new Nhrrob\Movies\Classes\Admin();
        } else {
            // Front
        }
    }
}

//call the plugin
new Nhrrob_Movies();

require_once __DIR__ . '/bootstrap/app.php';
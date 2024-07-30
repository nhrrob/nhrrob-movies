<?php
/*
Plugin Name: NHR Movies
Description: A plugin to manage movies using Laravel's Eloquent ORM and Blade templating.
Version: 1.0
Author: NHRRob
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Autoload dependencies
require_once __DIR__ . '/vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Jenssegers\Blade\Blade;
use NHRRob\Movies\Controllers\MovieController;

// Initialize Blade templating
global $blade;
$blade = new Blade(__DIR__ . '/app/Views', __DIR__ . '/cache/views');

// Include Routes
global $nhrrob_movies_routes;
$nhrrob_movies_routes = require __DIR__ . '/routes/web.php';

// Plugin activation hook
register_activation_hook(__FILE__, 'nhrrob_movies_activate');

function nhrrob_movies_activate() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'movies';

    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE $table_name (
            id BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            description TEXT,
            release_date DATE NULL,
            created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}

function nhrrob_movies_init() {
    global $wpdb;

    // Initialize Eloquent ORM
    $capsule = new Capsule;
    $capsule->addConnection([
        'driver'    => 'mysql',
        'host'      => DB_HOST,
        'database'  => DB_NAME,
        'username'  => DB_USER,
        'password'  => DB_PASSWORD,
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => $wpdb->prefix,
    ]);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();
}
add_action('init', 'nhrrob_movies_init');

function nhrrob_movies_admin_menu() {
    add_menu_page(
        'NHR Movies',
        'NHR Movies',
        'manage_options',
        'nhrrob-movies',
        'nhrrob_movies_route',
        'dashicons-video-alt2'
    );
}
add_action('admin_menu', 'nhrrob_movies_admin_menu');

function nhrrob_movies_route() {
    global $nhrrob_movies_routes;

    $current_page = isset($_GET['page']) ? $_GET['page'] : 'nhrrob-movies';
    $action = isset($_GET['action']) ? $_GET['action'] : 'index';
    $route_key = $current_page . '/' . $action;

    if (isset($nhrrob_movies_routes[$route_key])) {
        $controller_action = $nhrrob_movies_routes[$route_key];
        $controller = new $controller_action[0]();
        $method = $controller_action[1];

        if (method_exists($controller, $method)) {
            $controller->$method();
        } else {
            echo 'Error: Method not found.';
        }
    } else {
        echo 'Error: Route not found.';
    }
}

function nhrrob_movies_enqueue_styles() {
    wp_enqueue_style('tailwind-css', 'https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css');
}
add_action('admin_enqueue_scripts', 'nhrrob_movies_enqueue_styles');

// Handle form submissions for adding/editing movies
$movieController = new NHRRob\Movies\Controllers\MovieController();

add_action('admin_post_nhrrob_movies_store', [$movieController, 'store']);
add_action('admin_post_nhrrob_movies_update', [$movieController, 'update']);
add_action('admin_post_nhrrob_movies_delete', [$movieController, 'destroy']);

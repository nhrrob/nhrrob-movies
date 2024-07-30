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

// Initialize Blade templating
global $blade;
$blade = new Blade(__DIR__ . '/app/Views', __DIR__ . '/cache/views');

// Plugin activation hook
register_activation_hook(__FILE__, 'nhrrob_movies_activate');

/**
 * Activation hook to set up the database.
 */
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

/**
 * Initialize the plugin's core functionalities.
 */
function nhrrob_movies_init() {
    global $wpdb, $blade;

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

    // Register routes (if any for frontend)
    $controller = new \NHRRob\Movies\Controllers\MovieController();
    $controller->registerRoutes();
}
add_action('init', 'nhrrob_movies_init');

/**
 * Register the admin menu.
 */
function nhrrob_movies_admin_menu() {
    add_menu_page(
        'NHR Movies',
        'NHR Movies',
        'manage_options',
        'nhrrob-movies',
        'nhrrob_movies_list_page',
        'dashicons-video-alt2', // Icon for the menu
        // 6 // Position in the admin menu
    );

    add_submenu_page(
        null,
        'Add New Movie',
        'Add New',
        'manage_options',
        'nhrrob-movies-add',
        'nhrrob_movies_add_page'
    );

    add_submenu_page(
        null,
        'Edit Movie',
        'Edit Movie',
        'manage_options',
        'nhrrob-movies-edit',
        'nhrrob_movies_edit_page'
    );
}
add_action('admin_menu', 'nhrrob_movies_admin_menu');

/**
 * Render the list of movies.
 */
function nhrrob_movies_list_page() {
    if (!current_user_can('manage_options')) {
        return;
    }
    global $blade;
    $movies = \NHRRob\Movies\Models\Movie::all();
    echo $blade->render('admin.movies-list', ['movies' => $movies]);
}

/**
 * Render the Add Movie form.
 */
function nhrrob_movies_add_page() {
    global $blade;
    echo $blade->render('admin.movie-add');
}

/**
 * Render the Edit Movie form.
 */
function nhrrob_movies_edit_page() {
    global $blade;
    $movie_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $movie = \NHRRob\Movies\Models\Movie::find($movie_id);
    echo $blade->render('admin.movie-edit', ['movie' => $movie]);
}

/**
 * Handle form submissions for adding/editing movies.
 */
function nhrrob_movies_handle_form_submission() {
    if (!isset($_POST['nhrrob_movies_nonce']) || !wp_verify_nonce($_POST['nhrrob_movies_nonce'], 'nhrrob_movies_nonce_action')) {
        return;
    }
    if (!current_user_can('manage_options')) {
        return;
    }

    $movie_id = isset($_POST['movie_id']) ? intval($_POST['movie_id']) : null;
    $movie = $movie_id ? \NHRRob\Movies\Models\Movie::find($movie_id) : new \NHRRob\Movies\Models\Movie;

    $movie->title = sanitize_text_field($_POST['title']);
    $movie->description = sanitize_textarea_field($_POST['description']);
    $movie->release_date = $_POST['release_date'] ?: null;

    $movie->save();
    wp_redirect(admin_url('admin.php?page=nhrrob-movies'));
    exit;
}
add_action('admin_post_nhrrob_movies_save', 'nhrrob_movies_handle_form_submission');

/**
 * Handle deletion of movies.
 */
function nhrrob_movies_handle_delete() {
    if (!isset($_GET['nhrrob_movies_nonce']) || !wp_verify_nonce($_GET['nhrrob_movies_nonce'], 'nhrrob_movies_delete_nonce')) {
        wp_die(__('Invalid nonce specified', 'nhrrob-movies'), __('Error', 'nhrrob-movies'), ['response' => 403]);
    }
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have permission to delete this movie', 'nhrrob-movies'), __('Error', 'nhrrob-movies'), ['response' => 403]);
    }

    $movie_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $movie = \NHRRob\Movies\Models\Movie::find($movie_id);
    if ($movie) {
        $movie->delete();
    }
    wp_redirect(admin_url('admin.php?page=nhrrob-movies'));
    exit;
}
add_action('admin_post_nhrrob_movies_delete', 'nhrrob_movies_handle_delete');

/**
 * Run migrations on plugin activation.
 */
function nhrrob_movies_run_migrations() {
    \NHRRob\Movies\Database\Migrations\UpdateReleaseDateNullable::up();
}
register_activation_hook(__FILE__, 'nhrrob_movies_run_migrations');

/**
 * Revert migrations on plugin deactivation.
 */
function nhrrob_movies_revert_migrations() {
    \NHRRob\Movies\Database\Migrations\UpdateReleaseDateNullable::down();
}
register_deactivation_hook(__FILE__, 'nhrrob_movies_revert_migrations');

/**
 * Enqueue styles for the admin pages.
 */
function nhrrob_movies_enqueue_styles() {
    wp_enqueue_style('tailwind-css', 'https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css');
}
add_action('admin_enqueue_scripts', 'nhrrob_movies_enqueue_styles');

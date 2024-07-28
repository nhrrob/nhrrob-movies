<?php
/*
Plugin Name: NHRRob Movies
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

// Global Blade instance
global $blade;

// Plugin activation hook
register_activation_hook(__FILE__, 'nhrrob_movies_activate');
function nhrrob_movies_activate() {
    global $wpdb;

    // Table name
    $table_name = $wpdb->prefix . 'movies';

    // Check if the table already exists
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        // SQL statement for table creation
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE $table_name (
            id BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            description TEXT,
            release_date DATE,
            created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}

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

    // Set up Blade templating
    $blade = new Blade(__DIR__ . '/app/Views', __DIR__ . '/cache/views');

    // Register routes (if any for frontend)
    $controller = new \NHRRob\Movies\Controllers\MovieController();
    $controller->registerRoutes();
}

add_action('init', 'nhrrob_movies_init');

function nhrrob_movies_settings_page() {
    // Check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }

    global $blade;

    echo $blade->render('admin.settings');
}

function nhrrob_movies_list_page() {
    // Check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }

    global $blade;

    // Fetch movies using the Eloquent model
    $movies = \NHRRob\Movies\Models\Movie::all();

    echo $blade->render('admin.movies-list', ['movies' => $movies]);
}

// Register settings
function nhrrob_movies_register_settings() {
    register_setting('nhrrob_movies_options_group', 'nhrrob_movies_option_name');
}

add_action('admin_init', 'nhrrob_movies_register_settings');

// Add this part to your existing `nhrrob-movies.php` file

function nhrrob_movies_admin_menu() {
    add_menu_page(
        'NHRRob Movies Settings',
        'NHRRob Movies',
        'manage_options',
        'nhrrob-movies',
        'nhrrob_movies_settings_page'
    );

    add_submenu_page(
        'nhrrob-movies',
        'Movie List',
        'Movies',
        'manage_options',
        'nhrrob-movies-list',
        'nhrrob_movies_list_page'
    );

    add_submenu_page(
        'nhrrob-movies',
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

// Handler for the Add New Movie page
function nhrrob_movies_add_page() {
    global $blade;

    // Render the Add Movie form
    echo $blade->render('admin.movie-add');
}

// Handler for the Edit Movie page
function nhrrob_movies_edit_page() {
    global $blade;

    // Get the movie ID from the query string
    $movie_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    // Fetch the movie details using Eloquent
    $movie = \NHRRob\Movies\Models\Movie::find($movie_id);

    // Render the Edit Movie form
    echo $blade->render('admin.movie-edit', ['movie' => $movie]);
}

// Handle form submissions
function nhrrob_movies_handle_form_submission() {
    // Check for nonce and capabilities
    if (!isset($_POST['nhrrob_movies_nonce']) || !wp_verify_nonce($_POST['nhrrob_movies_nonce'], 'nhrrob_movies_nonce_action')) {
        return;
    }

    if (!current_user_can('manage_options')) {
        return;
    }

    // Process the form data
    if (isset($_POST['movie_id']) && $_POST['movie_id']) {
        // Update an existing movie
        $movie = \NHRRob\Movies\Models\Movie::find($_POST['movie_id']);
    } else {
        // Create a new movie
        $movie = new \NHRRob\Movies\Models\Movie;
    }

    $movie->title = sanitize_text_field($_POST['title']);
    $movie->description = sanitize_textarea_field($_POST['description']);
    $movie->release_date = $_POST['release_date']; // Consider validating the date format

    $movie->save();

    // Redirect after saving
    wp_redirect(admin_url('admin.php?page=nhrrob-movies-list'));
    exit;
}

add_action('admin_post_nhrrob_movies_save', 'nhrrob_movies_handle_form_submission');

// Handle delete requests
function nhrrob_movies_handle_delete() {
    // Check for nonce and capabilities
    if (!isset($_GET['nhrrob_movies_nonce']) || !wp_verify_nonce($_GET['nhrrob_movies_nonce'], 'nhrrob_movies_delete_nonce')) {
        wp_die(__('Invalid nonce specified', 'nhrrob-movies'), __('Error', 'nhrrob-movies'), ['response' => 403]);
    }

    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have permission to delete this movie', 'nhrrob-movies'), __('Error', 'nhrrob-movies'), ['response' => 403]);
    }

    // Delete the movie
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $movie = \NHRRob\Movies\Models\Movie::find(intval($_GET['id']));
        if ($movie) {
            $movie->delete();
        }
    }

    // Redirect after deletion
    wp_redirect(admin_url('admin.php?page=nhrrob-movies-list'));
    exit;
}

add_action('admin_post_nhrrob_movies_delete', 'nhrrob_movies_handle_delete');


// function nhrrob_movies_update_db() {
//     \NHRRob\Movies\Database\Migrations\UpdateMoviesTable::up();
// }
// register_activation_hook(__FILE__, 'nhrrob_movies_update_db');

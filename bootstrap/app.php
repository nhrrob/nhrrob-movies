<?php 

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

use Jenssegers\Blade\Blade;
use Nhrrob\Movies\Database\Connection;
use Nhrrob\Movies\Database\Migrations\AddReleaseDateToMoviesTable;
use Nhrrob\Movies\Database\Migrations\CreateMoviesTable;

// DB Connection
add_action('init', 'nhrrob_movies_init');

function nhrrob_movies_init() {
    Connection::up();
}

// Plugin activation hook
register_activation_hook(NHRROB_MOVIES_FILE, 'nhrrob_movies_activate');

function nhrrob_movies_activate() {
    CreateMoviesTable::up();
    AddReleaseDateToMoviesTable::up();
}

// Initialize Blade templating
global $blade;
$blade = new Blade(__DIR__ . '/../resources/views', __DIR__ . '/../cache/views');

// Include Routes
global $nhrrob_movies_routes;
$nhrrob_movies_routes = require __DIR__ . '/../routes/web.php';
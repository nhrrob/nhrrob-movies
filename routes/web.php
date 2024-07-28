<?php

use NHRRob\Movies\Controllers\MovieController;

$controller = new MovieController();

add_action('wp_ajax_nhrrob_get_movies', [$controller, 'index']);
add_action('wp_ajax_nopriv_nhrrob_get_movies', [$controller, 'index']);

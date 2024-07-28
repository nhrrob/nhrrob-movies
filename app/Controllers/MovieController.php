<?php

namespace NHRRob\Movies\Controllers;

use NHRRob\Movies\Models\Movie;

class MovieController {

    public function index() {
        global $blade;

        $movies = Movie::all();
        echo $blade->render('movies.index', ['movies' => $movies]);
    }

    public function registerRoutes() {
        add_action('wp_ajax_nhrrob_get_movies', [$this, 'index']);
        add_action('wp_ajax_nopriv_nhrrob_get_movies', [$this, 'index']);
    }
}

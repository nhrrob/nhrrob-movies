<?php

namespace NHRRob\Movies\Controllers;

use NHRRob\Movies\Models\Movie;

class MovieController {
    
    public function index() {
        global $blade;
        $movies = Movie::all();
        echo $blade->render('admin.movie.index', ['movies' => $movies]);
    }

    public function create() {
        global $blade;
        echo $blade->render('admin.movie.create');
    }

    public function store() {
        $movie = new Movie;
        $movie->title = sanitize_text_field($_POST['title']);
        $movie->description = sanitize_textarea_field($_POST['description']);
        $movie->release_date = $_POST['release_date'] ?: null;

        $movie->save();
        wp_redirect(admin_url('admin.php?page=nhrrob-movies'));
        exit;
    }

    public function show($id) {
        global $blade;
        $movie = Movie::find($id);
        echo $blade->render('admin.movies.show', ['movie' => $movie]);
    }

    public function edit() {
        global $blade;
        $movie_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $movie = Movie::find($movie_id);
        echo $blade->render('admin.movie.edit', ['movie' => $movie]);
    }

    public function update() {
        $movie_id = intval($_POST['movie_id']);
        $movie = Movie::find($movie_id);

        if ($movie) {
            $movie->title = sanitize_text_field($_POST['title']);
            $movie->description = sanitize_textarea_field($_POST['description']);
            $movie->release_date = $_POST['release_date'] ?: null;

            $movie->save();
        }

        wp_redirect(admin_url('admin.php?page=nhrrob-movies'));
        exit;
    }

    public function destroy() {
        $movie_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $movie = Movie::find($movie_id);
        if ($movie) {
            $movie->delete();
        }
        wp_redirect(admin_url('admin.php?page=nhrrob-movies'));
        exit;
    }

    public function registerRoutes() {
        add_action('admin_post_nhrrob_movies_save', [$this, 'store']);
        add_action('admin_post_nhrrob_movies_delete', [$this, 'destroy']);
    }
}

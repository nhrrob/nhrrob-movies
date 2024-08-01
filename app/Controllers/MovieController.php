<?php

namespace Nhrrob\Movies\Controllers;

use Nhrrob\Movies\Models\Movie;

class MovieController
{

    public function index()
    {
        global $blade;
        $movies = Movie::latest()->get();
        echo $blade->render('admin.movie.index', ['movies' => $movies]);
    }

    public function create()
    {
        global $blade;
        echo $blade->render('admin.movie.create');
    }

    public function store()
    {
        // Verify nonce
        check_admin_referer('nhrrob_movies_nonce_action', 'nhrrob_movies_nonce');

        $movie = new Movie;
        $movie->title = sanitize_text_field($_POST['title']);
        $movie->description = sanitize_textarea_field($_POST['description']);
        $movie->release_date = sanitize_text_field($_POST['release_date']) ?: null;

        $movie->save();
        wp_redirect(admin_url('admin.php?page=nhrrob-movies'));
        exit;
    }

    public function edit()
    {
        global $blade;
        $movie_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $movie = Movie::find($movie_id);
        echo $blade->render('admin.movie.edit', ['movie' => $movie]);
    }

    public function update()
    {
        // Verify nonce
        check_admin_referer('nhrrob_movies_nonce_action', 'nhrrob_movies_nonce');

        $movie_id = intval($_POST['movie_id']);
        $movie = Movie::find($movie_id);

        if ($movie) {
            $movie->title = sanitize_text_field($_POST['title']);
            $movie->description = sanitize_textarea_field($_POST['description']);
            $movie->release_date = sanitize_textarea_field($_POST['release_date']) ?: null;

            $movie->save();
        }

        wp_redirect(admin_url('admin.php?page=nhrrob-movies'));
        exit;
    }

    public function destroy()
    {
        // Verify nonce
        check_admin_referer('nhrrob_movies_delete_nonce');

        $movie_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $movie = Movie::find($movie_id);
        if ($movie) {
            $movie->delete();
        }
        wp_redirect(admin_url('admin.php?page=nhrrob-movies'));
        exit;
    }
}

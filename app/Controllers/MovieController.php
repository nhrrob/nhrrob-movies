<?php

namespace Nhrrob\Movies\Controllers;

use Nhrrob\Movies\Models\Movie;
use Nhrrob\Movies\Traits\GlobalTrait;

class MovieController
{

    use GlobalTrait;

    public function index()
    {
        global $blade;
        $movies = Movie::latest()->get();
        echo wp_kses($blade->render('admin.movie.index', ['movies' => $movies]), $this->allowed_html());
    }

    public function create()
    {
        global $blade;
        echo wp_kses( $blade->render('admin.movie.create'), $this->allowed_html() );
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
        echo wp_kses( $blade->render('admin.movie.edit', ['movie' => $movie]), $this->allowed_html() );
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

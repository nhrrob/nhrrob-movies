<?php

namespace MoviePlugin\Http\Controllers;

use MoviePlugin\Movie;
use Illuminate\Http\Request;

class MovieController
{
    public function index()
    {
        $movies = Movie::all();
        return view('movies', compact('movies'));
    }

    public function create()
    {
        // Add logic for creating a movie
    }

    // Add other CRUD methods as needed
}

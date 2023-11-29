<?php

namespace nhrrob_movies\Http\Controllers;

use nhrrob_movies\Movie;
use Illuminate\Http\Request;

class MovieController
{
    public function index()
    {
        $movies = Movie::all();
        return view('movies.index', compact('movies'));
    }

    public function create()
    {
        return view('movies.create');
    }

    public function store(Request $request)
    {
        $movie = new Movie();
        $movie->title = $request->input('title');
        $movie->description = $request->input('description');
        $movie->release_date = $request->input('release_date');
        $movie->save();

        return redirect('/movies')->with('success', 'Movie created successfully!');
    }

    public function edit($id)
    {
        $movie = Movie::find($id);
        return view('movies.edit', compact('movie'));
    }

    public function update(Request $request, $id)
    {
        $movie = Movie::find($id);
        $movie->title = $request->input('title');
        $movie->description = $request->input('description');
        $movie->release_date = $request->input('release_date');
        $movie->save();

        return redirect('/movies')->with('success', 'Movie updated successfully!');
    }

    public function destroy($id)
    {
        $movie = Movie::find($id);
        $movie->delete();

        return redirect('/movies')->with('success', 'Movie deleted successfully!');
    }
}

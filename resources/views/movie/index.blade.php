@extends('layouts.app')

@section('content')
    <h1>Movies</h1>
    
    @foreach ($movies as $movie)
        <div>
            <h2>{{ $movie->title }}</h2>
            <p>{{ $movie->description }}</p>
            <p>Release Date: {{ $movie->release_date }}</p>
            <a href="{{ route('movies.edit', $movie->id) }}">Edit</a>
            <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </div>
    @endforeach

    <a href="{{ route('movies.create') }}">Add Movie</a>
@endsection

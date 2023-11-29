@extends('layouts.app')

@section('content')
    <h1>Edit Movie</h1>
    
    <form action="{{ route('movies.update', $movie->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Title:</label>
        <input type="text" name="title" value="{{ $movie->title }}" required>
        <br>
        <label>Description:</label>
        <textarea name="description" required>{{ $movie->description }}</textarea>
        <br>
        <label>Release Date:</label>
        <input type="date" name="release_date" value="{{ $movie->release_date }}" required>
        <br>
        <button type="submit">Update</button>
    </form>
@endsection

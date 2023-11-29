@extends('layouts.app')

@section('content')
    <h1>Add Movie</h1>
    
    <form action="{{ route('movies.store') }}" method="POST">
        @csrf
        <label>Title:</label>
        <input type="text" name="title" required>
        <br>
        <label>Description:</label>
        <textarea name="description" required></textarea>
        <br>
        <label>Release Date:</label>
        <input type="date" name="release_date" required>
        <br>
        <button type="submit">Save</button>
    </form>
@endsection

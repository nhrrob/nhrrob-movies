@extends('layouts.master')

@section('content')
<div class="nhrrob-movies">
    <h1>Movies List</h1>
    <ul>
        @if($movies->isNotEmpty())
            @foreach ($movies as $movie)
                <li>{{ $movie->title }}</li>
            @endforeach
        @else
            <li>No movies found.</li>
        @endif
    </ul>
</div>
@endsection

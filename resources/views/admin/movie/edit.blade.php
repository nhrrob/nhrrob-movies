<?php 
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

@extends('layouts.master')

@section('content')
<div class="wrap max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">{{ __('Edit Movie', 'nhrrob-movies') }}</h1>
    <form method="post" action="{{ admin_url('admin-post.php') }}" class="bg-white p-6 rounded-lg shadow-md">
        <input type="hidden" name="action" value="nhrrob_movies_update">
        {!! wp_nonce_field('nhrrob_movies_nonce_action', 'nhrrob_movies_nonce') !!}
        <input type="hidden" name="movie_id" value="{{ $movie->id }}">

        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-bold mb-2">{{ __('Title', 'nhrrob-movies') }}</label>
            <input type="text" id="title" name="title" value="{{ $movie->title }}" class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-bold mb-2">{{ __('Description', 'nhrrob-movies') }}</label>
            <textarea id="description" name="description" class="w-full p-2 border rounded">{{ $movie->description }}</textarea>
        </div>

        <div class="mb-4">
            <label for="release_date" class="block text-gray-700 font-bold mb-2">{{ __('Release Date', 'nhrrob-movies') }}</label>
            <input type="date" id="release_date" name="release_date" value="{{ $movie->release_date }}" class="w-full p-2 border rounded">
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">{{ __('Update Movie', 'nhrrob-movies') }}</button>
        </div>
    </form>
</div>
@endsection

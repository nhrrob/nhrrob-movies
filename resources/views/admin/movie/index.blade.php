<?php 
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

@extends('layouts.master')

@section('content')
<div class="wrap max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg">
    <h1 class="text-3xl font-bold mb-4 text-gray-800">{{ __('Movies', 'nhrrob-movies') }}</h1>
    <div class="flex justify-between items-center mb-6">
        <a href="{{ admin_url('admin.php?page=nhrrob-movies&action=create') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition">{{ __('Add New Movie', 'nhrrob-movies') }}</a>
        <form action="" method="GET" class="flex items-center invisible">
            <input type="text" name="s" placeholder="{{ __('Search Movies...', 'nhrrob-movies') }}" class="border border-gray-300 rounded-l-lg px-4 py-2 focus:outline-none focus:border-blue-500">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r-lg hover:bg-blue-600 transition">{{ __('Search', 'nhrrob-movies') }}</button>
        </form>
    </div>
    
    <table class="w-full border-collapse border border-gray-300 rounded-lg overflow-hidden shadow">
        <thead class="bg-gray-100">
            <tr>
                <th class="border border-gray-300 p-3 text-left">{{ __('#', 'nhrrob-movies') }}</th>
                <th class="border border-gray-300 p-3 text-left">{{ __('Title', 'nhrrob-movies') }}</th>
                <th class="border border-gray-300 p-3 text-left">{{ __('Description', 'nhrrob-movies') }}</th>
                <th class="border border-gray-300 p-3 text-left">{{ __('Release Date', 'nhrrob-movies') }}</th>
                <th class="border border-gray-300 p-3 text-left">{{ __('Actions', 'nhrrob-movies') }}</th>
            </tr>
        </thead>
        <tbody class="bg-white">
            @foreach($movies as $movie)
            <tr class="hover:bg-gray-100 transition">
                <td class="border border-gray-300 p-3">{{ $movie->id }}</td>
                <td class="border border-gray-300 p-3">{{ $movie->title }}</td>
                <td class="border border-gray-300 p-3">{{ $movie->description }}</td>
                <td class="border border-gray-300 p-3">{{ $movie->release_date }}</td>
                <td class="border border-gray-300 p-3 flex space-x-2">
                    <a href="{{ admin_url('admin.php?page=nhrrob-movies&action=edit&id=' . $movie->id) }}" class="text-blue-500 hover:underline">{{ __('Edit', 'nhrrob-movies') }}</a>
                    <a href="{{ admin_url('admin-post.php?action=nhrrob_movies_delete&id=' . $movie->id . '&_wpnonce=' . wp_create_nonce('nhrrob_movies_delete_nonce')) }}" class="text-red-500 hover:underline">{{ __('Delete', 'nhrrob-movies') }}</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

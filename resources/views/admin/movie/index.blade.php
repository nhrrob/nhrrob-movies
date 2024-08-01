<?php 
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

@extends('layouts.master')

@section('content')
<div class="wrap max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">{{ __('Movies', 'nhrrob-movies') }}</h1>
    <a href="{{ admin_url('admin.php?page=nhrrob-movies&action=create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">{{ __('Add New Movie', 'nhrrob-movies') }}</a>
    
    <table class="w-full mt-4 border border-gray-300">
        <thead>
            <tr>
                <th class="border border-gray-300 p-2">{{ __('ID', 'nhrrob-movies') }}</th>
                <th class="border border-gray-300 p-2">{{ __('Title', 'nhrrob-movies') }}</th>
                <th class="border border-gray-300 p-2">{{ __('Actions', 'nhrrob-movies') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($movies as $movie)
            <tr>
                <td class="border border-gray-300 p-2">{{ $movie->id }}</td>
                <td class="border border-gray-300 p-2">{{ $movie->title }}</td>
                <td class="border border-gray-300 p-2">
                    <a href="{{ admin_url('admin.php?page=nhrrob-movies&action=edit&id=' . $movie->id) }}" class="text-blue-500">{{ __('Edit', 'nhrrob-movies') }}</a>
                    <a href="{{ admin_url('admin-post.php?action=nhrrob_movies_delete&id=' . $movie->id . '&_wpnonce=' . wp_create_nonce('nhrrob_movies_delete_nonce')) }}" class="text-red-500 ml-2">{{ __('Delete', 'nhrrob-movies') }}</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

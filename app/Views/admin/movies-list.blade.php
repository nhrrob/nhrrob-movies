@extends('layouts.master')

@section('content')
<div class="wrap">
    <h1>{{ __('Movies', 'nhrrob-movies') }}</h1>
    <table class="widefat fixed" cellspacing="0">
        <thead>
            <tr>
                <th>{{ __('ID', 'nhrrob-movies') }}</th>
                <th>{{ __('Title', 'nhrrob-movies') }}</th>
                <th>{{ __('Release Date', 'nhrrob-movies') }}</th>
                <th>{{ __('Actions', 'nhrrob-movies') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movies as $movie)
                <tr>
                    <td>{{ $movie->id }}</td>
                    <td>{{ $movie->title }}</td>
                    <td>{{ $movie->release_date }}</td>
                    <td>
                        <a href="{{ admin_url('admin.php?page=nhrrob-movies-edit&id=' . $movie->id) }}">{{ __('Edit', 'nhrrob-movies') }}</a>
                        |
                        <a href="{{ admin_url('admin-post.php?action=nhrrob_movies_delete&id=' . $movie->id . '&nhrrob_movies_nonce=' . wp_create_nonce('nhrrob_movies_delete_nonce')) }}"
                           onclick="return confirm('Are you sure you want to delete this movie?');">
                           {{ __('Delete', 'nhrrob-movies') }}
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
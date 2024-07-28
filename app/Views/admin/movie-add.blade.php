@extends('layouts.master')

@section('content')
<div class="wrap">
    <h1>{{ __('Add New Movie', 'nhrrob-movies') }}</h1>
    <form method="post" action="{{ admin_url('admin-post.php') }}">
        <input type="hidden" name="action" value="nhrrob_movies_save">
        {!! wp_nonce_field('nhrrob_movies_nonce_action', 'nhrrob_movies_nonce') !!}

        <table class="form-table">
            <tr valign="top">
                <th scope="row">{{ __('Title', 'nhrrob-movies') }}</th>
                <td><input type="text" name="title" value="" required></td>
            </tr>
            <tr valign="top">
                <th scope="row">{{ __('Description', 'nhrrob-movies') }}</th>
                <td><textarea name="description"></textarea></td>
            </tr>
            <tr valign="top">
                <th scope="row">{{ __('Release Date', 'nhrrob-movies') }}</th>
                <td><input type="date" name="release_date"></td>
            </tr>
        </table>
        <p><button type="submit" class="button button-primary">{{ __('Save Movie', 'nhrrob-movies') }}</button></p>
    </form>
</div>
@endsection

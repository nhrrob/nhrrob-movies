@extends('layouts.master')

@section('content')
<div class="wrap">
    <h1>{{ __('NHRRob Movies Settings', 'nhrrob-movies') }}</h1>
    <form method="post" action="options.php">
        @php settings_fields('nhrrob_movies_options_group'); @endphp
        @php do_settings_sections('nhrrob-movies'); @endphp
        <table class="form-table">
            <tr valign="top">
                <th scope="row">{{ __('Option Name', 'nhrrob-movies') }}</th>
                <td><input type="text" name="nhrrob_movies_option_name" value="{{ esc_attr(get_option('nhrrob_movies_option_name')) }}" /></td>
            </tr>
        </table>
        @php submit_button(); @endphp
    </form>
</div>
@endsection

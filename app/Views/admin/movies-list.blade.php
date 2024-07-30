@extends('layouts.master')

@section('content')
<div class="wrap">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">{{ __('Movies List', 'nhrrob-movies') }}</h1>
        <a href="{{ admin_url('admin.php?page=nhrrob-movies-add') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            {{ __('Add Movie', 'nhrrob-movies') }}
        </a>
    </div>
    <table class="min-w-full bg-white shadow-md rounded-lg">
        <thead class="bg-gray-200">
            <tr>
                <th class="py-2 px-4 border-b text-left">{{ __('Title', 'nhrrob-movies') }}</th>
                <th class="py-2 px-4 border-b text-left">{{ __('Description', 'nhrrob-movies') }}</th>
                <th class="py-2 px-4 border-b text-left">{{ __('Release Date', 'nhrrob-movies') }}</th>
                <th class="py-2 px-4 border-b text-right">{{ __('Actions', 'nhrrob-movies') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($movies as $movie)
            <tr class="hover:bg-gray-100">
                <td class="py-2 px-4 border-b">{{ $movie->title }}</td>
                <td class="py-2 px-4 border-b">{{ $movie->description }}</td>
                <td class="py-2 px-4 border-b">{{ $movie->release_date }}</td>
                <td class="py-2 px-4 border-b text-right">
                    <a href="{{ admin_url('admin.php?page=nhrrob-movies-edit&id=' . $movie->id) }}" class="text-blue-600 hover:underline">{{ __('Edit', 'nhrrob-movies') }}</a>
                    <a href="{{ admin_url('admin.php?page=nhrrob-movies-delete&id=' . $movie->id) }}" class="text-red-600 hover:underline ml-4">{{ __('Delete', 'nhrrob-movies') }}</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

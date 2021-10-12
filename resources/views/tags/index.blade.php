@extends('layouts.main')

@section('content')
    <h2 class="text-2xl font-bold text-gray-900 sm:text-3xl ">
        Tags
    </h2>

    <table class="w-full lg:w-1/2 shadow-lg">
        <thead>
        <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
            <th class="px-4 py-3">Tag name</th>
            <th class="px-4 py-3">Number of tasks</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tags as $tag)
            <tr>
                <td class="px-4 py-3 border">
                    <a href="{{ route('tags.slug', ['slug' => $tag->name]) }}">
                        {{ $tag->name }}
                    </a>
                </td>
                <td class="px-4 py-3 border">
                    {{ $tag->tasks->count() }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection

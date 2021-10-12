@extends('layouts.main')

@section('content')
    <h1 class="text-3xl">All Images</h1>

    <div>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Path</th>
                    <th>Preview</th>
                </tr>
            </thead>
            <tbody>
                @foreach($images as $image)
                    <tr>
                        <td class="border px-2">
                            {{ $image->name }}
                        </td>
                        <td class="border px-2">
                            {{ $image->path }}
                        </td>
                        <td class="border px-2">
                            <img src="{{ url(\Str::replace('public/','storage/',$image->path)) }}"
                                 class="w-16" alt="">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@extends('layouts.main')

@section('content')
    <h2 class="text-2xl font-bold text-gray-900 sm:text-3xl ">
        {{ __('messages.apartments.list') }}
    </h2>

    <hello></hello>

    @can('create', \App\Models\Apartment::class)
    <div class="my-6">
        <a class="border-2 bg-green-300 px-4 py-2 shadow-lg hover:shadow-md"
            href="{{ route('apartments.create') }}">
            + New Apartment
        </a>
    </div>
    @endcan


    <table class="w-full lg:w-1/2 shadow-lg">
        <thead>
            <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                <th class="px-4 py-3">Name</th>
                <th class="px-4 py-3">Floors</th>
                <th class="px-4 py-3">Rooms</th>
                <th class="px-4 py-3">Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($apartments as $apartment)
                <tr class="hover:bg-gray-200">
                    <td class="px-4 py-3 border">
                        <a class="hover:text-blue-600"
                            href="{{ route('apartments.show', ['apartment' => $apartment->id]) }}">
                            {{ $apartment->name }}
                        </a>
                    </td>
                    <td class="px-4 py-3 border">
                        {{ $apartment->floors }}
                    </td>
                    <td class="px-4 py-3 border">
                        {{ $apartment->rooms->count() }}
                    </td>
                    <td class="px-4 py-3 border" title="{{ $apartment->created_at }}">
                        {{ $apartment->created_at->diffForHumans() }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

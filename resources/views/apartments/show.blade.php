@extends('layouts.main')

@section('content')
    <h1>
        Apartment
        <span class="text-5xl">{{ $apartment->name }}</span>
    </h1>

    <p>
        จำนวนชั้น {{ $apartment->floors }} ชั้น
    </p>

    @if ($apartment->officer)
    <p>
        Officer: {{ $apartment->officer->name }}
    </p>
    @endif
    <hr>

    @can('update', $apartment)
    <div class="my-4">
        <a class="px-4 py-2 bg-blue-400 hover:bg-blue-200" href="{{ route('apartments.edit', ['apartment' => $apartment->id]) }}">
            Edit this apartment
        </a>
    </div>
    @endcan

    <div class="mt-8 text-3xl">
        Rooms in This Apartment
    </div>
    @can('update', $apartment)
    <div class="my-2">
        <a href="{{ route('apartments.rooms.create', ['apartment' => $apartment->id]) }}"
           class="bg-blue-400 hover:bg-blue-200 px-4 py-2">
            + Add More Room
        </a>
    </div>
    @endcan

    <div>
        <ul>
            @foreach($apartment->rooms->sortBy('floor') as $room)
                <li>
                    <a class="text-blue-600 hover:text-green-600"
                        href="{{ route('rooms.show', ['room' => $room->id]) }}">
                        {{ $room->type }} - {{ $room->name }}
                    </a>

                    floor {{ $room->floor }}
                </li>

            @endforeach
        </ul>
    </div>

@endsection

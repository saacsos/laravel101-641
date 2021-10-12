@extends('layouts.main')

@section('content')
    <h1 class="text-5xl">
        Room {{ $room->type }}-{{ $room->name }}
    </h1>

    <div class="mt-4 text-3xl">
        Apartment: <span>
            <a href="{{ route('apartments.show', ['apartment' => $room->apartment->id]) }}">
                {{ $room->apartment->name }}
            </a>
        </span>
    </div>
    <div class="mt-2 text-2xl">
        Floor: {{ $room->floor }}
    </div>
    <div class="mt-2">
        <a href="{{ route('rooms.edit', ['room' => $room->id]) }}">
            Edit this room
        </a>
    </div>
@endsection

@extends('layouts.main')

@section('content')
    <h1 class="text-5xl">
        Edit Room {{ $room->name }}
    </h1>
    <h1 class="text-3xl">
        Apartment {{ $room->apartment->name }}
    </h1>

    <form action="{{ route('rooms.update', ['room' => $room->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mt-2">
            <label for="floor">Floor</label>
            <input type="number"
                   name="floor" class="border-2 @error('floor') border-red-400 @enderror"
                   value="{{ old('floor', $room->floor) }}"
            > / {{ $room->apartment->floors }}
            @error('floor')
                <p class="text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div class="mt-2">
            <label for="name">Room Number</label>
            <input type="text" name="name" class="border-2 @error('name') border-red-400 @enderror"
                   value="{{ old('name', $room->name) }}">
            @error('name')
                <p class="text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div class="mt-2">
            <label for="type">Room Type</label>
            <select name="type" id="type" class="border-2 @error('type') border-red-400 @enderror">
                @foreach($room_types as $type)
                    <option @if($type === old('type', $room->type)) selected @endif
                        value="{{ $type }}">
                        {{ $type }}
                    </option>
                @endforeach
            </select>
            @error('type')
            <p class="text-red-600">
                {{ $message }}
            </p>
            @enderror
        </div>

        <div class="mt-2">
            <button class="px-4 py-2 bg-blue-400"
                type="submit">Edit Room</button>
        </div>
    </form>

@endsection

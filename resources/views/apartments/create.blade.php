@extends('layouts.main')

@section('content')
    <h1 class="text-5xl">Add New Apartment</h1>

    <form action="{{ route('apartments.store') }}" method="POST">
        @csrf
        <div class="mt-4">
            <label for="name">Apartment Name</label>
            <input type="text" name="name"
                   value="{{ old('name') }}"
                   class="border-2 p-2 @error('name') border-red-400 @enderror"
                   placeholder="Apartment Name" autocomplete="off">
            @error('name')
                <div class="text-red-600">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mt-4">
            <label for="floors">Floors</label>
            <input type="number"
                   value="{{ old('floors') }}"
                   class="border-2 @error('floors') border-red-400 @enderror"
                   min="1" name="floors">
            @error('floors')
            <div class="text-red-600">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mt-4">
            <button type="submit" class="bg-blue-300 hover:bg-blue-200 px-4 py-2">Add New Apartment</button>
        </div>
    </form>

@endsection

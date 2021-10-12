@extends('layouts.main')

@section('content')
    <h1 class="text-5xl">Edit Apartment</h1>

    <form action="{{ route('apartments.update', ['apartment' => $apartment->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mt-4">
            <label for="name">Apartment Name</label>
            <input type="text" name="name"
                   class="border-2 p-2 @error('name') border-red-400 @enderror"
                   value="{{ old('name', $apartment->name) }}"
                   placeholder="Apartment Name" autocomplete="off">
            @error('name')
                <p class="text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div class="mt-4">
            <label for="floors">Floors</label>
            <input type="number" min="1" name="floors"
                   class="border-2 @error('floors') border-red-400 @enderror"
                    value="{{ old('floors', $apartment->floors) }}">
            @error('floors')
            <p class="text-red-600">
                {{ $message }}
            </p>
            @enderror
        </div>

        <div class="mt-4">
            <button type="submit" class="px-4 py-2 bg-blue-400 hover:bg-blue-200">Edit Apartment</button>
        </div>
    </form>

    <hr class="mt-2">

    <div class="mt-4 bg-red-100 p-6">
        <h1 class="text-4xl">Danger Zone</h1>

        <h2 class="text-3xl mt-4">Delete this apartment</h2>
        <p class="text-red-800 italic">** การลบข้อมูลนี้ ไม่สามารถเรียกกลับคืนได้</p>
        <form action="{{ route('apartments.destroy', ['apartment' => $apartment->id]) }}" method="POST">
            @method('DELETE')
            @csrf

            <div class="my-2">
                <label for="destroy">
                    ใส่ชื่ออพาร์ตเมนต์ เพื่อยืนยันว่าจะลบ
                    (<span class="font-bold">{{ $apartment->name }}</span>)
                </label>
                <input type="text"
                       class="border-2 p-2 w-full"
                       placeholder="ใส่ชื่ออพาร์ตเมนต์ เพื่อยืนยันว่าจะลบ" name="name">
            </div>

            <div>
                <button class="bg-red-600 hover:bg-red-700 text-white rounded px-4 py-1" type="submit">ลบ</button>
            </div>

        </form>
    </div>

@endsection

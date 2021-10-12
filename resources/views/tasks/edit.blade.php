@extends('layouts.main')

@section('content')
    <h2 class="text-2xl font-bold text-gray-900 sm:text-3xl ">
        Edit {{ $task->title }}
    </h2>

    <form action="{{ route('tasks.update', ['task' => $task->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title">Task Title</label>
            <input type="text" class="border w-full p-2"
                   name="title" id="title" value="{{ $task->title }}"
                   autocomplete="off"
                placeholder="Task Title">
        </div>

        <div class="mb-4">
            <label for="detail">Task Detail</label>
            <textarea name="detail" id="detail" class="w-full border p-2" rows="10">{{ $task->detail }}</textarea>
        </div>

        <div class="mb-4">
            <label for="due_date">Due Date</label>
            <input type="date" class="border p-2" value="{{ $task->due_date->format('Y-m-d') }}"
                   name="due_date">
        </div>

        <div class="mb-4">
            <label for="tags">Task Tags (separated with comma)</label>
            <input type="text" class="border p-2 w-full"
                   value="{{ $task->tag_names }}"
                   autocomplete="off" name="tags">
        </div>

        <div>
            <button type="submit" class="border px-4 py-2 bg-blue-300 hover:bg-blue-200">
                Update
            </button>
        </div>
    </form>


    <hr class="mt-4">
    <div class="mt-4 bg-red-100 p-4">
        <h2 class="text-xl text-red-600">DANGER ZONE</h2>

        <form action="{{ route('tasks.destroy', ['task' => $task->id]) }}" method="POST">
            @method('DELETE')
            @csrf


            <div class="mt-2">
                <label for="destroy">
                    Please type a task title <span class="px-2 font-bold bg-white text-red-600">{{ $task->title}}</span> to confirm.
                </label>
                <p class="pl-2 italic text-red-600">Once you delete a task, you've finally reached that point of no return. Please be certain.</p>
                <input type="text" class="border w-full p-2 placeholder-red-300" placeholder="ใส่หัวข้องานเพื่อยืนยันการลบ" name="name">
            </div>
            <div class="mt-2">
                <button type="submit" class="border px-4 py-2 bg-red-400 hover:bg-red-200">
                    ลบ
                </button>
            </div>

        </form>
    </div>
@endsection

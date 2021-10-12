@extends('layouts.main')

@section('content')
    <h2 class="text-2xl font-bold text-gray-900 sm:text-3xl ">
        Add New Task
    </h2>

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="title">Task Title</label>
            <input type="text" class="border w-full p-2"
                   name="title"
                   id="title"
                   autocomplete="off"
                placeholder="Task Title">
        </div>

        <div class="mb-4">
            <label for="detail">Task Detail</label>
            <textarea name="detail" id="detail" class="w-full border p-2" rows="10"></textarea>
        </div>

        <div class="mb-4">
            <label for="due_date">Due Date</label>
            <input type="date" class="border p-2"
                   name="due_date">
        </div>

        <div class="mb-4">
            <label for="tags">Task Tags (separated with comma)</label>
            <input type="text" class="border p-2 w-full"
                   autocomplete="off" name="tags">
        </div>

        <div>
            <button type="submit" class="border-2 px-4 py-2 bg-blue-300 hover:bg-blue-200">
                Add
            </button>
        </div>
    </form>
@endsection

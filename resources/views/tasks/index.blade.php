@extends('layouts.main')

@section('content')
    <h2 class="text-2xl font-bold text-gray-900 sm:text-3xl ">
        Task List
    </h2>

    <div class="my-6">
        <a class="border-2 bg-green-300 px-4 py-2 shadow-lg hover:shadow-md"
           href="{{ route('tasks.create') }}">
            + Add New Task
        </a>
    </div>

    <table class="w-full lg:w-1/2 shadow-lg">
        <thead>
        <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
            <th class="px-4 py-3">หัวข้องาน</th>
            <th class="px-4 py-3">วันสิ้นสุด</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tasks as $task)
            <tr>
                <td class="px-4 py-3 border">
                    @if($task->is_urgent)
                        <span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">ด่วน</span>
                    @endif

                    <a href="{{ route('tasks.show', ['task' => $task->id]) }}">
                        {{ $task->title }}
                    </a>
                </td>
                <td class="px-4 py-3 border @if($task->is_past) text-gray-300 @endif">
                    {{ $task->due_date->format('j M y') }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


@endsection

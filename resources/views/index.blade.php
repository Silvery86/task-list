@extends('layouts.app')
@section('title', 'Task List')
@section('content')
    <div class="flex flex-col justify-center items-center gap-2">
        @if (count($tasks) > 0)
            @foreach ($tasks as $task)
                <a
                class="w-full h-[25vh]"
                href="{{ route('tasks.show', ['task' => $task->id]) }}">
                    <div class="px-5 py-3 mt-3 border border-gray-300 mx-5 rounded-xl">
                        <h3 class="pt-2 text-base/7 font-semibold text-gray-900
                            {{ $task->completed == 1 ? 'line-through text-gray-500' : '' }}">
                            {{ $task->title }}
                        </h3>
                        <p class="mt-1 max-w-2xl text-sm/6 text-gray-500
                            {{ $task->completed == 1 ? 'line-through text-gray-500' : '' }}">
                            {{ $task->description }}
                        </p>
                        <p class="text-sm text-gray-600 mt-2">
                            <span class="font-semibold">Created At:</span> {{ $task->created_at->format('d/m/Y') }}
                        </p>

                        <p class="text-sm text-gray-600">
                            <span class="font-semibold">Updated At:</span> {{ $task->updated_at->diffForHumans() }}
                        </p>
                    </div>
                </a>
            @endforeach
        @else
            <p>No tasks found</p>
        @endif
    </div>
@endsection

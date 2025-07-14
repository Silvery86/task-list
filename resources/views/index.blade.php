@extends('layouts.app')
@section('title', 'Task List')
@section('content')
    <div class="flex flex-col justify-center items-center gap-2">
        @if (count($tasks) > 0)
            @foreach ($tasks as $task)
                <a class="w-full h-[20vh] px-5 py-3 mt-3 border border-gray-300 mx-5 rounded-xl" href="{{ route('tasks.show', ['task' => $task->id]) }}">
                    <div class="">
                        <h3
                            class="pt-2 text-base/7 font-semibold text-gray-900
                            {{ $task->completed == 1 ? 'line-through text-gray-500' : '' }}">
                            {{ $task->title }}
                        </h3>
                        <p
                            class="mt-1 max-w-2xl text-sm/6 text-gray-500
                            {{ $task->completed == 1 ? 'line-through text-gray-500' : '' }}">
                            {{ $task->description }}
                        </p>
                        @if ($task->deadline)
                            <p class="text-sm mt-1 flex items-center gap-1" x-data="countdown('{{ $task->deadline }}')" x-init="init()">
                                <span class="font-semibold">Remaining:</span>
                                <span :class="color()" x-text="remaining"></span>
                                <span x-show="showAlert()" class="animate-shake">⚠️</span>
                            </p>
                        @endif
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

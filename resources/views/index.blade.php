@extends('layouts.app')
@section('title', 'Task List')
@section('content')
    <div class="flex flex-col justify-center items-center gap-2">
        @if (count($tasks) > 0)
            @foreach ($tasks as $task)
                <a href="{{ route('tasks.show', ['task' => $task->id]) }}"
                    class="w-full h-auto px-5 py-3 mt-3 border border-gray-300 mx-5 rounded-xl">

                    <div class="flex flex-col gap-4 md:flex-row md:gap-2">
                        <div class="w-full md:w-1/2 pr-4 flex flex-col justify-center items-start">
                            <h2
                                class="pt-2 text-2xl font-semibold text-gray-900 {{ $task->completed ? 'line-through text-gray-500' : '' }}">
                                {{ $task->title }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-500 {{ $task->completed ? 'line-through text-gray-500' : '' }}">
                                {{ $task->description }}
                            </p>
                        </div>

                        @if ($task->deadline)
                            <div class="w-full md:w-1/2 pr-4 flex flex-col justify-center items-start" x-data="countdown('{{ $task->deadline }}', '{{ $task->created_at }}')"
                                x-init="init()">
                                <div class="w-full flex flex-row justify-between items-center">
                                    <p class="text-sm mb-1">
                                        <span x-text="total()"></span>
                                    </p>
                                    <p class="text-sm mb-1 flex flex-row justify-center items-center">
                                        <span :class="color()" x-text="remaining"></span>
                                        <svg x-show="showAlert()" xmlns="http://www.w3.org/2000/svg"
                                            class="w-4 h-4 ml-2 animate-shake text-red-600" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01M4.93 4.93a10 10 0 1114.14 14.14A10 10 0 014.93 4.93z" />
                                        </svg>
                                    </p>
                                </div>


                                <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-indigo-600 transition-all duration-500"
                                        :style="`width: ${progressPercent()}%`">
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="mt-3 text-sm text-gray-600 flex justify-start gap-4">
                        <span><strong>Created:</strong> {{ $task->created_at->format('d/m/Y H:i') }}</span>
                        <span><strong>Updated:</strong> {{ $task->updated_at->diffForHumans() }}</span>
                    </div>
                </a>
            @endforeach
        @else
            <p>No tasks found</p>
        @endif
    </div>
@endsection

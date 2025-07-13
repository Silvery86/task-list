@extends('layouts.app')

@section('title', $task->title)

@section('content')
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6 mt-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">{{ $task->title }}</h1>

        <p class="text-gray-600">{{ $task->description }}</p>

        @if ($task->long_description)
            <p class="mt-4 text-gray-700">{{ $task->long_description }}</p>
        @endif

        <p class="mt-4 text-sm text-gray-500">
            <span class="font-semibold">Status:</span>
            <span class="{{ $task->completed ? 'text-green-600' : 'text-red-600' }}">
                {{ $task->completed ? 'Completed' : 'In Completed' }}
            </span>
        </p>

        <p class="text-sm text-gray-500 mt-2">
            <span class="font-semibold">Created At:</span> {{ $task->created_at->format('M d, Y') }}
        </p>

        <p class="text-sm text-gray-500">
            <span class="font-semibold">Updated At:</span> {{ $task->updated_at->diffForHumans() }}
        </p>
        @if ($task->completed == 0)
            <!-- Delete Form -->
            <div class="mt-6 flex flex-wrap justify-start items-center gap-2">
                <form action="{{ route('tasks.toggle.completed', $task) }}" method="POST" class="inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit"
                        class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition-all">
                        ✅ Mark as Completed
                    </button>
                </form>
                <a
                href="{{ route('tasks.edit', ['task' => $task]) }}"
                class="btn bg-blue-400 hover:bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition-all">Edit
                    Task</a>
                <div x-data="{ open: false }">
                    <!-- Delete Button (Opens Modal) -->
                    <button type="button" @click="open = true"
                        class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition-all">
                        🗑 Delete Task
                    </button>

                    <!-- Delete Confirmation Modal -->
                    <div x-show="open" x-cloak
                        class="fixed inset-0 bg-gray-500/50 bg-opacity-50 flex items-center justify-center">
                        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                            <h2 class="text-lg font-semibold text-gray-800">Confirmation</h2>
                            <p class="text-gray-600 mt-2">Are you sure you want to delete this task? This action cannot be
                                undone.</p>

                            <div class="flex justify-end mt-4">
                                <!-- Cancel Button -->
                                <button @click="open = false"
                                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded mr-2">
                                    Cancel
                                </button>

                                <!-- Confirm Delete Form -->
                                <form action="{{ route('tasks.destroy', ['task' => $task->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                                        Yes, Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @else
            <form action="{{ route('tasks.toggle.completed', $task) }}" method="POST" class="inline">
                @csrf
                @method('PATCH')
                <button type="submit"
                    class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition-all">
                    Mark as In Completed
                </button>
            </form>
        @endif
        <!-- Back Link -->
        <a href="{{ route('tasks.index') }}" class="inline-block mt-4 text-blue-500 hover:underline">
            ⬅ Back to Tasks
        </a>
    </div>

@endsection

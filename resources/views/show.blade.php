@extends('layouts.app')

@section('title', 'Task Detail')

@section('content')
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6 mt-6">
        <div class="flex flex-col gap-2 md:flex-row">
            <div class="w-full md:w-1/2">
                <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $task->title }}</h1>

                <p class="text-gray-600 mb-2">{{ $task->description }}</p>

                @if ($task->long_description)
                    <p class="text-gray-700 mb-4">{{ $task->long_description }}</p>
                @endif


            </div>

            @if ($task->deadline)
                <div class="w-full md:w-1/2" x-data="countdown('{{ $task->deadline }}', '{{ $task->created_at }}')" x-init="init()">
                    <div class="text-sm mb-2">
                        <span class="font-semibold">Total time:</span>
                        <span x-text="total()"></span>
                    </div>

                    <div class="text-sm mb-2 flex items-center">
                        <span class="font-semibold mr-1">Remaining:</span>
                        <span :class="color()" x-text="remaining"></span>
                        <svg x-show="showAlert()" xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4 ml-2 animate-shake text-red-600" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01M4.93 4.93a10 10 0 1114.14 14.14A10 10 0 014.93 4.93z" />
                        </svg>
                    </div>

                    <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden">
                        <div class="h-full bg-indigo-600 transition-all duration-500"
                            :style="`width: ${progressPercent()}%`"></div>
                    </div>
                </div>
            @endif
        </div>

        <div class="mt-4 text-sm text-gray-500 flex justify-between flex-wrap gap-2">
            <span>
                <strong>Status:</strong> <span class="{{ $task->completed ? 'text-green-600' : 'text-red-600' }}">
                    {{ $task->completed ? 'Completed' : 'Incompleted' }}
                </span>
            </span>
            <span><strong>Created At:</strong> {{ $task->created_at->format('M d, Y H:i') }}</span>
            <span><strong>Updated At:</strong> {{ $task->updated_at->diffForHumans() }}</span>
        </div>

        <div class="mt-6 flex flex-wrap justify-start items-center gap-2">
            <form action="{{ route('tasks.toggle.completed', $task) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit"
                    class="{{ $task->completed ? 'bg-red-500 hover:bg-red-600' : 'bg-green-500 hover:bg-green-600' }}
                           text-white font-semibold py-2 px-4 rounded-lg shadow-md transition-all">
                    {{ $task->completed ? 'Mark as Incompleted' : '✅ Mark as Completed' }}
                </button>
            </form>

            @if ($task->completed == 0)
                <a href="{{ route('tasks.edit', ['task' => $task]) }}"
                    class="bg-blue-400 hover:bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition-all">
                    🖋️ Edit Task
                </a>

                <div x-data="{ open: false }">
                    <button type="button" @click="open = true"
                        class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition-all">
                        🗑 Delete Task
                    </button>

                    <div x-show="open" x-cloak class="fixed inset-0 bg-gray-500/50 flex items-center justify-center">
                        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                            <h2 class="text-lg font-semibold text-gray-800">Confirmation</h2>
                            <p class="text-gray-600 mt-2">Are you sure you want to delete this task?</p>

                            <div class="flex justify-end mt-4">
                                <button @click="open = false"
                                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded mr-2">
                                    Cancel
                                </button>

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
            @endif
        </div>

        <a href="{{ route('tasks.index') }}" class="inline-block mt-6 text-blue-500 hover:underline">
            ⬅ Back to Tasks
        </a>
    </div>
@endsection

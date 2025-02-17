@section('title', isset($task) ? 'Edit Task' : 'Create Task')
@section('styles')
    <style type="text/tailwindcss">
        .error-message {
            @apply text-red-500 text-sm/6 mt-3
        }
    </style>
@section('content')
    <form action="{{ isset($task) ? route('tasks.update',['task' => $task]) : route('tasks.store') }}" method="POST">
        <div class="space-y-12">

                @csrf
                @isset($task)
                    @method('PUT')
                @endisset
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="col-span-full">
                        <label for="title" class="block text-sm/6 font-medium text-gray-900">Title</label>
                        <input type="text" name="title" id="title" value="{{ $task->title ?? old('title') }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        @error('title')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-span-full">
                        <label for="description" class="block text-sm/6 font-medium text-gray-900">Description</label>
                        <textarea name="description" id="description" rows="5"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">{{ $task->description ?? old('description') }}</textarea>
                        @error('description')
                            <p class="error-message mt-3 text-sm/6">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-span-full">
                        <label for="long_description" class="block text-sm/6 font-medium text-gray-900">Long Description</label>
                        <textarea name="long_description" id="long_description" rows="5" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">{{ $task->long_description ?? old('long_description') }}</textarea>
                        @error('long_description')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn bg-green-500 hover:bg-green-600 col-span-full">
                        @isset($task)
                            Update Task
                        @else
                            Create Task
                        @endisset
                    </button>
                </div>

        </div>
    </form>
@endsection

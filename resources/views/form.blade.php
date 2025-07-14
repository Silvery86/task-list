@section('content')
    <form action="{{ isset($task) ? route('tasks.update', ['task' => $task]) : route('tasks.store') }}" method="POST">
        <div class="space-y-12">
            @csrf
            @isset($task)
                @method('PUT')
            @endisset
            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="col-span-full">
                    <label for="title" class="block text-sm/6 font-medium text-gray-900">Title</label>
                    <input type="text" name="title" id="title" value="{{ $task->title ?? old('title') }}"
                        class="block w-full border rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm {{ $errors->has('title') ? 'border-red-500' : 'border-gray-300' }}">
                    @error('title')
                        <p class="error-message mt-3 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-span-full">
                    <label for="description" class="block text-sm/6 font-medium text-gray-900">Description</label>
                    <textarea name="description" id="description" rows="5"
                        class="block w-full border rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm {{ $errors->has('description') ? 'border-red-500' : 'border-gray-300' }}">{{ $task->description ?? old('description') }}</textarea>
                    @error('description')
                        <p class="error-message mt-3 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-span-full">
                    <label for="long_description" class="block text-sm/6 font-medium text-gray-900">Long Description</label>
                    <textarea name="long_description" id="long_description" rows="5"
                        class="block w-full border rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm {{ $errors->has('description') ? 'border-red-500' : 'border-gray-300' }}">{{ $task->long_description ?? old('long_description') }}</textarea>
                    @error('long_description')
                        <p class="error-message mt-3 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-span-full flex justify-center">
                    <button type="submit" class="btn bg-green-500 hover:bg-green-600 px-3 py-2">
                        @isset($task)
                            Update Task
                        @else
                            Create Task
                        @endisset
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection

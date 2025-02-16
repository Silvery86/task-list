@extends('layouts.app')
@section('title', 'Task List')
@section('content')
<div>
    @if (count($tasks) > 0)
        @foreach ($tasks as $task)
            <div>
                <a href="{{ route('tasks.show', $task->id) }}">{{ $task->title }}</a>
            </div>
        @endforeach
    @else
        <p>No tasks found</p>
    @endif
</div>
@endsection

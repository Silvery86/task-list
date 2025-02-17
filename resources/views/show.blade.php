@extends('layouts.app')
@section('title',  $task->title )
@section('content')

<p>{{ $task->description }}</p>
@if ($task->long_description)
    <p>{{ $task->long_description }}</p>
@endif
<p>{{ $task->completed }}</p>
<p>{{ $task->created_at }}</p>
<p>{{ $task->updated_at }}</p>

<form action="{{ route('tasks.destroy', ['task' => $task->id]) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit">Delete Task</button>
</form>
<a href="{{ route('tasks.index') }}">Back</a>
@endsection

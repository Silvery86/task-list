@extends('layouts.app')
@section('title', 'Create Task')
@section('styles')
    <style type="text/tailwindcss">
        .error-message {
            @apply text-red-500 text-sm/6 mt-3;
        }
    </style>
@endsection
@section('content')
    @include('form')
@endsection

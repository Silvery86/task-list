<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Task List</title>


    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style type="text/tailwindcss">
        .btn {
            @apply text-white font-semibold py-2 px-4 rounded-lg shadow-md transition-all
        }
    </style>
    @yield('styles')
</head>

<body>
    @include('nav')
    @include('page_heading')
    <main class="container mx-auto p-6 max-w-4xl">
        @if (session()->has('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
                class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md shadow-md transition-opacity duration-500">
                <p class="font-semibold">{{ session('success') }}</p>
            </div>
        @endif

        @yield('content')
    </main>
</body>

</html>

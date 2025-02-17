<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Task List</title>
    @yield('styles')
</head>
<body>
    <h1>@yield('title')</h1>
    <div>
        @if( session()->has('success') )
            <p style="color: green">{{ session('success') }}</p>
        @endif
        @yield('content')
    </div>
</body>
</html>

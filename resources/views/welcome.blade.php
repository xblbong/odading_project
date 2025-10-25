<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>


    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @include('components.layouts.header')
    
    <h1 class="bg-cyan-500">
        Welcome to Laravel
    </h1>
    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif
</body>

</html>

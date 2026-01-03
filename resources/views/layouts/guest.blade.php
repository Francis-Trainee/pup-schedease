<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="icon" href="{{ asset('images/pup-logo.png') }}" type="image/png">
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">

        <!-- Background image -->
        <div class="absolute inset-0">
            <img src="{{ asset('images/bg (2).jpg') }}" class="w-full h-full object-cover"
                style="filter: brightness(50%);">
        </div>

        <!-- Page content -->
        <div class="relative z-10 w-full sm:max-w-md px-6 py-4 bg-white shadow-md sm:rounded-lg">

            <!-- Logo -->
            <div class="flex items-center justify-center mb-6 gap-3">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                <div class="leading-tight">
                    <div class="text-2xl font-heading font-bold text-red-600">PUP SCHEDEASE</div>
                    <div class="text-sm text-gray-500">Your organised class scheduling</div>
                </div>
            </div>

            <!-- Slot -->
            {{ $slot }}
        </div>
    </div>
</body>

</html>

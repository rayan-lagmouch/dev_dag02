<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bowling Centrum') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">

<!-- Navigation -->
<nav class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="/">
                        <img class="h-8 w-auto" src="/logo.png" alt="Bowling Center Logo">
                    </a>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                    <a href="{{ url('/') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-indigo-500 text-sm font-medium text-gray-900">Home</a>
                    <a href="{{ url('/reservation') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">Reservation</a>
                </div>
            </div>

            <!-- Login & Register Links -->
            <div class="flex items-center space-x-4">
                <a href="/login" class="text-sm font-medium text-gray-500 hover:text-gray-700">Login</a>
                <span>|</span>
                <a href="/register" class="text-sm font-medium text-gray-500 hover:text-gray-700">Register</a>
            </div>
        </div>
    </div>
</nav>


<!-- Page Heading -->
@isset($header)
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            {{ $header }}
        </div>
    </header>
@endisset

<!-- Page Content -->
<main class="min-h-screen">
    @yield('content')
</main>

<!-- Footer -->
<footer class="bg-gray-900 text-gray-400 py-8">
    <div class="max-w-6xl mx-auto px-4 text-center">
        <p class="mb-2">&copy; {{ date('Y') }} Bowling Centrum. All rights reserved.</p>
        <div class="flex justify-center space-x-4 mt-2">
            <a href="#" class="hover:text-white">Privacy</a>
            <a href="#" class="hover:text-white">Terms</a>
            <a href="#" class="hover:text-white">Contact</a>
        </div>
    </div>
</footer>

</body>
</html>

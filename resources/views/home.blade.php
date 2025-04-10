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
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="relative bg-cover bg-center h-[90vh] flex items-center justify-center text-white" style="background-image: url('https://images.unsplash.com/photo-1600641448661-d42fd84d8d1d?auto=format&fit=crop&w=1950&q=80');">
    <div class="bg-black bg-opacity-60 p-10 rounded-xl text-center">
        <h1 class="text-5xl font-bold mb-4 animate-fade-in-up">Welcome to Bowling Centrum</h1>
        <p class="text-xl mb-6 animate-fade-in-up delay-200">Your ultimate destination for fun, food, and family time!</p>
        <a href="{{ url('/reservation') }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg shadow-md transition-all animate-fade-in-up delay-400">Book a Lane</a>
    </div>
</section>

<!-- Features -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center mb-12">What We Offer</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            <div class="text-center p-6 shadow-lg rounded-lg hover:shadow-2xl transition">
                <img src="https://cdn-icons-png.flaticon.com/512/814/814513.png" alt="Bowling Lanes" class="h-16 mx-auto mb-4">
                <h3 class="text-xl font-semibold mb-2">State-of-the-Art Lanes</h3>
                <p>Experience smooth and sleek bowling lanes with automatic scoring and lighting effects.</p>
            </div>
            <div class="text-center p-6 shadow-lg rounded-lg hover:shadow-2xl transition">
                <img src="https://cdn-icons-png.flaticon.com/512/2922/2922506.png" alt="Food & Drinks" class="h-16 mx-auto mb-4">
                <h3 class="text-xl font-semibold mb-2">Delicious Snacks</h3>
                <p>Enjoy a variety of food and drinks while you bowl, from pizza to cocktails.</p>
            </div>
            <div class="text-center p-6 shadow-lg rounded-lg hover:shadow-2xl transition">
                <img src="https://cdn-icons-png.flaticon.com/512/869/869636.png" alt="Parties" class="h-16 mx-auto mb-4">
                <h3 class="text-xl font-semibold mb-2">Birthday Parties</h3>
                <p>Make your birthday unforgettable with themed decorations and private lanes.</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="bg-gray-100 py-16">
    <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-3xl font-bold mb-8">What Our Guests Say</h2>
        <div class="space-y-6">
            <blockquote class="bg-white p-6 rounded-lg shadow">
                <p class="text-lg">"Absolutely loved it! The lanes are modern and the vibe is great. Will definitely come back!"</p>
                <footer class="mt-4 text-gray-500">— Emily R.</footer>
            </blockquote>
            <blockquote class="bg-white p-6 rounded-lg shadow">
                <p class="text-lg">"Great place for a night out with friends. The food was surprisingly good too!"</p>
                <footer class="mt-4 text-gray-500">— Jordan M.</footer>
            </blockquote>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="bg-indigo-600 text-white py-16 text-center">
    <h2 class="text-3xl font-bold mb-4">Ready to Bowl?</h2>
    <p class="mb-6 text-lg">Book your lane now and have the time of your life at Bowling Centrum!</p>
    <a href="{{ url('/reservation') }}" class="bg-white text-indigo-600 px-6 py-3 rounded-lg font-semibold shadow hover:bg-gray-100">Make a Reservation</a>
</section>

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

<!-- Custom Animation Styles -->
<style>
    .animate-fade-in-up {
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 1s forwards;
    }
    .delay-200 {
        animation-delay: 0.2s;
    }
    .delay-400 {
        animation-delay: 0.4s;
    }
    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

</body>
</html>

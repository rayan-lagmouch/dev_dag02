<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('content')
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

    <!-- Additional sections here -->

@endsection

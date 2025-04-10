<!-- resources/views/reservations/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold mb-6 text-center">Maak een Nieuwe Reservering</h1>

    @if(session('success'))
        <div class="alert alert-success bg-green-200 text-green-800 p-4 mb-4 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('reservations.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Person -->
        <div>
            <label for="person_id" class="block text-lg font-medium">Kies een Persoon</label>
            <select name="person_id" id="person_id" class="w-full p-2 border border-gray-300 rounded-md" required>
                @foreach($people as $person)
                    <option value="{{ $person->id }}">{{ $person->first_name }} {{ $person->last_name }}</option>
                @endforeach
            </select>
            @error('person_id')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Lane -->
        <div>
            <label for="lane_id" class="block text-lg font-medium">Kies een Bowlingbaan</label>
            <select name="lane_id" id="lane_id" class="w-full p-2 border border-gray-300 rounded-md" required>
                @foreach($lanes as $lane)
                    <option value="{{ $lane->id }}">Baan {{ $lane->lane_number }}</option>
                @endforeach
            </select>
            @error('lane_id')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Reservation Date -->
        <div>
            <label for="reservation_date" class="block text-lg font-medium">Reserveringsdatum</label>
            <input type="date" name="reservation_date" id="reservation_date" class="w-full p-2 border border-gray-300 rounded-md" required>
            @error('reservation_date')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Start Time -->
        <div class="flex space-x-4">
            <div class="w-1/2">
                <label for="start_time" class="block text-lg font-medium">Starttijd</label>
                <input type="time" name="start_time" id="start_time" class="w-full p-2 border border-gray-300 rounded-md" required>
                @error('start_time')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- End Time -->
            <div class="w-1/2">
                <label for="end_time" class="block text-lg font-medium">Eindtijd</label>
                <input type="time" name="end_time" id="end_time" class="w-full p-2 border border-gray-300 rounded-md" required>
                @error('end_time')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Number of Players -->
        <div>
            <label for="number_of_players" class="block text-lg font-medium">Aantal Spelers</label>
            <input type="number" name="number_of_players" id="number_of_players" class="w-full p-2 border border-gray-300 rounded-md" required min="1" value="{{ old('number_of_players', 1) }}">
            @error('number_of_players')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">
                Reserveer nu
            </button>
        </div>
    </form>
</div>
@endsection

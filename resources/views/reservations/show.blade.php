@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-4xl font-semibold text-center text-white mb-8">Reservation Details</h1>

    <div class="bg-gray-800 text-white p-6 rounded-lg shadow-lg">
        <div class="mb-4">
            <strong class="text-lg">Person:</strong>
            <p class="text-xl">{{ $reservation->person->first_name }} {{ $reservation->person->last_name }}</p>
        </div>
        <div class="mb-4">
            <strong class="text-lg">Lane:</strong>
            <p class="text-xl">Lane {{ $reservation->lane->lane_number }}</p>
        </div>
        <div class="mb-4">
            <strong class="text-lg">Reservation Date:</strong>
            <p class="text-xl">{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('l, F j, Y') }}</p>
        </div>
        <div class="mb-4">
            <strong class="text-lg">Start Time:</strong>
            <p class="text-xl">{{ \Carbon\Carbon::parse($reservation->start_time)->format('g:i A') }}</p>
        </div>
        <div class="mb-4">
            <strong class="text-lg">End Time:</strong>
            <p class="text-xl">{{ \Carbon\Carbon::parse($reservation->end_time)->format('g:i A') }}</p>
        </div>
        <div class="mb-4">
            <strong class="text-lg">Number of Players:</strong>
            <p class="text-xl">{{ $reservation->number_of_players }}</p>
        </div>

        <a href="{{ route('reservations.index') }}" class="inline-block mt-6 px-6 py-2 text-lg font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition duration-300">Back to Reservations</a>
    </div>
</div>
@endsection

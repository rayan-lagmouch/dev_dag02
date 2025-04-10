<!-- resources/views/reservations/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Reservation Details</h1>

        <div class="mb-3">
            <strong>Person:</strong> {{ $reservation->person->first_name }} {{ $reservation->person->last_name }}
        </div>
        <div class="mb-3">
            <strong>Lane:</strong> {{ $reservation->lane->lane_number }}
        </div>
        <div class="mb-3">
            <strong>Reservation Date:</strong> {{ $reservation->reservation_date }}
        </div>
        <div class="mb-3">
            <strong>Start Time:</strong> {{ $reservation->start_time }}
        </div>
        <div class="mb-3">
            <strong>End Time:</strong> {{ $reservation->end_time }}
        </div>
        <div class="mb-3">
            <strong>Number of Players:</strong> {{ $reservation->number_of_players }}
        </div>

        <a href="{{ route('reservations.index') }}" class="btn btn-secondary">Back to Reservations</a>
    </div>
@endsection

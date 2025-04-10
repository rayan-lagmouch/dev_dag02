<!-- resources/views/reservations/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create New Reservation</h1>

        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="person_id">Person</label>
                <select name="person_id" id="person_id" class="form-control" required>
                    @foreach($people as $person)
                        <option value="{{ $person->id }}">{{ $person->first_name }} {{ $person->last_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="lane_id">Lane</label>
                <select name="lane_id" id="lane_id" class="form-control" required>
                    @foreach($lanes as $lane)
                        <option value="{{ $lane->id }}">{{ $lane->lane_number }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="reservation_date">Reservation Date</label>
                <input type="date" name="reservation_date" id="reservation_date" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="start_time">Start Time</label>
                <input type="time" name="start_time" id="start_time" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="end_time">End Time</label>
                <input type="time" name="end_time" id="end_time" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="number_of_players">Number of Players</label>
                <input type="number" name="number_of_players" id="number_of_players" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection

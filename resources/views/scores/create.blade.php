<!-- resources/views/scores/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create New Score</h1>

        <form action="{{ route('scores.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="player_name">Player Name</label>
                <input type="text" name="player_name" id="player_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="score_value">Score</label>
                <input type="number" name="score_value" id="score_value" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="frame_details">Frame Details</label>
                <input type="text" name="frame_details" id="frame_details" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection

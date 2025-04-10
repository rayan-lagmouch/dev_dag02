<!-- resources/views/scores/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Score</h1>

        <form action="{{ route('scores.update', $score->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="player_name">Player Name</label>
                <input type="text" name="player_name" id="player_name" class="form-control" value="{{ $score->player_name }}" required>
            </div>

            <div class="form-group">
                <label for="score_value">Score</label>
                <input type="number" name="score_value" id="score_value" class="form-control" value="{{ $score->score_value }}" required>
            </div>

            <div class="form-group">
                <label for="frame_details">Frame Details</label>
                <input type="text" name="frame_details" id="frame_details" class="form-control" value="{{ $score->frame_details }}">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection

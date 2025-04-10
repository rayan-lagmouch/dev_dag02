<!-- resources/views/scores/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Score Details</h1>

        <div class="mb-3">
            <strong>Player Name:</strong> {{ $score->player_name }}
        </div>
        <div class="mb-3">
            <strong>Score:</strong> {{ $score->score_value }}
        </div>
        <div class="mb-3">
            <strong>Frame Details:</strong> {{ $score->frame_details }}
        </div>

        <a href="{{ route('scores.index') }}" class="btn btn-secondary">Back to All Scores</a>
    </div>
@endsection

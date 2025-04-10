@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h1 class="text-3xl font-semibold mb-6">Score Details</h1>

        <div class="bg-white shadow-lg rounded-lg p-6">
            <!-- Player Name -->
            <div class="mb-4">
                <strong class="text-gray-700">Player Name:</strong>
                <p class="text-lg text-gray-800">{{ $score->player_name }}</p>
            </div>

            <!-- Score -->
            <div class="mb-4">
                <strong class="text-gray-700">Score:</strong>
                <p class="text-lg text-gray-800">{{ $score->score_value }}</p>
            </div>

            <!-- Frame Details -->
            <div class="mb-4">
                <strong class="text-gray-700">Frame Details:</strong>
                <p class="text-lg text-gray-800">{{ $score->frame_details }}</p>
            </div>



            <div class="flex justify-start mt-6">
                <a href="{{ route('scores.index') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded transition duration-200">
                    Back to All Scores
                </a>
            </div>
        </div>
    </div>
@endsection

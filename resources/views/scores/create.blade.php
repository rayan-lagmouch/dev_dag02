@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Create New Score</h1>

        <form action="{{ route('scores.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Player Name -->
            <div class="space-y-2">
                <label for="player_name" class="block text-lg font-medium text-gray-700">Player Name</label>
                <input type="text" name="player_name" id="player_name" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                @error('player_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Score -->
            <div class="space-y-2">
                <label for="score_value" class="block text-lg font-medium text-gray-700">Score</label>
                <input type="number" name="score_value" id="score_value" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                @error('score_value')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Frame Details -->
            <div class="space-y-2">
                <label for="frame_details" class="block text-lg font-medium text-gray-700">Frame Details</label>
                <input type="text" name="frame_details" id="frame_details" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @error('frame_details')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-300">
                    Save Score
                </button>
            </div>
        </form>
    </div>
@endsection

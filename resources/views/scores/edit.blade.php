@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Edit Score</h1>

        @if ($errors->any())
            <div class="text-red-500 text-sm mt-1">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('scores.update', $score->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

<!-- Player Name -->
<div class="space-y-2">
    <label for="player_name" class="block text-lg font-medium text-gray-700">Player Name</label>
    <input type="text" name="player_name" id="player_name" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="{{ old('player_name', $score->player_name) }}" required>
    
    @error('player_name')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>


            <!-- Reservation ID -->
            <div>
                <label for="reservation_id" class="block text-sm font-medium text-gray-300">Reservation Number:</label>
                <select name="reservation_id" id="reservation_id" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-300" onchange="updateLaneInfo()">
                    <option value="">Select Reservation</option>
                    @foreach($reservations as $reservation)
                        <option value="{{ $reservation->id }}" data-lane="{{ $reservation->lane ? $reservation->lane->id : '' }}" {{ $score->reservation_id == $reservation->id ? 'selected' : '' }}>
                            F-{{ $reservation->id }} - Player: {{ $reservation->person->first_name }} {{ $reservation->person->last_name }}
                        </option>
                    @endforeach
                </select>
                @error('reservation_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Hidden input for lane_id -->
            <input type="hidden" name="lane_id" id="lane_id" value="{{ old('lane_id', $score->lane_id) }}">

            <!-- Lane Information Display -->
            <div id="lane-info" class="text-sm font-medium text-gray-300 mt-2"></div>

            <!-- Score -->
            <div class="space-y-2">
                <label for="score_value" class="block text-lg font-medium text-gray-300">Score</label>
                <input type="number" name="score_value" id="score_value" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 focus:border-blue-300" value="{{ old('score_value', $score->score_value) }}" required>
                @error('score_value')
                    <p class="text-red-300 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Frame Details -->
            <div class="space-y-2">
                <label for="frame_details" class="block text-lg font-medium text-gray-300">Frame Details</label>
                <input type="text" name="frame_details" id="frame_details" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 focus:border-blue-300" value="{{ old('frame_details', $score->frame_details) }}">
                @error('frame_details')
                    <p class="text-red-300 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-6 py-3 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-500 transition duration-500">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
@endsection

<script>
function updateLaneInfo() {
    const reservationSelect = document.getElementById('reservation_id');
    const laneIdField = document.getElementById('lane_id');
    const laneInfoDiv = document.getElementById('lane-info');
    const selectedOption = reservationSelect.options[reservationSelect.selectedIndex];
    
    // Get the lane ID (if any) from the selected option
    const laneId = selectedOption.getAttribute('data-lane');
    
    // Set the lane_id hidden input value
    laneIdField.value = laneId;
    
    // Display the lane info
    if (laneId) {
        laneInfoDiv.textContent = `Lane Number: ${selectedOption.text.split('-')[2].trim()}`;
    } else {
        laneInfoDiv.textContent = 'No lane assigned to this reservation.';
    }
}
</script>

@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Create New Score</h1>

        <form action="{{ route('scores.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Player Name (Text Input instead of Dropdown) -->
            <div class="space-y-2">
                <label for="player_name" class="block text-lg font-medium text-gray-300">Player Name</label>
                <input type="text" name="player_name" id="player_name" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 focus:border-blue-300" required>
                @error('player_name')
                    <p class="text-red-300 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Select Reservation (without lane info in dropdown) -->
            <div>
                <label for="reservation_id" class="block text-sm font-medium text-gray-300">Reservation Number:</label>
                <select name="reservation_id" id="reservation_id" required 
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-300" onchange="updateLaneInfo()">
                    <option value="">Select Reservation</option>
                    @foreach($reservations as $reservation)
                        <option value="{{ $reservation->id }}" data-lane="{{ $reservation->lane ? $reservation->lane->id : '' }}">
                            F-{{ $reservation->id }} - Player: {{ $reservation->person->first_name }} {{ $reservation->person->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Hidden input for lane_id -->
            <input type="hidden" name="lane_id" id="lane_id">

            <!-- Lane Information Display -->
            <div id="lane-info" class="text-sm font-medium text-gray-300 mt-2">
                <!-- The lane number or message will appear here -->
            </div>

            <!-- Score -->
            <div class="space-y-2">
                <label for="score_value" class="block text-lg font-medium text-gray-300">Score</label>
                <input type="number" name="score_value" id="score_value" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 focus:border-blue-300" required>
                @error('score_value')
                    <p class="text-red-300 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="button" onclick="generateRandomThrows()" class="px-6 py-3 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-300">
    🎲 Vul willekeurige score in
</button>


            @foreach(range(1, 10) as $frame)
                <div class="mb-4">
                    <label class="block text-gray-300">Frame {{ $frame }}:</label>
                    <input type="number" name="frame_{{ $frame }}_throw_1" class="form-input" placeholder="Throw 1">
                    <input type="number" name="frame_{{ $frame }}_throw_2" class="form-input" placeholder="Throw 2">
                </div>
            @endforeach

            {{-- Extra throw for 10th frame --}}
            <div class="mb-4">
                <label class="block text-gray-300">Frame 10 Extra Throw (if needed):</label>
                <input type="number" name="frame_10_throw_3" class="form-input" placeholder="Throw 3">
            </div>

            <!-- Frame Details -->
            <div class="space-y-2">
                <label for="frame_details" class="block text-lg font-medium text-gray-300">Frame Details</label>
                <input type="text" name="frame_details" id="frame_details" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 focus:border-blue-300">
                @error('frame_details')
                    <p class="text-red-300 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="px-6 py-3 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-500 transition duration-500">
                    Save Score
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

function generateRandomThrows() {
    for (let i = 1; i <= 10; i++) {
        const t1 = document.querySelector(`[name="frame_${i}_throw_1"]`);
        const t2 = document.querySelector(`[name="frame_${i}_throw_2"]`);
        const t3 = document.querySelector(`[name="frame_10_throw_3"]`);

        // For frame 10, allow bonus throws
        if (i === 10) {
            let first = Math.floor(Math.random() * 11); // 0-10
            let second = (first === 10) ? Math.floor(Math.random() * 11) : Math.floor(Math.random() * (11 - first));
            let third = ((first === 10 || (first + second === 10)) ? Math.floor(Math.random() * 11) : "");

            t1.value = first;
            t2.value = second;
            t3.value = third;
        } else {
            let first = Math.floor(Math.random() * 11); // 0-10
            let second = (first === 10) ? "" : Math.floor(Math.random() * (11 - first)); // Ensure <=10 per frame

            t1.value = first;
            t2.value = second;
        }
    }
}
</script>

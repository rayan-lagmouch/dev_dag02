@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-semibold mb-6 text-center">Edit Reservation</h1>

        @if(session('success'))
            <div class="alert alert-success bg-green-200 text-green-800 p-4 mb-4 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('reservations.update', $reservation->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Person -->
            <div>
                <label for="person_id" class="block text-lg font-medium">Person</label>
                <select name="person_id" id="person_id" class="w-full p-2 border border-gray-300 rounded-md" required>
                    @foreach($people as $person)
                        <option value="{{ $person->id }}" {{ $reservation->person_id == $person->id ? 'selected' : '' }}>
                            {{ $person->first_name }} {{ $person->last_name }}
                        </option>
                    @endforeach
                </select>
                @error('person_id')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Lane -->
            <div>
                <label for="lane_id" class="block text-lg font-medium">Lane</label>
                <select name="lane_id" id="lane_id" class="w-full p-2 border border-gray-300 rounded-md" required>
                    @foreach($lanes as $lane)
                        <option value="{{ $lane->id }}" {{ $reservation->lane_id == $lane->id ? 'selected' : '' }}>
                            Lane {{ $lane->lane_number }}
                        </option>
                    @endforeach
                </select>
                @error('lane_id')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Reservation Date -->
            <div>
                <label for="reservation_date" class="block text-lg font-medium">Reservation Date</label>
                <input type="date" name="reservation_date" id="reservation_date" value="{{ old('reservation_date', $reservation->reservation_date) }}" class="w-full p-2 border border-gray-300 rounded-md" required>
                @error('reservation_date')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Start Time -->
            <div class="flex space-x-4">
                <div class="w-1/2">
                    <label for="start_time" class="block text-lg font-medium">Start Time</label>
                    <input type="time" name="start_time" id="start_time" value="{{ old('start_time', $reservation->start_time) }}" class="w-full p-2 border border-gray-300 rounded-md" required>
                    @error('start_time')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- End Time -->
                <div class="w-1/2">
                    <label for="end_time" class="block text-lg font-medium">End Time</label>
                    <input type="time" name="end_time" id="end_time" value="{{ old('end_time', $reservation->end_time) }}" class="w-full p-2 border border-gray-300 rounded-md" required>
                    @error('end_time')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Number of Players -->
            <div>
                <label for="number_of_players" class="block text-lg font-medium">Number of Players</label>
                <input type="number" name="number_of_players" id="number_of_players" value="{{ old('number_of_players', $reservation->number_of_players) }}" class="w-full p-2 border border-gray-300 rounded-md" required min="1">
                @error('number_of_players')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>

                <label for="status" class="block text-lg font-medium">Status</label>
                <select name="status" id="status" class="w-full p-2 border border-gray-300 rounded-md" required>
                    <option value="Bevestigd" {{ old('status', $reservation->status) === 'Bevestigd' ? 'selected' : '' }}>Bevestigd</option>
                    <option value="Geannuleerd" {{ old('status', $reservation->status) === 'Geannuleerd' ? 'selected' : '' }}>Geannuleerd</option>
                    <option value="Afwachting Betaling" {{ old('status', $reservation->status) === 'Afwachten betaling' ? 'selected' : '' }}>Afwachting Betaling</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">
                    Update Reservation
                </button>
            </div>
        </form>
    </div>
@endsection

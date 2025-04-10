@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-8 px-6">
        <h1 class="text-3xl font-semibold mb-6 text-800">All Reservations</h1>

        <a href="{{ route('reservations.create') }}" class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 transition duration-200 mb-4 inline-block">
            Add New Reservation
        </a>

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-md mb-6">
                <strong>Success!</strong> {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full table-auto">
                <thead class="bg-indigo-600 text-white text-sm">
                    <tr>
                        <th class="px-6 py-4 text-left">Reservation Date</th>
                        <th class="px-6 py-4 text-left">Lane</th>
                        <th class="px-6 py-4 text-left">Start Time</th>
                        <th class="px-6 py-4 text-left">End Time</th>
                        <th class="px-6 py-4 text-left">Number of Players</th>
                        <th class="px-6 py-4 text-left">Status</th>
                        <th class="px-6 py-4 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach($reservations as $reservation)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $reservation->reservation_date }}</td>
                            <td class="px-6 py-4">{{ $reservation->lane->lane_number }}</td>
                            <td class="px-6 py-4">{{ $reservation->start_time }}</td>
                            <td class="px-6 py-4">{{ $reservation->end_time }}</td>
                            <td class="px-6 py-4">{{ $reservation->number_of_players }}</td>
                            <td class="px-6 py-4">{{ $reservation->status }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('reservations.show', $reservation->id) }}" class="text-blue-600 hover:text-blue-800 transition duration-200 mr-2">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <a href="{{ route('reservations.edit', $reservation->id) }}" class="text-yellow-600 hover:text-yellow-800 transition duration-200 mr-2">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to cancel this reservation?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 transition duration-200">
                                        <i class="fas fa-trash"></i> Cancel
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

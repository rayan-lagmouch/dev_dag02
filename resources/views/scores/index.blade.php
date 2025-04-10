@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h1 class="text-2xl font-bold mb-6">All Scores</h1>

        <a href="{{ route('scores.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded mb-4 transition">
            Add New Score
        </a>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 border border-green-300 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-100 text-xs uppercase text-gray-600">
                    <tr>
                        <th class="px-6 py-3">Player Name</th>
                        <th class="px-6 py-3">Total Score</th>
                        <th class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($scores as $score)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $score->player_name }}</td>
                            <td class="px-6 py-4">{{ $score->score_value }}</td>
                            <td class="px-6 py-4 space-x-2">
                                <!-- Show Button -->
                                <a href="{{ route('scores.show', $score->id) }}" class="inline-block bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded transition duration-200">
                                    Show
                                </a>

                                <!-- Edit Button -->
                                <a href="{{ route('scores.edit', $score->id) }}" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-4 py-2 rounded transition duration-200">
                                    Edit
                                </a>

                                <!-- Delete Button -->
                                <button type="button" onclick="openModal({{ $score->id }})" class="inline-block bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded transition duration-200">
                                    Delete
                                </button>

                                <!-- Modal for confirmation -->
                                <div id="modal-{{ $score->id }}" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
                                    <div class="bg-white p-8 rounded-lg shadow-lg">
                                        <h3 class="text-xl font-semibold text-gray-800">Are you sure you want to delete this score?</h3>
                                        <div class="mt-4 flex justify-end space-x-4">
                                            <!-- Cancel Button -->
                                            <button onclick="closeModal({{ $score->id }})" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 rounded">
                                                Cancel
                                            </button>
                                            <!-- Confirm Button -->
                                            <form action="{{ route('scores.destroy', $score->id) }}" method="POST" id="delete-form-{{ $score->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded">
                                                    Yes, Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    @if($scores->isEmpty())
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                                No scores available.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function openModal(scoreId) {
            const modal = document.getElementById('modal-' + scoreId);
            modal.classList.remove('hidden');
        }

        function closeModal(scoreId) {
            const modal = document.getElementById('modal-' + scoreId);
            modal.classList.add('hidden');
        }
    </script>
@endsection

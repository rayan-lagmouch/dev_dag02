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
                        <th class="px-6 py-3">Score</th>
                        <th class="px-6 py-3">Frame Details</th>
                        <th class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($scores as $score)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $score->player_name }}</td>
                            <td class="px-6 py-4">{{ $score->score_value }}</td>
                            <td class="px-6 py-4">{{ $score->frame_details }}</td>
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
                                <form action="{{ route('scores.destroy', $score->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')" class="inline-block bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded transition duration-200">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if($scores->isEmpty())
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                No scores available.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection

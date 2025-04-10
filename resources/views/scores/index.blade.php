<!-- resources/views/scores/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>All Scores</h1>

        <a href="{{ route('scores.create') }}" class="btn btn-primary mb-3">Add New Score</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
            <tr>
                <th>Player Name</th>
                <th>Score</th>
                <th>Frame Details</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($scores as $score)
                <tr>
                    <td>{{ $score->player_name }}</td>
                    <td>{{ $score->score_value }}</td>
                    <td>{{ $score->frame_details }}</td>
                    <td>
                        <a href="{{ route('scores.show', $score->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('scores.edit', $score->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('scores.destroy', $score->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

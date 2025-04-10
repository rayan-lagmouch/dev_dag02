<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    // Display a listing of the scores
    public function index()
    {
        $scores = Score::all();
        return view('scores.index', compact('scores'));
    }

// Show the specified score
public function show(Score $score)
{
    return view('scores.show', compact('score'));
}


    // Show the form for creating a new score
    public function create()
    {
        return view('scores.create');
    }

    // Store a newly created score in storage
    public function store(Request $request)
    {
        $request->validate([
            'player_name' => 'required|string|max:100',
            'score_value' => 'required|integer',
            'frame_details' => 'nullable|string|max:100',
        ]);

        Score::create($request->all());

        return redirect()->route('scores.index')->with('success', 'Score created successfully.');
    }

    // Show the form for editing the specified score
    public function edit(Score $score)
    {
        return view('scores.edit', compact('score'));
    }

    // Update the specified score in storage
    public function update(Request $request, Score $score)
    {
        $request->validate([
            'player_name' => 'required|string|max:100',
            'score_value' => 'required|integer',
            'frame_details' => 'nullable|string|max:100',
        ]);

        $score->update($request->all());

        return redirect()->route('scores.index')->with('success', 'Score updated successfully.');
    }

    // Remove the specified score from storage
    public function destroy(Score $score)
    {
        $score->delete();

        return redirect()->route('scores.index')->with('success', 'Score deleted successfully.');
    }
}

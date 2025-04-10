<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\Reservation; // Import Reservation model
use App\Models\Lane;         // Import Lane model
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
        $reservations = Reservation::all();  // Fetch all reservations
        
        // Pass only the reservations to the view
        return view('scores.create', compact('reservations'));
    }
    

    // Store a newly created score in storage
    public function store(Request $request)
    {
        $request->validate([
            'player_name' => 'required|string|max:100',
            'reservation_id' => 'required|exists:reservations,id',
            'score_value' => 'required|integer',
            'frame_details' => 'nullable|string|max:100',
        ]);
    
        // Get the reservation to fetch lane_id
        $reservation = Reservation::find($request->reservation_id);
    
        // Create the score record
        Score::create([
            'player_name' => $request->player_name,
            'reservation_id' => $request->reservation_id,
            'lane_id' => $reservation->lane_id,  // Use lane_id from the reservation
            'score_value' => $request->score_value,
            'frame_details' => $request->frame_details,
        ]);
    
        return redirect()->route('scores.index')->with('success', 'Score created successfully.');
    }
    

    // Show the form for editing the specified score
    public function edit(Score $score)
    {
        $reservations = Reservation::all();


        return view('scores.edit', compact('score', 'reservations'));
    }

    // Update the specified score in storage
    public function update(Request $request, Score $score)
    {
        $request->validate([
            'player_name' => 'required|string|max:100',
            'reservation_id' => 'required|exists:reservations,id',
            'score_value' => 'required|integer',
            'frame_details' => 'nullable|string|max:100',
        ]);
    
        // Find the reservation that corresponds to the selected reservation_id
        $reservation = Reservation::find($request->reservation_id);
    
        // Update the score record
        $score->update([
            'player_name' => $request->player_name,
            'reservation_id' => $request->reservation_id,
            'lane_id' => $reservation->lane_id, // Get lane_id from the reservation
            'score_value' => $request->score_value,
            'frame_details' => $request->frame_details,
        ]);
    
        return redirect()->route('scores.index')->with('success', 'Score updated successfully.');
    }
    

    // Remove the specified score from storage
    public function destroy(Score $score)
    {
        $score->delete();

        return redirect()->route('scores.index')->with('success', 'Score deleted successfully.');
    }
}

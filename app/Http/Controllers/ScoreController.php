<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ScoreController extends Controller
{
    // Display a listing of the scores
    public function index()
    {
        try {
            $scores = Score::with('reservation', 'reservation.lane')->get();
            return view('scores.index', compact('scores'));
        } catch (\Exception $e) {
            Log::error('Failed to fetch scores: ' . $e->getMessage());
            return redirect()->route('scores.index')->with('error', 'Er is iets mis gegaan bij het ophalen van scores.');
        }
    }

    // Show the specified score
    public function show(Score $score)
    {
        try {
            return view('scores.show', compact('score'));
        } catch (\Exception $e) {
            Log::error('Failed to fetch score details: ' . $e->getMessage());
            return redirect()->route('scores.index')->with('error', 'Er is iets mis gegaan bij het ophalen van de score.');
        }
    }

    // Show the form for creating a new score
    public function create()
    {
        try {
            // Fetch all reservations with their associated lane details
            $reservations = Reservation::with('lane')->get();
            
            return view('scores.create', compact('reservations'));
        } catch (\Exception $e) {
            Log::error('Failed to fetch reservations: ' . $e->getMessage());
            return redirect()->route('scores.index')->with('error', 'Er is iets mis gegaan bij het ophalen van de reserveringen.');
        }
    }
    

    // Store a newly created score in storage
    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'player_name' => 'required|string|regex:/^[a-zA-Z\s]*$/', // Only letters and spaces allowed
            'round_number' => 'nullable|integer',
            'game_date' => 'nullable|date',
            'reservation_id' => 'nullable|exists:reservations,id',
            'lane_id' => 'nullable|exists:lanes,id',
            'frame_1_throw_1' => 'required|integer|min:0|max:10',
            'frame_1_throw_2' => 'nullable|integer|min:0|max:10',
            'frame_2_throw_1' => 'required|integer|min:0|max:10',
            'frame_2_throw_2' => 'nullable|integer|min:0|max:10',
            'frame_3_throw_1' => 'required|integer|min:0|max:10',
            'frame_3_throw_2' => 'nullable|integer|min:0|max:10',
            'frame_4_throw_1' => 'required|integer|min:0|max:10',
            'frame_4_throw_2' => 'nullable|integer|min:0|max:10',
            'frame_5_throw_1' => 'required|integer|min:0|max:10',
            'frame_5_throw_2' => 'nullable|integer|min:0|max:10',
            'frame_6_throw_1' => 'required|integer|min:0|max:10',
            'frame_6_throw_2' => 'nullable|integer|min:0|max:10',
            'frame_7_throw_1' => 'required|integer|min:0|max:10',
            'frame_7_throw_2' => 'nullable|integer|min:0|max:10',
            'frame_8_throw_1' => 'required|integer|min:0|max:10',
            'frame_8_throw_2' => 'nullable|integer|min:0|max:10',
            'frame_9_throw_1' => 'required|integer|min:0|max:10',
            'frame_9_throw_2' => 'nullable|integer|min:0|max:10',
            'frame_10_throw_1' => 'required|integer|min:0|max:10',
            'frame_10_throw_2' => 'nullable|integer|min:0|max:10',
            'frame_10_throw_3' => 'nullable|integer|min:0|max:10',
        ], [
            'player_name.regex' => 'Only text (letters and spaces) are allowed for Player Name.', // Custom error message
        ]);
    
        // Process score calculation
        $throws = [];
        for ($i = 1; $i <= 10; $i++) {
            $throws[] = $validated["frame_{$i}_throw_1"];
            if (isset($validated["frame_{$i}_throw_2"])) {
                $throws[] = $validated["frame_{$i}_throw_2"];
            }
            if ($i === 10 && isset($validated["frame_10_throw_3"])) {
                $throws[] = $validated["frame_10_throw_3"];
            }
        }
    
        // Calculate total score
        $total_score = 0;
        $index = 0;
        for ($frame = 1; $frame <= 10; $frame++) {
            $first = $throws[$index] ?? 0;
            $second = $throws[$index + 1] ?? 0;
            $third = $throws[$index + 2] ?? 0;
    
            if ($first === 10) {
                $total_score += 10 + $second + $third;
                $index += 1;
            } elseif ($first + $second === 10) {
                $total_score += 10 + $third;
                $index += 2;
            } else {
                $total_score += $first + $second;
                $index += 2;
            }
        }
    
        $validated['score_value'] = $total_score;
    
        // Save the score to the database
        Score::create($validated);
    
        // Redirect with success message
        return redirect()->route('scores.index')->with('success', 'Score succesvol aangemaakt.');
    }
    

    // Show the form for editing the specified score
    public function edit(Score $score)
    {
        try {
            $reservations = Reservation::all();
            return view('scores.edit', compact('score', 'reservations'));
        } catch (\Exception $e) {
            Log::error('Failed to fetch reservations for editing: ' . $e->getMessage());
            return redirect()->route('scores.index')->with('error', 'Er is iets mis gegaan bij het ophalen van de reserveringen.');
        }
    }

    // Update the specified score in storage
    public function update(Request $request, Score $score)
    {
        // Validate the incoming request
        $request->validate([
            'player_name' => 'required|string|max:100',
            'reservation_id' => 'required|exists:reservations,id',
            'score_value' => 'required|integer',
            'frame_details' => 'nullable|string|max:100',
        ]);
    
        // Find the reservation to associate with the score
        $reservation = Reservation::findOrFail($request->reservation_id);
    
        // Update the score record
        $score->update([
            'player_name' => $request->player_name,
            'reservation_id' => $request->reservation_id,
            'lane_id' => $reservation->lane_id,
            'score_value' => $request->score_value,
            'frame_details' => $request->frame_details,
        ]);
    
        // Redirect back to the scores index with a success message
        return redirect()->route('scores.index')->with('success', 'Score succesvol bijgewerkt.');
    }
    
    

    // Remove the specified score from storage
    public function destroy(Score $score)
    {
        try {
            $score->delete();
            return redirect()->route('scores.index')->with('success', 'Score succesvol verwijderd.');
        } catch (\Exception $e) {
            Log::error('Failed to delete score: ' . $e->getMessage());
            return redirect()->route('scores.index')->with('error', 'Er is iets mis gegaan bij het verwijderen van de score.');
        }
    }
}

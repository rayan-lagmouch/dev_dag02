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
            // Fetch all scores, optionally you can use joins if necessary.
            $scores = Score::with('reservation', 'reservation.lane')->get();
            return view('scores.index', compact('scores'));
        } catch (\Exception $e) {
            // Log the error and show a user-friendly message
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
            // Fetch all reservations
            $reservations = Reservation::all();
            return view('scores.create', compact('reservations'));
        } catch (\Exception $e) {
            Log::error('Failed to fetch reservations: ' . $e->getMessage());
            return redirect()->route('scores.index')->with('error', 'Er is iets mis gegaan bij het ophalen van de reserveringen.');
        }
    }

    // Store a newly created score in storage
// Store a newly created score in storage
public function store(Request $request)
{
    // Validating the form input
    $request->validate([
        'player_name' => 'required|string|max:100',
        'score_value' => 'required|integer',
        'frame_details' => 'nullable|string|max:100',
        'throws' => 'required|array', // This will be an array of throws (one for each roll)
    ]);

    try {
        // Get the throws
        $throws = $request->throws; // An array of numbers, each representing a throw

        // Start building the score logic
        $total_score = 0;
        $frame_score = 0;
        $frame_number = 1;

        foreach ($throws as $index => $score) {
            if ($frame_number <= 10) {  // Ensure only 10 frames are scored
                // Check if the throw is a strike (first throw of the frame)
                if ($score == 10) {
                    $frame_score = 10;
                    $total_score += $frame_score;
                    $frame_number++; // Move to the next frame
                }
                // Check if the throw is a spare (2nd throw of the frame)
                else if (isset($throws[$index + 1]) && $score + $throws[$index + 1] == 10) {
                    $frame_score = 10;
                    $total_score += $frame_score;
                    $frame_number++; // Move to the next frame
                }
                // Normal frame (open frame)
                else {
                    $frame_score = $score + $throws[$index + 1];
                    $total_score += $frame_score;
                    $frame_number++; // Move to the next frame
                }
            }
        }

        // Create the score record
        Score::create([
            'player_name' => $request->player_name,
            'score_value' => $total_score,
            'round_number' => $frame_number,
            'game_date' => now(),
            'first_throw' => $throws[0] ?? 0,
            'second_throw' => $throws[1] ?? 0,
            'total_frame_score' => $total_score,
        ]);

        return redirect()->route('scores.index')->with('success', 'Score succesvol aangemaakt.');

    } catch (\Exception $e) {
        Log::error('Failed to store score: ' . $e->getMessage());
        return redirect()->route('scores.index')->with('error', 'Er is iets mis gegaan bij het opslaan van de score.');
    }
}


    // Show the form for editing the specified score
    public function edit(Score $score)
    {
        try {
            // Haal alle reserveringen op voor de selectie
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
        // Validatie van de nieuwe gegevens
        $request->validate([
            'player_name' => 'required|string|max:100',
            'reservation_id' => 'required|exists:reservations,id',
            'score_value' => 'required|integer',
            'frame_details' => 'nullable|string|max:100',
        ]);

        try {
            // Zoek de reservering die overeenkomt met het geselecteerde reservation_id
            $reservation = Reservation::findOrFail($request->reservation_id);
            
            // Update de score
            $score->update([
                'player_name' => $request->player_name,
                'reservation_id' => $request->reservation_id,
                'lane_id' => $reservation->lane_id,  // Verkrijg lane_id van de reservering
                'score_value' => $request->score_value,
                'frame_details' => $request->frame_details,
            ]);

            // Feedback voor de gebruiker
            return redirect()->route('scores.index')->with('success', 'Score succesvol bijgewerkt.');
        } catch (\Exception $e) {
            Log::error('Failed to update score: ' . $e->getMessage());
            return redirect()->route('scores.index')->with('error', 'Er is iets mis gegaan bij het bijwerken van de score.');
        }
    }

    // Remove the specified score from storage
    public function destroy(Score $score)
    {
        try {
            $score->delete();
            // Feedback voor de gebruiker
            return redirect()->route('scores.index')->with('success', 'Score succesvol verwijderd.');
        } catch (\Exception $e) {
            Log::error('Failed to delete score: ' . $e->getMessage());
            return redirect()->route('scores.index')->with('error', 'Er is iets mis gegaan bij het verwijderen van de score.');
        }
    }
}

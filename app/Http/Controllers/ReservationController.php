<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Person;
use App\Models\Lane;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // Display a listing of the reservations
    public function index()
    {
        $reservations = Reservation::with('person', 'lane')->get();
        return view('reservations.index', compact('reservations'));
    }

    // Show the form for creating a new reservation
    public function create()
    {
        $people = Person::all(); // Retrieve all people for selection
        $lanes = Lane::where('is_available', true)->get(); // Only available lanes
        return view('reservations.create', compact('people', 'lanes'));
    }

    // Store a newly created reservation in storage
    public function store(Request $request)
    {
        $request->validate([
            'person_id' => 'required|exists:people,id',
            'lane_id' => 'required|exists:lanes,id',
            'reservation_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'number_of_players' => 'nullable|integer|min:1',
        ]);

        Reservation::create($request->all());

        return redirect()->route('reservations.index')->with('success', 'Reservation created successfully.');
    }

    // Show the form for editing the specified reservation
    public function edit(Reservation $reservation)
    {
        $people = Person::all();
        $lanes = Lane::where('is_available', true)->get();
        return view('reservations.edit', compact('reservation', 'people', 'lanes'));
    }

    // Update the specified reservation in storage
    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            'person_id' => 'required|exists:people,id',
            'lane_id' => 'required|exists:lanes,id',
            'reservation_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'number_of_players' => 'nullable|integer|min:1',
        ]);

        $reservation->update($request->all());

        return redirect()->route('reservations.index')->with('success', 'Reservation updated successfully.');
    }

    // Remove the specified reservation from storage
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', 'Reservation deleted successfully.');
    }
}

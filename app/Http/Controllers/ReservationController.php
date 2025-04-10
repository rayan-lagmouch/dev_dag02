<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Person;
use App\Models\Lane;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Exception;

class ReservationController extends Controller
{
    // Display a listing of the reservations
    public function index()
    {
        $reservations = Reservation::with('person', 'lane')->get();
        return view('reservations.index', compact('reservations'));
    }

    public function show(string $id) 
    {
        try {
            $reservation = Reservation::with('person', 'lane')->findOrFail($id);
            return view('reservations.show', compact('reservation'));
        } catch (Exception $e) {
            // todo log message and show user friendly error
            return redirect('/404');
        }
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
            'reservation_date' => [
                'required',
                'date',
                'after_or_equal:' . Carbon::today()->toDateString(),
                Rule::unique('reservations')->where(function ($query) use ($request) {
                    return $query->where('lane_id', $request->lane_id)
                                 ->where('reservation_date', $request->reservation_date)
                                 ->where(function ($query) use ($request) {
                                     return $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                                                  ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                                                  ->orWhereRaw('? BETWEEN start_time AND end_time', [$request->start_time])
                                                  ->orWhereRaw('? BETWEEN start_time AND end_time', [$request->end_time]);
                                 });
                }),
            ],
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
            'reservation_date' => [
                'required',
                'date',
                'after_or_equal:' . Carbon::today()->toDateString(),
                Rule::unique('reservations')->where(function ($query) use ($request) {
                    return $query->where('lane_id', $request->lane_id)
                                 ->where('reservation_date', $request->reservation_date)
                                 ->where(function ($query) use ($request) {
                                     return $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                                                  ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                                                  ->orWhereRaw('? BETWEEN start_time AND end_time', [$request->start_time])
                                                  ->orWhereRaw('? BETWEEN start_time AND end_time', [$request->end_time]);
                                 });
                })->ignore($request->route('reservation')->id), // Exclude current reservation
            ],
            'start_time' => [
                'required',
                'date_format:H:i',
                Rule::unique('reservations')->where(function ($query) use ($request) {
                    return $query->where('lane_id', $request->lane_id)
                                 ->where('reservation_date', $request->reservation_date)
                                 ->where(function ($query) use ($request) {
                                     return $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                                                  ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                                                  ->orWhereRaw('? BETWEEN start_time AND end_time', [$request->start_time])
                                                  ->orWhereRaw('? BETWEEN start_time AND end_time', [$request->end_time]);
                                 });
                })->ignore($request->route('reservation')->id), // Exclude current reservation
            ],
            'end_time' => 'required|date_format:H:i',
            'number_of_players' => 'nullable|integer|min:1',
            'status' => 'required|in:Bevestigd,Geannuleerd,Afwachting Betaling',
        ]);
        

        $reservation->update($request->all());

        return redirect()->route('reservations.index')->with('success', 'Reservation updated successfully.');
    }

    // Remove the specified reservation from storage
    public function destroy(Reservation $reservation)
    {
        $reservation->update([
            'status' => 'Geannuleerd'
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reservation cancelled successfully.');
    }
}

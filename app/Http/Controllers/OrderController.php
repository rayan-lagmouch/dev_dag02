<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Reservation;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Display a listing of the orders
    public function index()
    {
        $orders = Order::with('reservation')->get();
        return view('orders.index', compact('orders'));
    }

    // Show the form for creating a new order
    public function create()
    {
        $reservations = Reservation::all(); // Retrieve all reservations for selection
        return view('orders.create', compact('reservations'));
    }

    // Store a newly created order in storage
    public function store(Request $request)
    {
        $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'total_amount' => 'required|numeric',
            'payment_method' => 'nullable|string|max:50',
            'is_paid' => 'required|boolean',
        ]);

        Order::create($request->all());

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    // Show the form for editing the specified order
    public function edit(Order $order)
    {
        $reservations = Reservation::all();
        return view('orders.edit', compact('order', 'reservations'));
    }

    // Update the specified order in storage
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'total_amount' => 'required|numeric',
            'payment_method' => 'nullable|string|max:50',
            'is_paid' => 'required|boolean',
        ]);

        $order->update($request->all());

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    // Remove the specified order from storage
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}

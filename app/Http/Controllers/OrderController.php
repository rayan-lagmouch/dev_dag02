<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Person;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('person')->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $people = Person::all();
        return view('orders.create', compact('people'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'person_id' => 'required|exists:people,id',
            'total_amount' => 'required|numeric',
            'payment_method' => 'nullable|string|max:50',
            'status' => 'required|in:active,cancelled',
        ]);

        Order::create($request->all());

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    public function edit(Order $order)
    {
        $people = Person::all();
        return view('orders.edit', compact('order', 'people'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'person_id' => 'required|exists:people,id',
            'total_amount' => 'required|numeric',
            'payment_method' => 'nullable|string|max:50',
            'status' => 'required|in:active,cancelled',
        ]);

        $order->update($request->all());

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}

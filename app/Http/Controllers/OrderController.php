<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrderController extends Controller
{
// Display all orders
public function index()
{
$orders = Order::all(); // Retrieve all orders from the database
return view('orders.index', compact('orders')); // Return the 'orders.index' view with the orders data
}

// Display the form to create a new order
public function create()
{
return view('orders.create'); // Display the form to create a new order
}

// Store the new order in the database
public function store(Request $request)
{
// Validate the incoming request data
$validatedData = $request->validate([
'person_id' => 'required|exists:people,id',
'order_time' => 'required|date',
'total_amount' => 'required|numeric',
'payment_method' => 'required|in:online,cash',
'status' => 'required|in:paid,not_paid,cancelled',
'packages' => 'required|array|min:1',
'packages.*' => 'string|distinct',
]);

// Create a new order and store it in the database
$order = new Order();
$order->person_id = $validatedData['person_id'];
$order->order_time = $validatedData['order_time'];
$order->total_amount = $validatedData['total_amount'];
$order->payment_method = $validatedData['payment_method'];
$order->status = $validatedData['status'];
$order->packages = implode(',', $validatedData['packages']); // Store selected packages as a comma-separated string
$order->save();

return redirect()->route('orders.index')->with('success', 'Order created successfully!');
}

// Cancel an order (update status to cancelled)
public function cancel($id)
{
$order = Order::findOrFail($id); // Find the order by its ID
$order->status = 'cancelled'; // Update status to cancelled
$order->save(); // Save the updated order

return redirect()->route('orders.index')->with('success', 'Order cancelled successfully!');
}

// Display the form to edit an existing order
// Display the form to edit an existing order
    public function edit($id)
    {
        $order = Order::findOrFail($id); // Find the order by ID
        return view('orders.edit', compact('order')); // Pass the order to the view
    }

// Update an existing order in the database
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id); // Find the order by its ID

        // Validate the incoming request data
        $validatedData = $request->validate([
            'person_id' => 'required|exists:people,id',
            'order_time' => 'required|date',
            'total_amount' => 'required|numeric',
            'payment_method' => 'required|in:online,cash',
            'status' => 'required|in:paid,not_paid,cancelled',
            'packages' => 'required|array|min:1', // Ensure at least one package is selected
            'packages.*' => 'string|distinct', // Ensure packages are valid and distinct
        ]);

        // Update the order data
        $order->person_id = $validatedData['person_id'];
        $order->order_time = $validatedData['order_time'];
        $order->total_amount = $validatedData['total_amount'];
        $order->payment_method = $validatedData['payment_method'];
        $order->status = $validatedData['status'];
        $order->packages = implode(',', $validatedData['packages']); // Store selected packages as a comma-separated string
        $order->save(); // Save the updated order

        // Redirect back with a success message
        return redirect()->route('orders.index')->with('success', 'Order updated successfully!');
    }


// Update an existing order in the database
public function update(Request $request, $id)
{
$order = Order::findOrFail($id); // Find the order by its ID

// Validate the incoming request data
$validatedData = $request->validate([
'order_time' => 'required|date',
'total_amount' => 'required|numeric',
'payment_method' => 'required|string',
'status' => 'required|string',
'packages' => 'array|nullable', // Validate that packages are an array
]);

// Update the order data
$order->order_time = $validatedData['order_time'];
$order->total_amount = $validatedData['total_amount'];
$order->payment_method = $validatedData['payment_method'];
$order->status = $validatedData['status'];

// Handle the packages
$order->packages = implode(',', $request->input('packages', [])); // Save selected packages as comma-separated string

// Save the updated order
$order->save();

// Redirect back with a success message
return redirect()->route('orders.index')->with('success', 'Order updated successfully!');
}

// Delete an order from the database
public function destroy($id)
{
$order = Order::findOrFail($id); // Find the order by its ID
$order->delete(); // Delete the order

// Redirect back with a success message
return redirect()->route('orders.index')->with('success', 'Order deleted successfully!');
}
}

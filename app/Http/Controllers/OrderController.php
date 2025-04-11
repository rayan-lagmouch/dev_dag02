<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Person;  // Import Person model
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function showGuestOrderForm()
    {
        // Predefined packages with their prices (hardcoded as in your context)
        $packages = [
            ['id' => 1, 'name' => 'Basic Snack Package', 'price' => 15],
            ['id' => 2, 'name' => 'Luxury Snack Package', 'price' => 30],
            ['id' => 3, 'name' => "Children's Party", 'price' => 28.50],
            ['id' => 4, 'name' => 'Bachelor Party', 'price' => 200],
        ];

        // Check if the user is logged in
        $isLoggedIn = Auth::check();

        // Initialize orders collection
        $orders = collect();

        if ($isLoggedIn) {
            // If logged in, fetch the orders for the authenticated user
            $person = Auth::user()->person;
            if ($person) {
                // Retrieve only the orders for this person (authenticated user)
                $orders = Order::where('person_id', $person->id)->get();
            }
        } else {
            // If not logged in, fetch orders based on the guest's email
            // Retrieve guest details (either from the form or session)
            if (session()->has('guest_email')) {
                $guestEmail = session('guest_email');
                $person = Person::where('email', $guestEmail)->first();
                if ($person) {
                    // Retrieve orders associated with this guest person
                    $orders = Order::where('person_id', $person->id)->get();
                }
            }
        }

        // Return the guest order form and pass the available packages, orders, and logged-in status to the view
        return view('orders.guest', compact('packages', 'orders', 'isLoggedIn'));
    }

    public function processGuestOrder(Request $request)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'payment_method' => 'required|in:credit_card,paypal,bank_transfer',
            'packages' => 'required|array|min:1',
            'first_name' => 'required_if:isLoggedIn,false|string|max:255',
            'last_name' => 'required_if:isLoggedIn,false|string|max:255',
            'email' => 'required_if:isLoggedIn,false|email|max:255',
            'phone_number' => 'required_if:isLoggedIn,false|string|max:255',
        ]);

        // Check if the user is logged in
        if (Auth::check()) {
            // Handle authenticated user as before
            $person = Auth::user()->person;
            $personId = $person->id;
        } else {
            // If the guest is not logged in, check if the person already exists using their email
            $person = Person::where('email', $validatedData['email'])->first();

            if (!$person) {
                // If the person doesn't exist, create a new one
                $person = Person::create([
                    'user_id' => null,  // Since it's a guest, no user_id is associated
                    'first_name' => $validatedData['first_name'],
                    'last_name' => $validatedData['last_name'],
                    'email' => $validatedData['email'],
                    'phone_number' => $validatedData['phone_number'],
                    'role' => 'customer',  // Assuming guests are assigned the 'customer' role
                ]);
            }

            // Store the guest email in session for future access
            session(['guest_email' => $validatedData['email']]);

            // Now $person will have the existing guest person or the newly created one
            $personId = $person->id;
        }

        $totalAmount = 0;
        foreach ($request->packages as $packageId) {
            // Calculate total amount
            $package = collect([
                ['id' => 1, 'price' => 15],
                ['id' => 2, 'price' => 30],
                ['id' => 3, 'price' => 28.50],
                ['id' => 4, 'price' => 200],
            ])->firstWhere('id', $packageId);

            $totalAmount += $package['price'];
        }

        // Store the order
        Order::create([
            'person_id' => $personId,  // Link the order to the correct person
            'order_time' => Carbon::now(),
            'total_amount' => $totalAmount,
            'payment_method' => $validatedData['payment_method'],
            'status' => 'not_paid',
            'packages' => implode(',', $request->packages),  // Store the selected packages as a comma-separated string
        ]);

        return redirect()->route('order.confirmation')->with('success', 'Order placed successfully!');
    }

    // Display the confirmation view after placing the order
    public function confirmation()
    {
        return view('orders.confirmation');
    }

    // Other methods (index, store, etc.) for managing orders...


// Display all orders
    public function index()
    {
        // Retrieve all orders
        $orders = Order::all();

        // Predefined packages (this should be in a more appropriate location like a constant or a config file)
        $packages = [
            ['id' => 1, 'name' => 'Basic Snack Package', 'price' => 15],
            ['id' => 2, 'name' => 'Luxury Snack Package', 'price' => 30],
            ['id' => 3, 'name' => "Children's Party", 'price' => 28.50],
            ['id' => 4, 'name' => 'Bachelor Party', 'price' => 200],
        ];

        // Map each order's package IDs to their actual names
        foreach ($orders as $order) {
            $order->package_names = [];

            // If packages are stored as a comma-separated string in the database
            if (is_string($order->packages)) {
                $packageIds = explode(',', $order->packages);

                foreach ($packageIds as $packageId) {
                    // Find the corresponding package name based on the ID
                    $package = collect($packages)->firstWhere('id', (int)$packageId);
                    if ($package) {
                        $order->package_names[] = $package['name'];
                    }
                }
            }
        }

        // Return the view with orders and their associated package names
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        return view('orders.create'); // Display the form to create a new order
    }
// Cancel an order (update status to cancelled)
    public function cancelGuestOrder($id)
    {
        $order = Order::findOrFail($id); // Find the order by its ID
        $order->status = 'cancelled'; // Update status to cancelled
        $order->save(); // Save the updated order

        // Instead of redirecting, just return a success message
        return back()->with('success', 'Order cancelled successfully!');
    }





    public function cancel($id)
{
$order = Order::findOrFail($id); // Find the order by its ID
$order->status = 'cancelled'; // Update status to cancelled
$order->save(); // Save the updated order

return redirect()->route('orders.index')->with('success', 'Order cancelled successfully!');
}

// Display the form to edit an existing order
public function edit($id)
{
$order = Order::findOrFail($id); // Find the order by ID
return view('orders.edit', compact('order')); // Pass the order to the view
}
    public function store(Request $request)
    {
        // Validate incoming request
        $validatedData = $request->validate([
            'person_id' => 'required|exists:people,id',
            'order_time' => 'required|date',
            'total_amount' => 'required|numeric',
            'payment_method' => 'required|in:online,cash',
            'status' => 'required|in:paid,not_paid,cancelled',
            'packages' => 'required|array|min:1',
            'packages.*' => 'string|distinct',
        ]);

        // Create the order
        Order::create([
            'person_id' => $validatedData['person_id'],
            'order_time' => Carbon::now(),
            'total_amount' => $validatedData['total_amount'],
            'payment_method' => $validatedData['payment_method'],
            'status' => $validatedData['status'],
            'packages' => implode(',', $validatedData['packages']), // Storing selected packages as a comma-separated string
        ]);

        return redirect()->route('orders.index')->with('success', 'Order created successfully!');
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

// Delete an order from the database
public function destroy($id)
{
$order = Order::findOrFail($id); // Find the order by its ID
$order->delete(); // Delete the order

// Redirect back with a success message
return redirect()->route('orders.index')->with('success', 'Order deleted successfully!');
}
}

@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-semibold mb-6">Guest Checkout</h1>
        <h3 class="text-3xl font-semibold mb-6">Just show this to the cashier!</h3>

        <!-- Display Validation Errors -->
        @if ($errors->any())
            <div class="mb-4">
                <ul class="list-disc list-inside text-sm text-red-500">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Display User Orders -->
        @if(isset($orders) && $orders->isNotEmpty())
            <h2 class="text-xl font-semibold mb-4">Your Orders</h2>
            <div class="mb-4">
                <table class="table-auto w-full border-separate border-spacing-0">
                    <thead>
                    @if(session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-lg shadow-md">
                            <strong class="font-semibold">Success:</strong> {{ session('success') }}
                        </div>
                    @endif

                    <tr>
                        <th class="px-6 py-2 text-sm text-gray-600">Total Amount</th>
                        <th class="px-6 py-2 text-sm text-gray-600">Payment Method</th>
                        <th class="px-6 py-2 text-sm text-gray-600">Status</th>
                        <th class="px-6 py-2 text-sm text-gray-600">Packages</th>
                        <th class="px-6 py-2 text-sm text-gray-600">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr class="border-b">
                            <td class="px-6 py-3 text-sm text-gray-800">${{ number_format($order->total_amount, 2) }}</td>
                            <td class="px-6 py-3 text-sm text-gray-800">{{ ucfirst($order->payment_method) }}</td>
                            <td class="px-6 py-3 text-sm text-gray-800">{{ ucfirst($order->status) }}</td>
                            <td class="px-6 py-3 text-sm text-gray-800">
                                @if($order->packages && is_array($order->packages))
                                    @foreach($order->packages as $packageId)
                                        @php
                                            // Search for the package name by ID
                                            $package = null;
                                            foreach($packages as $pkg) {
                                                if($pkg['id'] == $packageId) {
                                                    $package = $pkg;
                                                    break;
                                                }
                                            }
                                        @endphp
                                        @if($package)
                                            <span class="bg-blue-100 text-blue-800 px-3 py-2 rounded-full text-xs font-semibold">{{ $package['name'] }}</span>
                                        @endif
                                    @endforeach
                                @else
                                    <span class="text-gray-500">No packages selected</span>
                                @endif
                            </td>
                            <td class="px-6 py-3 text-sm">
                                @if($order->status != 'cancelled')
                                    <!-- Cancel Button with Form Trigger -->
                                    <form action="{{ route('orders.guest.cancel', $order->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-red-500 text-white px-6 py-3 rounded-lg hover:bg-red-600 text-xs font-semibold">
                                            Cancel
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-500">This order has been cancelled.</span>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-sm text-gray-500">You have no previous orders.</p>
        @endif

        <!-- Guest Information Fields -->
        <h2 class="text-xl font-semibold mb-4">Enter Your Details</h2>
        <form action="{{ route('guest.processOrder') }}" method="POST">
            @csrf
            @if(!$isLoggedIn)

                <div class="mb-4">
                    <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                    <input type="text" name="first_name" class="mt-1 p-2 border border-gray-300 rounded w-full" required>
                </div>

                <div class="mb-4">
                    <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                    <input type="text" name="last_name" class="mt-1 p-2 border border-gray-300 rounded w-full" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" class="mt-1 p-2 border border-gray-300 rounded w-full" required>
                </div>

                <div class="mb-4">
                    <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input type="text" name="phone_number" class="mt-1 p-2 border border-gray-300 rounded w-full" required>
                </div>
            @endif

            <!-- Packages Selection -->
            <div class="mb-4">
                <label for="packages" class="block text-sm font-medium text-gray-700">Packages</label>
                <div class="mt-2">
                    @foreach($packages as $package)
                        <label class="inline-flex items-center mr-4">
                            <input type="checkbox" name="packages[]" value="{{ $package['id'] }}" class="form-checkbox package-checkbox" data-price="{{ $package['price'] }}" />
                            <span class="ml-2">{{ $package['name'] }} (${{ number_format($package['price'], 2) }})</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Total Amount -->
            <div class="mb-4">
                <label for="total_amount" class="block text-sm font-medium text-gray-700">Total Amount</label>
                <input type="number" name="total_amount" id="total_amount" class="mt-1 p-2 border border-gray-300 rounded w-full" value="0" readonly>
            </div>

            <!-- Payment Method -->
            <div class="mb-4">
                <label for="payment_method" class="block text-sm font-medium text-gray-700">Payment Method</label>
                <select name="payment_method" id="payment_method" class="mt-1 p-2 border border-gray-300 rounded w-full" required>
                    <option value="credit_card">Credit Card</option>
                    <option value="paypal">PayPal</option>
                    <option value="bank_transfer">Bank Transfer</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Place Order</button>


        </form>

    </div>

    <script>
        // JavaScript to update total amount dynamically
        document.querySelectorAll('.package-checkbox').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                let totalAmount = 0;
                document.querySelectorAll('.package-checkbox:checked').forEach(function(checkedBox) {
                    totalAmount += parseFloat(checkedBox.getAttribute('data-price'));
                });
                document.getElementById('total_amount').value = totalAmount.toFixed(2);
            });
        });
    </script>
@endsection

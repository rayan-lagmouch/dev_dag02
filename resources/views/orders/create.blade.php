@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-semibold mb-6">Create New Order</h1>

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

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="person_id" class="block text-sm font-medium text-gray-700">Person</label>
                <select name="person_id" id="person_id" class="mt-1 p-2 border border-gray-300 rounded w-full" required>
                    <option value="">Select a person</option>
                    @foreach(\App\Models\Person::all() as $person)
                        <option value="{{ $person->id }}" {{ old('person_id') == $person->id ? 'selected' : '' }}>{{ $person->first_name }} {{ $person->last_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="order_time" class="block text-sm font-medium text-gray-700">Order Time</label>
                <input type="datetime-local" name="order_time" id="order_time" class="mt-1 p-2 border border-gray-300 rounded w-full" value="{{ \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}" readonly>
            </div>

            <div class="mb-4">
                <label for="total_amount" class="block text-sm font-medium text-gray-700">Total Amount</label>
                <input type="number" name="total_amount" id="total_amount" class="mt-1 p-2 border border-gray-300 rounded w-full" value="0" readonly>
            </div>

            <div class="mb-4">
                <label for="payment_method" class="block text-sm font-medium text-gray-700">Payment Method</label>
                <select name="payment_method" id="payment_method" class="mt-1 p-2 border border-gray-300 rounded w-full" required>
                    <option value="online" {{ old('payment_method') == 'online' ? 'selected' : '' }}>Online</option>
                    <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" class="mt-1 p-2 border border-gray-300 rounded w-full" required>
                    <option value="paid" {{ old('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="not_paid" {{ old('status') == 'not_paid' ? 'selected' : '' }}>Not Paid</option>
                    <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="packages" class="block text-sm font-medium text-gray-700">Packages</label>
                <div class="mt-2">
                    <label class="inline-flex items-center mr-4">
                        <input type="checkbox" name="packages[]" value="basic_snack_package" class="form-checkbox package-checkbox" data-price="15" />
                        <span class="ml-2">Basic Snack Package ($15)</span>
                    </label>
                    <label class="inline-flex items-center mr-4">
                        <input type="checkbox" name="packages[]" value="luxury_snack_package" class="form-checkbox package-checkbox" data-price="30" />
                        <span class="ml-2">Luxury Snack Package ($30)</span>
                    </label>
                    <label class="inline-flex items-center mr-4">
                        <input type="checkbox" name="packages[]" value="children_party" class="form-checkbox package-checkbox" data-price="28.50" />
                        <span class="ml-2">Children's Party ($28.50)</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="packages[]" value="bachelor_party" class="form-checkbox package-checkbox" data-price="200" />
                        <span class="ml-2">Bachelor Party ($200)</span>
                    </label>
                </div>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Create Order</button>
            <a href="{{ route('orders.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 ml-4">Back</a>  <!-- Back button -->
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

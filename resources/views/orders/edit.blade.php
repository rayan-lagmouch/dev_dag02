@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-semibold mb-6">Edit Order</h1>

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

        <form action="{{ route('orders.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Method Spoofing for Update -->

            <div class="mb-4">
                <label for="person_id" class="block text-sm font-medium text-gray-700">Person</label>
                <select name="person_id" id="person_id" class="mt-1 p-2 border border-gray-300 rounded" required>
                    <option value="">Select a person</option>
                    @foreach(\App\Models\Person::all() as $person)
                        <option value="{{ $person->id }}" {{ $order->person_id == $person->id ? 'selected' : '' }}>
                            {{ $person->first_name }} {{ $person->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="order_time" class="block text-sm font-medium text-gray-700">Order Time</label>
                <input type="datetime-local" name="order_time" id="order_time" class="mt-1 p-2 border border-gray-300 rounded" value="{{ \Carbon\Carbon::parse($order->order_time)->format('Y-m-d\TH:i') }}" required>
            </div>

            <div class="mb-4">
                <label for="total_amount" class="block text-sm font-medium text-gray-700">Total Amount</label>
                <input type="number" name="total_amount" id="total_amount" class="mt-1 p-2 border border-gray-300 rounded" value="{{ $order->total_amount }}" required>
            </div>

            <div class="mb-4">
                <label for="payment_method" class="block text-sm font-medium text-gray-700">Payment Method</label>
                <select name="payment_method" id="payment_method" class="mt-1 p-2 border border-gray-300 rounded" required>
                    <option value="online" {{ $order->payment_method == 'online' ? 'selected' : '' }}>Online</option>
                    <option value="cash" {{ $order->payment_method == 'cash' ? 'selected' : '' }}>Cash</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" class="mt-1 p-2 border border-gray-300 rounded" required>
                    <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="not_paid" {{ $order->status == 'not_paid' ? 'selected' : '' }}>Not Paid</option>
                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="packages" class="block text-sm font-medium text-gray-700">Packages</label>
                <div class="mt-2">
                    @php
                        $selectedPackages = is_string($order->packages) ? explode(',', $order->packages) : [];
                    @endphp
                    <label class="inline-flex items-center mr-4">
                        <input type="checkbox" name="packages[]" value="basic_snack_package" class="form-checkbox" {{ in_array('basic_snack_package', $selectedPackages) ? 'checked' : '' }} />
                        <span class="ml-2">Basic Snack Package ($15)</span>
                    </label>
                    <label class="inline-flex items-center mr-4">
                        <input type="checkbox" name="packages[]" value="luxury_snack_package" class="form-checkbox" {{ in_array('luxury_snack_package', $selectedPackages) ? 'checked' : '' }} />
                        <span class="ml-2">Luxury Snack Package ($30)</span>
                    </label>
                    <label class="inline-flex items-center mr-4">
                        <input type="checkbox" name="packages[]" value="children_party" class="form-checkbox" {{ in_array('children_party', $selectedPackages) ? 'checked' : '' }} />
                        <span class="ml-2">Children's Party ($28.50)</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="packages[]" value="bachelor_party" class="form-checkbox" {{ in_array('bachelor_party', $selectedPackages) ? 'checked' : '' }} />
                        <span class="ml-2">Bachelor Party ($200)</span>
                    </label>
                </div>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600">Update Order</button>
        </form>
    </div>
@endsection

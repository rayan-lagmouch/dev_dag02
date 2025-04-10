@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-xl font-bold mb-4">Create New Order</h1>

        <form action="{{ route('orders.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="person_id" class="block text-sm font-medium text-gray-700">Person</label>
                <select name="person_id" id="person_id" class="mt-1 block w-full border-gray-300 rounded shadow">
                    @foreach($people as $person)
                        <option value="{{ $person->id }}">{{ $person->first_name }} {{ $person->last_name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="order_time" class="block text-sm font-medium text-gray-700">Order Time</label>
                <input type="datetime-local" name="order_time" id="order_time" class="mt-1 block w-full border-gray-300 rounded shadow">
            </div>

            <div>
                <label for="total_amount" class="block text-sm font-medium text-gray-700">Total Amount</label>
                <input type="number" name="total_amount" id="total_amount" class="mt-1 block w-full border-gray-300 rounded shadow" required>
            </div>

            <div>
                <label for="payment_method" class="block text-sm font-medium text-gray-700">Payment Method</label>
                <input type="text" name="payment_method" id="payment_method" class="mt-1 block w-full border-gray-300 rounded shadow">
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded shadow">
                    <option value="active">Active</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save</button>
        </form>
    </div>
@endsection

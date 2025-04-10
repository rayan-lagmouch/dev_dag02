@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-semibold mb-6">Plaats je Bestelling</h1>

        <!-- Form for placing an order -->
        <form action="{{ route('order.store') }}" method="POST">
            @csrf

            <!-- Name of the customer (Pre-filled from the user) -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Naam</label>
                <input type="text" name="name" id="name" class="mt-1 p-2 border border-gray-300 rounded" value="{{ auth()->user()->name }}" required>
            </div>

            <!-- Email of the customer (Pre-filled from the user) -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="mt-1 p-2 border border-gray-300 rounded" value="{{ auth()->user()->email }}" required>
            </div>

            <!-- Select Packages -->
            <div class="mb-4">
                <label for="packages" class="block text-sm font-medium text-gray-700">Kies je Pakketten</label>
                <div class="mt-2">
                    <label class="inline-flex items-center mr-4">
                        <input type="checkbox" name="packages[]" value="basic_snack_package" class="form-checkbox" />
                        <span class="ml-2">Basic Snack Package (€15)</span>
                    </label>
                    <label class="inline-flex items-center mr-4">
                        <input type="checkbox" name="packages[]" value="luxury_snack_package" class="form-checkbox" />
                        <span class="ml-2">Luxury Snack Package (€30)</span>
                    </label>
                    <label class="inline-flex items-center mr-4">
                        <input type="checkbox" name="packages[]" value="children_party" class="form-checkbox" />
                        <span class="ml-2">Children's Party (€28.50)</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="packages[]" value="bachelor_party" class="form-checkbox" />
                        <span class="ml-2">Bachelor Party (€200)</span>
                    </label>
                </div>
            </div>

            <!-- Payment Method -->
            <div class="mb-4">
                <label for="payment_method" class="block text-sm font-medium text-gray-700">Betaalmethode</label>
                <select name="payment_method" id="payment_method" class="mt-1 p-2 border border-gray-300 rounded" required>
                    <option value="online">Online</option>
                    <option value="cash">cash</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600">Bestelling Plaatsen</button>
        </form>
    </div>
@endsection

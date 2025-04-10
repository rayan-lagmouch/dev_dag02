@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-6">
                        {{ __('New Contact') }}
                    </h2>

                    @if (session('success'))
                        <div id="success-message" class="bg-green-500 text-white p-4 rounded-md mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div id="error-message" class="bg-red-500 text-white p-4 rounded-md mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('contacts.store') }}" method="POST">
                        @csrf

                        <!-- Person -->
                        <div class="mb-4">
                            <label for="person_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Person</label>
                            <select name="person_id" id="person_id" required class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white">
                                <option value="">Select a person</option>
                                @foreach($people as $person)
                                    <option value="{{ $person->id }}">{{ $person->first_name }} {{ $person->last_name }}</option>
                                @endforeach
                            </select>
                            @error('person_id')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Emergency Contact Name -->
                        <div class="mb-4">
                            <label for="emergency_contact_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Emergency Contact Name</label>
                            <input type="text" name="emergency_contact_name" id="emergency_contact_name" value="{{ old('emergency_contact_name') }}" class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white">
                            @error('emergency_contact_name')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Emergency Contact Phone -->
                        <div class="mb-4">
                            <label for="emergency_contact_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Emergency Contact Phone</label>
                            <input type="tel" name="emergency_contact_phone" id="emergency_contact_phone" value="{{ old('emergency_contact_phone') }}" class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white">
                            @error('emergency_contact_phone')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="mb-4">
                            <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                            <input type="text" name="address" id="address" value="{{ old('address') }}" class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white">
                            @error('address')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>


                        <!-- Submit Button -->
                        <div class="mb-4">
                            <button type="submit" class="px-6 py-2 bg-green-600 text-white font-semibold rounded-md shadow-md hover:bg-green-700 dark:bg-green-500 dark:hover:bg-green-600">
                                Save Contact
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto-dismiss flash messages
        setTimeout(() => document.getElementById("success-message")?.remove(), 3000);
        setTimeout(() => document.getElementById("error-message")?.remove(), 3000);
    </script>
@endsection

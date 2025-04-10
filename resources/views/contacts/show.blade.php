@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-6">
                        {{ __('Contact Details') }}
                    </h2>

                    <div class="mb-4">
                        <span class="block text-sm font-medium text-gray-700 dark:text-gray-300">Person</span>
                        <div class="mt-1">{{ $contact->person->first_name }} {{ $contact->person->last_name }}</div>
                    </div>

                    <div class="mb-4">
                        <span class="block text-sm font-medium text-gray-700 dark:text-gray-300">Emergency Contact Name</span>
                        <div class="mt-1">{{ $contact->emergency_contact_name }}</div>
                    </div>

                    <div class="mb-4">
                        <span class="block text-sm font-medium text-gray-700 dark:text-gray-300">Emergency Contact Phone</span>
                        <div class="mt-1">{{ $contact->emergency_contact_phone }}</div>
                    </div>

                    <div class="mb-6">
                        <span class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</span>
                        <div class="mt-1">{{ $contact->address }}</div>
                    </div>

                    <div class="mb-4">
                        <span class="block text-sm font-medium text-gray-700 dark:text-gray-300">Created At</span>
                        <div class="mt-1">{{ $contact->created_at->format('F j, Y g:i A') }}</div>
                    </div>

                    <a href="{{ route('contacts.index') }}" class="inline-block px-6 py-2 bg-gray-600 text-white font-semibold rounded-md shadow-md hover:bg-gray-700 dark:bg-gray-500 dark:hover:bg-gray-600">
                        Back to All Contacts
                    </a>

                </div>
            </div>
        </div>
    </div>
@endsection

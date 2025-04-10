<!-- resources/views/contacts/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Contact Details</h1>

        <div class="mb-3">
            <strong>Person:</strong> {{ $contact->person->first_name }} {{ $contact->person->last_name }}
        </div>
        <div class="mb-3">
            <strong>Emergency Contact Name:</strong> {{ $contact->emergency_contact_name }}
        </div>
        <div class="mb-3">
            <strong>Emergency Contact Phone:</strong> {{ $contact->emergency_contact_phone }}
        </div>
        <div class="mb-3">
            <strong>Address:</strong> {{ $contact->address }}
        </div>

        <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Back to All Contacts</a>
    </div>
@endsection

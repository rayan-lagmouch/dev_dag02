<!-- resources/views/contacts/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>All Contacts</h1>

        <a href="{{ route('contacts.create') }}" class="btn btn-primary mb-3">Add New Contact</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
            <tr>
                <th>Person</th>
                <th>Emergency Contact Name</th>
                <th>Emergency Contact Phone</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($contacts as $contact)
                <tr>
                    <td>{{ $contact->person->first_name }} {{ $contact->person->last_name }}</td>
                    <td>{{ $contact->emergency_contact_name }}</td>
                    <td>{{ $contact->emergency_contact_phone }}</td>
                    <td>{{ $contact->address }}</td>
                    <td>
                        <a href="{{ route('contacts.show', $contact->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

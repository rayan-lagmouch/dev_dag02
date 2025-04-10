<!-- resources/views/contacts/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Contact</h1>

        <form action="{{ route('contacts.update', $contact->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="person_id">Person</label>
                <select name="person_id" id="person_id" class="form-control" required>
                    @foreach($people as $person)
                        <option value="{{ $person->id }}" {{ $contact->person_id == $person->id ? 'selected' : '' }}>
                            {{ $person->first_name }} {{ $person->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="emergency_contact_name">Emergency Contact Name</label>
                <input type="text" name="emergency_contact_name" id="emergency_contact_name" class="form-control" value="{{ $contact->emergency_contact_name }}">
            </div>

            <div class="form-group">
                <label for="emergency_contact_phone">Emergency Contact Phone</label>
                <input type="text" name="emergency_contact_phone" id="emergency_contact_phone" class="form-control" value="{{ $contact->emergency_contact_phone }}">
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" class="form-control" value="{{ $contact->address }}">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection

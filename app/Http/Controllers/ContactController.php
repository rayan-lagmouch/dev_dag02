<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Person;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Display a listing of the contacts
    public function index()
    {
        $contacts = Contact::all();
        return view('contacts.index', compact('contacts'));
    }

    // Show the form for creating a new contact
    public function create()
    {
        $people = Person::all(); // Retrieve all people for selection
        return view('contacts.create', compact('people'));
    }

    // Store a newly created contact in storage
    public function store(Request $request)
    {
        $request->validate([
            'person_id' => 'required|exists:people,id',
            'emergency_contact_name' => 'nullable|string|max:100',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:100',
        ]);

        Contact::create($request->all());

        return redirect()->route('contacts.index')->with('success', 'Contact created successfully.');
    }

    // Show the form for editing the specified contact
    public function edit(Contact $contact)
    {
        $people = Person::all();
        return view('contacts.edit', compact('contact', 'people'));
    }

    // Update the specified contact in storage
    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'person_id' => 'required|exists:people,id',
            'emergency_contact_name' => 'nullable|string|max:100',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:100',
        ]);

        $contact->update($request->all());

        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully.');
    }

    // Remove the specified contact from storage
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully.');
    }
}

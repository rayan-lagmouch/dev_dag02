<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Person;
use App\Models\Reservation; // Assuming you have a Reservation model
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

        // Create the contact record
        Contact::create($request->all());

        return redirect()->route('contacts.index')->with('success', 'Contact created successfully.');
    }

    // Show the form for editing the specified contact
    public function edit(Contact $contact)
    {
        $people = Person::all(); // Retrieve all people for selection
        return view('contacts.edit', compact('contact', 'people'));
    }

    // Update the specified contact in storage
    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);

        // Validate the data
        $validated = $request->validate([
            'person_id' => 'required|exists:people,id',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        // Update the contact
        $contact->update($validated);

        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully.');
    }



    // Remove the specified contact from storage
// Remove the specified contact from storage
    public function destroy(Contact $contact)
    {
        // Scenario 2: Check if the contact is inactive
        if ($contact->is_active === false) {
            // If the contact is inactive, show an error message and prevent deletion
            return redirect()->route('contacts.index')->with('error', 'Contact info is inactive and cannot be deleted');
        }

        // Delete the contact after ensuring it is not associated with any reservation and is active
        $contact->delete();

        // Redirect back to the contacts index with a success message
        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully.');
    }


    // Show the details of a specific contact
    public function show($id)
    {
        // Find the contact by its ID
        $contact = Contact::findOrFail($id);

        // Return the view with the contact data
        return view('contacts.show', compact('contact'));
    }
}

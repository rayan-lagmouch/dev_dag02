<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Person;
use App\Models\Reservation; // Voeg dit toe om reserveringen te beheren
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Toon de lijst van contactpersonen
    public function index()
    {
        $contacts = Contact::all();
        return view('contacts.index', compact('contacts'));
    }

    // Toon het formulier voor het maken van een nieuw contact
    public function create()
    {
        $people = Person::all(); // Haal alle personen op voor selectie
        return view('contacts.create', compact('people'));
    }

    // Sla een nieuw contact op
    public function store(Request $request)
    {
        // Validatie van de invoer
        $validated = $request->validate([
            'person_id' => 'required|exists:people,id',
            'emergency_contact_name' => 'nullable|string|max:100',
            'emergency_contact_phone' => 'nullable|string|regex:/^[0-9\-\+]{9,15}$/', // Validatie voor telefoonnummer
            'address' => 'nullable|string|max:100',
        ], [
            'emergency_contact_phone.regex' => 'Ongeldig telefoonnummerformaat, gebruik alleen cijfers, plus of streepjes.',
        ]);

        // Maak het contact aan
        Contact::create($validated);

        return redirect()->route('contacts.index')->with('success', 'Contact toegevoegd.');
    }

    // Toon het formulier voor het bewerken van een contact
    public function edit(Contact $contact)
    {
        $people = Person::all(); // Haal alle personen op voor selectie
        return view('contacts.edit', compact('contact', 'people'));
    }

    // Werk een bestaand contact bij
    public function update(Request $request, Contact $contact)
    {
        // Valideer de ingevoerde gegevens
        $validated = $request->validate([
            'person_id' => 'required|exists:people,id',
            'emergency_contact_name' => 'nullable|string|max:100',
            'emergency_contact_phone' => 'nullable|string|regex:/^[0-9\-\+]{9,15}$/', // Validatie voor telefoonnummer
            'address' => 'nullable|string|max:100',
        ], [
            'emergency_contact_phone.regex' => 'Ongeldig telefoonnummerformaat, gebruik alleen cijfers, plus of streepjes.',
        ]);

        // Werk het contact bij
        $contact->update($validated);

        return redirect()->route('contacts.index')->with('success', 'Contact bijgewerkt.');
    }

    // Verwijder een contact
    public function destroy(Contact $contact)
    {
        // Scenario 1: Check if the contact is associated with any reservations
        $reservation = Reservation::where('contact_id', $contact->id)->first();

        if ($reservation) {
            // If the contact is associated with a reservation, update the reservation and set contact_id to null
            $reservation->update([
                'contact_id' => null, // Remove the contact from the reservation
            ]);
        }

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


    // Toon de details van een specifiek contact
    public function show($id)
    {
        // Vind het contact op basis van het ID
        $contact = Contact::findOrFail($id);

        // Return de view met de contactgegevens
        return view('contacts.show', compact('contact'));
    }
}

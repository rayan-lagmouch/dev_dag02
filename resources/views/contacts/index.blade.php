@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- Success and error messages --}}
                    @if(session('success'))
                        <div id="success-message" class="bg-green-500 text-white p-4 rounded-md mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div id="error-message" class="bg-red-500 text-white p-4 rounded-md mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="mb-4 flex justify-between items-center">
                        <div class="w-1/3">
                            <input type="text" id="searchInput" placeholder="Zoek op achternaam..." class="w-full px-4 py-2 border rounded-md">
                        </div>
                        <a href="{{ route('contacts.create') }}" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600">
                            Voeg Contact toe
                        </a>
                    </div>

                    <h3 class="text-lg font-semibold mb-4">Contactenlijst</h3>

                    @if($contacts->isEmpty())
                        <p class="text-gray-500">Er zijn geen contacten beschikbaar</p>
                    @else
                        <table class="w-full text-left border-collapse" id="contactTable">
                            <thead>
                            <tr>
                                <th class="border px-4 py-2">Persoon</th>
                                <th class="border px-4 py-2">Naam Noodcontact</th>
                                <th class="border px-4 py-2">Telefoon</th>
                                <th class="border px-4 py-2">Adres</th>
                                <th class="border px-4 py-2">status</th>
                                <th class="border px-4 py-2">Acties</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contacts as $contact)
                                <tr>
                                    <td class="border px-4 py-2">{{ $contact->person->first_name ?? 'N/A' }} {{ $contact->person->last_name ?? '' }} </td>
                                    <td class="border px-4 py-2">{{ $contact->emergency_contact_name }}</td>
                                    <td class="border px-4 py-2">{{ $contact->emergency_contact_phone }}</td>
                                    <td class="border px-4 py-2">{{ $contact->address }}</td>
                                    <td class="border px-4 py-2">
                                        <span class="text-{{ $contact->is_active ? 'green' : 'red' }}-500">
                                            {{ $contact->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('contacts.show', $contact->id) }}" class="text-blue-500">Show</a>
                                        <a href="{{ route('contacts.edit', $contact->id) }}" class="text-yellow-500 ml-2">Edit</a>

                                        {{-- Only show delete button for active contacts --}}
                                        @if ($contact->is_active)
                                            <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" class="inline-block ml-2" onsubmit="return confirmDelete('{{ $contact->person->first_name }} {{ $contact->person->last_name }}')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500">delete</button>
                                            </form>
                                        @else
                                            <span class="text-red-500">contact info is inactive and cannot be deleted</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        // Hide success and error messages after 3 seconds
        setTimeout(() => document.getElementById("success-message")?.remove(), 3000);
        setTimeout(() => document.getElementById("error-message")?.remove(), 3000);

        // Confirm delete action
        function confirmDelete(fullName) {
            return confirm(`are you sure you would like to delete "${fullName}" ?`);
        }
    </script>
@endsection

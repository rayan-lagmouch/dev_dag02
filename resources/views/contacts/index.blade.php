@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(session('success'))
                        <div id="success-message" class="bg-green-500 text-white p-4 rounded-md mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-4 flex justify-between items-center">
                        <div class="w-1/3">
                            <input type="text" id="searchInput" placeholder="Search based on Last Name..." class="w-full px-4 py-2 border rounded-md">
                        </div>
                        <a href="{{ route('contacts.create') }}" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600">
                            Add Contact
                        </a>
                    </div>

                    <h3 class="text-lg font-semibold mb-4">Contact List</h3>

                    @if($contacts->isEmpty())
                        <p class="text-gray-500">There are no contacts available</p>
                    @else
                        <table class="w-full text-left border-collapse" id="contactTable">
                            <thead>
                            <tr>
                                <th class="border px-4 py-2">Person</th>
                                <th class="border px-4 py-2">Emergency Name</th>
                                <th class="border px-4 py-2">Phone</th>
                                <th class="border px-4 py-2">Address</th>
                                <th class="border px-4 py-2">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contacts as $contact)
                                <tr>
                                    <td class="border px-4 py-2">{{ $contact->person->first_name }} {{ $contact->person->last_name }}</td>
                                    <td class="border px-4 py-2">{{ $contact->emergency_contact_name }}</td>
                                    <td class="border px-4 py-2">{{ $contact->emergency_contact_phone }}</td>
                                    <td class="border px-4 py-2">{{ $contact->address }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('contacts.show', $contact->id) }}" class="text-blue-500">View</a>
                                        <a href="{{ route('contacts.edit', $contact->id) }}" class="text-yellow-500 ml-2">Edit</a>
                                        <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" class="inline-block ml-2" onsubmit="return confirm('Are you sure you want to delete this contact?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500">Delete</button>
                                        </form>
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
        document.getElementById("searchInput").addEventListener("input", function() {
            let filter = this.value.toLowerCase();
            let tableRows = document.querySelectorAll("#contactTable tbody tr");
            let found = false;

            tableRows.forEach(row => {
                let name = row.getElementsByTagName("td")[0].textContent.toLowerCase();
                let lastName = name.split(" ").slice(-1)[0];
                if (lastName.includes(filter)) {
                    row.style.display = "";
                    found = true;
                } else {
                    row.style.display = "none";
                }
            });

            let noResultsMessage = document.getElementById("noResultsMessage");
            if (!found) {
                if (!noResultsMessage) {
                    noResultsMessage = document.createElement("div");
                    noResultsMessage.id = "noResultsMessage";
                    noResultsMessage.className = "bg-red-500 text-white p-4 rounded-md mt-4";
                    noResultsMessage.textContent = "No Contacts found with this Last Name";
                    document.querySelector("#contactTable").insertAdjacentElement("afterend", noResultsMessage);
                }
            } else if (noResultsMessage) {
                noResultsMessage.remove();
            }
        });

        setTimeout(() => document.getElementById("success-message")?.remove(), 3000);
    </script>
@endsection

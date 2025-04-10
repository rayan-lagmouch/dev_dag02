<!-- resources/views/dashboard.blade.php -->

@extends('layouts.app')  <!-- Use the default layout or your layout here -->

@section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-2xl p-6">
                <h2 class="text-2xl font-bold mb-4">Dashboard</h2>

                <p class="text-gray-600 mb-6">Welcome, {{ auth()->user()->name }} (Role: {{ auth()->user()->getRoleNames()->first() }})</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @role('member')
                    <x-dashboard-link route="reservations.index" label="Manage Reservations" />
                    <x-dashboard-link route="orders.index" label="Manage Orders" />
                    <x-dashboard-link route="scores.index" label="Manage Scores" />
                    @endrole

                    @role('employee')
                    <x-dashboard-link route="reservations.index" label="Manage Reservations" />
                    <x-dashboard-link route="orders.index" label="Manage Orders" />
                    <x-dashboard-link route="scores.index" label="Manage Scores" />
                    <x-dashboard-link route="contacts.index" label="Manage Contacts" />
                    @endrole

                    @role('administrator')
                    <x-dashboard-link route="reservations.index" label="Manage Reservations" />
                    <x-dashboard-link route="orders.index" label="Manage Orders" />
                    <x-dashboard-link route="scores.index" label="Manage Scores" />
                    <x-dashboard-link route="contacts.index" label="Manage Contacts" />
                    @endrole

                    @role('guest')
                    <div class="p-4 bg-yellow-100 rounded-lg text-yellow-800">
                        You're browsing as a guest. Please register or login to access features.
                    </div>
                    @endrole
                </div>
            </div>
        </div>
    </div>
@endsection

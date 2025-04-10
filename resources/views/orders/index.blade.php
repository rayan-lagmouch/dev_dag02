@extends('layouts.app')
@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-4">All Orders</h1>

        <a href="{{ route('orders.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">Add New Order</a>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">{{ session('success') }}</div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded shadow">
                <thead>
                <tr class="bg-gray-100 text-left text-gray-700 uppercase text-sm">
                    <th class="px-4 py-2">Person</th>
                    <th class="px-4 py-2">Order Time</th>
                    <th class="px-4 py-2">Total</th>
                    <th class="px-4 py-2">Method</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $order->person->first_name }} {{ $order->person->last_name }}</td>
                        <td class="px-4 py-2">{{ $order->order_time }}</td>
                        <td class="px-4 py-2">{{ $order->total_amount }}</td>
                        <td class="px-4 py-2">{{ $order->payment_method }}</td>
                        <td class="px-4 py-2">
                            <span class="{{ $order->status == 'active' ? 'text-green-600' : 'text-red-600' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-2 space-x-2">
                            <a href="{{ route('orders.show', $order->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600 text-sm">View</a>
                            <a href="{{ route('orders.edit', $order->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 text-sm">Edit</a>
                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 text-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

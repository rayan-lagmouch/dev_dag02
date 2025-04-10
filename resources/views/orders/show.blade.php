@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-xl font-bold mb-4">Order Details</h1>

        <div class="bg-white rounded shadow p-4 space-y-2">
            <div><strong>Person:</strong> {{ $order->person->first_name }} {{ $order->person->last_name }}</div>
            <div><strong>Order Time:</strong> {{ $order->order_time }}</div>
            <div><strong>Total Amount:</strong> {{ $order->total_amount }}</div>
            <div><strong>Payment Method:</strong> {{ $order->payment_method }}</div>
            <div><strong>Status:</strong>
                <span class="{{ $order->status == 'active' ? 'text-green-600' : 'text-red-600' }}">
                {{ ucfirst($order->status) }}
            </span>
            </div>
        </div>

        <a href="{{ route('orders.index') }}" class="mt-4 inline-block bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Back</a>
    </div>
@endsection

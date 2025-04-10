<!-- resources/views/orders/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Order Details</h1>

        <div class="mb-3">
            <strong>Reservation ID:</strong> {{ $order->reservation->id }}
        </div>
        <div class="mb-3">
            <strong>Order Time:</strong> {{ $order->order_time }}
        </div>
        <div class="mb-3">
            <strong>Total Amount:</strong> {{ $order->total_amount }}
        </div>
        <div class="mb-3">
            <strong>Payment Method:</strong> {{ $order->payment_method }}
        </div>
        <div class="mb-3">
            <strong>Status:</strong> {{ $order->is_paid ? 'Paid' : 'Unpaid' }}
        </div>

        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back to Orders</a>
    </div>
@endsection

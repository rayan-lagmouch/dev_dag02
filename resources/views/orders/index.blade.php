<!-- resources/views/orders/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>All Orders</h1>

        <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">Add New Order</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
            <tr>
                <th>Reservation</th>
                <th>Order Time</th>
                <th>Total Amount</th>
                <th>Payment Method</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->reservation->id }}</td>
                    <td>{{ $order->order_time }}</td>
                    <td>{{ $order->total_amount }}</td>
                    <td>{{ $order->payment_method }}</td>
                    <td>{{ $order->is_paid ? 'Paid' : 'Unpaid' }}</td>
                    <td>
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

<!-- resources/views/orders/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Order</h1>

        <form action="{{ route('orders.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="reservation_id">Reservation</label>
                <select name="reservation_id" id="reservation_id" class="form-control" required>
                    @foreach($reservations as $reservation)
                        <option value="{{ $reservation->id }}" {{ $order->reservation_id == $reservation->id ? 'selected' : '' }}>
                            {{ $reservation->id }} - {{ $reservation->reservation_date }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="order_time">Order Time</label>
                <input type="datetime-local" name="order_time" id="order_time" class="form-control" value="{{ $order->order_time->format('Y-m-d\TH:i') }}">
            </div>

            <div class="form-group">
                <label for="total_amount">Total Amount</label>
                <input type="number" name="total_amount" id="total_amount" class="form-control" value="{{ $order->total_amount }}" required>
            </div>

            <div class="form-group">
                <label for="payment_method">Payment Method</label>
                <input type="text" name="payment_method" id="payment_method" class="form-control" value="{{ $order->payment_method }}">
            </div>

            <div class="form-group">
                <label for="is_paid">Paid</label>
                <select name="is_paid" id="is_paid" class="form-control">
                    <option value="0" {{ !$order->is_paid ? 'selected' : '' }}>Unpaid</option>
                    <option value="1" {{ $order->is_paid ? 'selected' : '' }}>Paid</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection

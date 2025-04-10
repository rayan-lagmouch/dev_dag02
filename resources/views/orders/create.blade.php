<!-- resources/views/orders/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create New Order</h1>

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="reservation_id">Reservation</label>
                <select name="reservation_id" id="reservation_id" class="form-control" required>
                    @foreach($reservations as $reservation)
                        <option value="{{ $reservation->id }}">{{ $reservation->id }} - {{ $reservation->reservation_date }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="order_time">Order Time</label>
                <input type="datetime-local" name="order_time" id="order_time" class="form-control">
            </div>

            <div class="form-group">
                <label for="total_amount">Total Amount</label>
                <input type="number" name="total_amount" id="total_amount" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="payment_method">Payment Method</label>
                <input type="text" name="payment_method" id="payment_method" class="form-control">
            </div>

            <div class="form-group">
                <label for="is_paid">Paid</label>
                <select name="is_paid" id="is_paid" class="form-control">
                    <option value="0">Unpaid</option>
                    <option value="1">Paid</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection

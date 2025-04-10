@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-3xl font-semibold text-center text-indigo-600 mb-6">Order Confirmation</h2>

            <p class="text-lg text-gray-700 text-center mb-4">Thank you for your order!</p>

            <div class="text-center mb-6">
                <p class="text-xl text-gray-800">Your order has been successfully placed.</p>
                <p class="text-md text-gray-600 mt-2">You can pay for your order at the bar. Enjoy!</p>
            </div>



            <div class="text-center mt-6">
                <a href="{{ url('/') }}" class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition-all">Back to Home</a>
            </div>
        </div>
    </div>
@endsection

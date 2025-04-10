@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-semibold mb-6">Orders</h1>

        <!-- Add Order Button -->
        <div class="mb-4">
            <a href="{{ route('orders.create') }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600">
                Add New Order
            </a>
        </div>

        <!-- Check if there are any orders -->
        @if($orders->isEmpty())
            <div class="text-center p-4 bg-yellow-100 border border-yellow-500 rounded-lg">
                <p class="text-lg font-medium text-yellow-700">No order found.</p>
            </div>
        @else
            <table class="min-w-full table-auto border-separate border-spacing-0">
                <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="px-6 py-3 text-sm font-medium text-gray-600">Customer</th>
                    <th class="px-6 py-3 text-sm font-medium text-gray-600">Order Time</th>
                    <th class="px-6 py-3 text-sm font-medium text-gray-600">Total Amount</th>
                    <th class="px-6 py-3 text-sm font-medium text-gray-600">Payment Method</th>
                    <th class="px-6 py-3 text-sm font-medium text-gray-600">Status</th>
                    <th class="px-6 py-3 text-sm font-medium text-gray-600">Packages</th>
                    <th class="px-6 py-3 text-sm font-medium text-gray-600">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-3 text-sm text-gray-800">
                            @if($order->person)
                                {{ $order->person->first_name }} {{ $order->person->last_name }}
                            @else
                                <span class="text-gray-500">No person associated</span>
                            @endif
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-800">
                            {{ \Carbon\Carbon::parse($order->order_time)->format('F j, Y, g:i a') }}
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-800">
                            {{ number_format($order->total_amount, 2) }}
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-800">
                            {{ ucfirst($order->payment_method) }}
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-800">
                            {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-800">
                            @if($order->package_names && is_array($order->package_names))
                                @foreach($order->package_names as $package)
                                    <span class="bg-blue-100 text-blue-800 px-3 py-2 rounded-full text-xs font-semibold">{{ $package }}</span>
                                @endforeach
                            @else
                                <span class="text-gray-500">No packages selected</span>
                            @endif
                        </td>
                        <td class="px-6 py-3 text-sm">
                            <a href="{{ route('orders.edit', $order->id) }}" class="bg-yellow-500 text-white px-6 py-3 rounded-lg hover:bg-yellow-600 text-xs font-semibold mr-4">Edit</a>

                            <!-- Cancel Button with Modal Trigger -->
                            <button class="bg-red-500 text-white px-6 py-3 rounded-lg hover:bg-red-600 text-xs font-semibold" onclick="openCancelModal({{ $order->id }}, '{{ $order->status }}')">Cancel</button>

                            <!-- Cancel Order Modal -->
                            <div id="cancelModal{{ $order->id }}" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50 hidden">
                                <div class="bg-white rounded-lg p-6 w-96">
                                    <h3 class="text-lg font-semibold mb-4">Are you sure you want to cancel this order?</h3>
                                    <div class="flex justify-between">
                                        <button class="bg-gray-500 text-white px-4 py-2 rounded" onclick="closeCancelModal({{ $order->id }})">Cancel</button>
                                        <form action="{{ route('orders.cancel', $order->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Confirm Cancel</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Message for already cancelled orders -->
                            <div id="alreadyCancelled{{ $order->id }}" class="hidden absolute top-0 left-1/2 transform -translate-x-1/2 bg-red-200 text-center p-4 w-80 rounded-md mt-4">
                                <p class="text-sm text-gray-700">You can't cancel this order, it's already been cancelled.</p>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <script>
        // Open the modal to confirm cancellation
        function openCancelModal(orderId, status) {
            if (status === 'cancelled') {
                document.getElementById('alreadyCancelled' + orderId).classList.remove('hidden');
                return;
            }

            // Show the confirmation modal
            document.getElementById('cancelModal' + orderId).classList.remove('hidden');
        }

        // Close the cancellation modal
        function closeCancelModal(orderId) {
            document.getElementById('cancelModal' + orderId).classList.add('hidden');
        }
    </script>
@endsection

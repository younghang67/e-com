@extends('layouts.dashboard')

@section('title', 'My Orders')

@section('breadcrumb')
    <span class="mx-2 text-gray-400">/</span>
    <span class="text-gray-800">My Orders</span>
@endsection

@section('content')
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h1 class="text-2xl font-bold mb-6">My Orders</h1>

        @if($orders->count())
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Order</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($orders as $order)
                        <tr>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                #{{ $order->order_number }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $order->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if($order->status === 'completed') bg-green-100 text-green-800
                                    @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                                    @elseif($order->status === 'shipped') bg-yellow-100 text-yellow-800
                                    @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800
                                    @endif
                                ">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                Rs{{ number_format($order->total_amount, 2) }}
                            </td>
                            <td class="px-6 py-4 text-sm font-medium space-x-2">
                                <a href="{{ route('dashboard.orders.show', $order->id) }}" class="text-blue-600 hover:text-blue-900">View</a>

                                @if($order->status === 'processing')
                                    <a href="{{ route('dashboard.orders.cancel', $order->id) }}" class="text-red-600 hover:text-red-800">Cancel</a>
                                @elseif($order->status === 'shipped')
                                    <a href="{{ route('dashboard.orders.track', $order->id) }}" class="text-yellow-600 hover:text-yellow-800">Track</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $orders->links() }}
            </div>
        @else
            <div class="text-center py-10">
                <div class="text-5xl mb-4 text-gray-300">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <h3 class="text-lg font-medium mb-2">No orders yet</h3>
                <p class="text-gray-500 mb-4">Looks like you haven't ordered anything yet.</p>
                <a href="{{ route('home') }}" class="inline-block bg-primary text-white px-6 py-2 rounded-md font-medium">Start Shopping</a>
            </div>
        @endif
    </div>
@endsection

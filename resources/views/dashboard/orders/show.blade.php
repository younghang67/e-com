@extends('layouts.dashboard')

@section('title', 'Order Details')

@section('breadcrumb')
    <span class="mx-2 text-gray-400">/</span>
    <span class="text-gray-800">Order #{{ $order->order_number }}</span>
@endsection

@section('content')
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h1 class="text-2xl font-bold mb-6">Order #{{ $order->order_number }}</h1>

        <p><strong>Order Date:</strong> {{ $order->created_at->format('M d, Y') }}</p>
        <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
        <p><strong>Total:</strong> Rs{{ number_format($order->total_amount, 2) }}</p>

        <div class="mt-6">
            <h2 class="text-xl font-semibold mb-4">Order Items</h2>
            @if($order->orderItems->count())
                <ul class="list-disc pl-6 space-y-2">
                    @foreach($order->orderItems as $item)
                        <li>
                            {{ $item->product_name }} - Quantity: {{ $item->quantity }} - Rs{{ number_format($item->price, 2) }}
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No items found for this order.</p>
            @endif
        </div>

        <div class="mt-8">
            <a href="{{ route('dashboard.orders.index') }}" class="text-blue-600 hover:underline">← Back to My Orders</a>
        </div>
    </div>
@endsection

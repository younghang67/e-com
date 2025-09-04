@extends('layouts.dashboard')

@section('title', 'Track Order')

@section('breadcrumb')
    <span class="mx-2 text-gray-400">/</span>
    <span class="text-gray-800">Track #{{ $order->order_number }}</span>
@endsection

@section('content')
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h1 class="text-2xl font-bold mb-6">Tracking Order #{{ $order->order_number }}</h1>

        <p><strong>Order Status:</strong> {{ ucfirst($order->status) }}</p>
        <p><strong>Tracking Number:</strong> {{ $order->tracking_number ?? 'N/A' }}</p>

        @if($order->status == 'shipped')
            <div class="mt-6">
                <p class="text-gray-600">Your package is on the way! 🚚</p>
            </div>
        @elseif($order->status == 'completed')
            <div class="mt-6">
                <p class="text-green-600">Your package has been delivered! ✅</p>
            </div>
        @else
            <div class="mt-6">
                <p class="text-gray-400">Tracking info is not available for this order status.</p>
            </div>
        @endif

        <div class="mt-8">
            <a href="{{ route('dashboard.orders.index') }}" class="text-blue-600 hover:underline">← Back to My Orders</a>
        </div>
    </div>
@endsection

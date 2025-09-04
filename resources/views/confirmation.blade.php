@extends('layouts.app')

@section('title', 'Order Confirmation ')

@section('content')
<!-- Breadcrumb -->
<div class="bg-gray-100 py-4">
    <div class="container mx-auto px-4">
        <div class="flex items-center text-sm">
            <a href="/" class="text-gray-600 hover:text-gray-900">Home</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="text-gray-800">Order Confirmation</span>
        </div>
    </div>
</div>

<!-- Confirmation Content -->
<div class="container mx-auto px-4 py-12">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-sm p-8 text-center mb-8">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-check text-green-500 text-2xl"></i>
            </div>
            <h1 class="text-2xl font-bold mb-2">Thank You for Your Order!</h1>

            @if($orderData['account_created'] ?? false)
            <div class="bg-green-50 border border-green-200 rounded-md p-3 mb-4">
                <p class="text-green-800">
                    <i class="fas fa-user-check mr-2"></i>
                    Your account has been created successfully! You can now track your orders and enjoy faster checkout in the future.
                </p>
            </div>
            @endif

            <p class="text-gray-600 mb-6">Your order has been placed successfully.</p>
            <div class="text-lg font-medium mb-2">Order Number: {{ $orderData['order_number'] }}</div>
            <p class="text-gray-600 mb-6">We've sent a confirmation email to your email address.</p>
            <div class="flex justify-center">
                <a href="/" class="bg-black text-white px-6 py-3 rounded-md font-medium hover:bg-gray-800 transition-colors">
                    Continue Shopping
                </a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <h2 class="text-lg font-medium mb-4">Order Details</h2>

            <div class="border-b pb-4 mb-4">
                <h3 class="font-medium mb-2">Shipping Address</h3>
                <div class="text-sm text-gray-600">
                    {{ $orderData['shipping_address']['name'] }}<br>
                    {{ $orderData['shipping_address']['address'] }}<br>
                    @if($orderData['shipping_address']['address2'])
                        {{ $orderData['shipping_address']['address2'] }}<br>
                    @endif
                    {{ $orderData['shipping_address']['city'] }}, {{ $orderData['shipping_address']['state'] }} {{ $orderData['shipping_address']['zip'] }}<br>
                    {{ $orderData['shipping_address']['country'] }}
                </div>
            </div>

            <div class="border-b pb-4 mb-4">
                <h3 class="font-medium mb-2">Items</h3>
                <div class="space-y-3">
                    @foreach($orderData['items'] as $item)
                        <div class="flex items-center">
                            <div class="w-16 h-16 flex-shrink-0 bg-gray-100 rounded-md overflow-hidden mr-4">
                                <img src="{{ asset($item['image'] ?? 'images/product-placeholder.jpg') }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-grow">
                                <h4 class="font-medium">{{ $item['name'] }}</h4>
                                @if(isset($item['color']))
                                    <div class="text-sm text-gray-500">Color: {{ $item['color'] }}</div>
                                @endif
                                @if(isset($item['size']))
                                    <div class="text-sm text-gray-500">Size: {{ $item['size'] }}</div>
                                @endif
                            </div>
                            <div class="text-right">
                                <div class="font-medium">Rs{{ number_format($item['price']) }}.00</div>
                                <div class="text-sm text-gray-500">Qty: {{ $item['quantity'] }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="border-b pb-4 mb-4">
                <div class="flex justify-between mb-2">
                    <span class="text-gray-600">Subtotal</span>
                    <span class="font-medium">Rs{{ number_format($orderData['total'] * 0.9) }}.00</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span class="text-gray-600">Tax</span>
                    <span class="font-medium">Rs{{ number_format($orderData['total'] * 0.1) }}.00</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Shipping</span>
                    <span class="font-medium">Free</span>
                </div>
            </div>

            <div class="flex justify-between text-lg font-bold">
                <span>Total</span>
                <span>Rs{{ number_format($orderData['total']) }}.00</span>
            </div>
        </div>

        <div class="text-center">
            <p class="text-gray-600 mb-4">Need help with your order?</p>
            <p class="mb-6">Contact our customer support at <a href="mailto:support@example.com" class="text-blue-600">support@example.com</a></p>
            <a href="/" class="text-blue-600 hover:underline">Return to Home Page</a>
        </div>
    </div>
</div>
@endsection

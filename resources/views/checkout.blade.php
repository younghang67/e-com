@extends('layouts.app')

@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-2xl font-bold mb-8 text-center">Checkout</h1>

        <form method="POST" action="{{ route('checkout.process') }}">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Shipping Info -->
                <div class="space-y-4">
                    <h2 class="text-lg font-semibold mb-4">Shipping Information</h2>

                    <div class="grid grid-cols-2 gap-4">
                        <input type="text" name="first_name" placeholder="First Name" required
                            class="border border-gray-300 px-4 py-2 rounded-md w-full">
                        <input type="text" name="last_name" placeholder="Last Name" required
                            class="border border-gray-300 px-4 py-2 rounded-md w-full">
                    </div>

                    <input type="email" name="email" placeholder="Email Address" required
                        class="border border-gray-300 px-4 py-2 rounded-md w-full">
                    <input type="tel" name="phone" placeholder="Phone Number" required
                        class="border border-gray-300 px-4 py-2 rounded-md w-full">
                    <input type="text" name="address" placeholder="Street Address" required
                        class="border border-gray-300 px-4 py-2 rounded-md w-full">

                    <div>
                        <input type="text" name="city" placeholder="City" required
                            class="border border-gray-300 px-4 py-2 rounded-md w-full">
                    </div>

                    <h2 class="text-lg font-semibold mt-6 mb-2">Payment Method</h2>

                    <div class="space-y-3">
                        <label class="flex items-center border border-gray-300 px-4 py-2 rounded-md">
                            <input type="radio" name="payment_method" value="cod" class="mr-2" checked>
                            Cash on Delivery
                        </label>
                        {{-- 
                        <label class="flex items-center border border-gray-300 px-4 py-2 rounded-md">
                            <input type="radio" name="payment_method" value="khalti" class="mr-2">
                            Khalti (Pay Online)
                        </label> --}}
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="bg-white rounded-lg shadow-md p-6 space-y-4">
                    <h2 class="text-lg font-semibold mb-4">Order Summary</h2>

                    @foreach ($cartItems as $item)
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium">{{ $item->product->name }}</p>
                                <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                            </div>
                            <p class="font-medium">Rs{{ number_format($item->product->price * $item->quantity, 2) }}</p>
                        </div>
                    @endforeach

                    <hr>

                    <div class="flex justify-between">
                        <span class="text-gray-600">Subtotal</span>
                        <span class="font-medium">Rs{{ number_format($subtotal, 2) }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-600">Shipping</span>
                        <span class="font-medium">Free</span>
                    </div>

                    <hr>

                    <div class="flex justify-between text-lg font-bold">
                        <span>Total</span>
                        <span>Rs{{ number_format($subtotal, 2) }}</span>
                    </div>

                    <button type="submit"
                        class="w-full bg-black text-white py-3 rounded-md font-medium hover:bg-gray-800 transition">
                        Place Order
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

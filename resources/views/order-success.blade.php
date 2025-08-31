@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-12 text-center">
        <h1 class="text-3xl font-bold mb-4">Thank You!</h1>
        <p class="text-gray-600 mb-8">Your order has been placed successfully. We will process it soon.</p>

        <a href="{{ route('home') }}" class="bg-black text-white px-6 py-3 rounded-md font-medium hover:bg-gray-800">
            Continue Shopping
        </a>
    </div>
@endsection

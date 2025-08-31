@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-12">
        <div class="flex flex-col lg:flex-row gap-8 justify-center">
            <!-- Cart Items -->
            <div class="lg:w-2/3">
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">

                    @if ($cartItems->count())
                        <!-- Cart Header -->
                        <div class="grid grid-cols-12 gap-4 p-4 border-b text-sm font-medium text-gray-500">
                            <div class="col-span-6">PRODUCT</div>
                            <div class="col-span-3 text-center">QUANTITY</div>
                            <div class="col-span-3 text-right">TOTAL</div>
                        </div>

                        @php
                            $subtotal = 0;
                        @endphp

                        <!-- Cart Items -->
                        @foreach ($cartItems as $item)
                            @php
                                $itemTotal = $item->product->price * $item->quantity;
                                $subtotal += $itemTotal;
                            @endphp

                            <div class="grid grid-cols-12 gap-4 p-4 border-b items-center">
                                <div class="col-span-6">
                                    <div class="flex items-center">
                                        <div class="w-20 h-20 flex-shrink-0 bg-gray-100 rounded-md overflow-hidden mr-4">
                                            <img src="{{ asset($item->product->main_image ? 'storage/' . $item->product->main_image : '') }}"
                                                alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <div class="text-gray-500 text-sm">
                                                {{ $item->product->category->name ?? 'Category' }}</div>
                                            <h3 class="font-medium">{{ $item->product->name }}</h3>
                                            <div class="text-sm text-gray-500">
                                                @if ($item->color)
                                                    Color: {{ $item->color->name }}
                                                @endif
                                                @if ($item->size)
                                                    | Size: {{ $item->size->name }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-span-3">
                                    <div class="flex items-center justify-center">
                                        <!-- Decrease quantity -->
                                        <form
                                            action="{{ route('cart.update', ['id' => $item->id, 'action' => 'decrease']) }}"
                                            method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button class="w-8 h-8 flex items-center justify-center border rounded-md"
                                                type="submit">
                                                <i class="fas fa-minus text-xs"></i>
                                            </button>
                                        </form>

                                        <!-- Quantity -->
                                        <input type="text" value="{{ $item->quantity }}"
                                            class="w-10 h-8 mx-1 text-center border rounded-md" readonly>

                                        <!-- Increase quantity -->
                                        <form
                                            action="{{ route('cart.update', ['id' => $item->id, 'action' => 'increase']) }}"
                                            method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button class="w-8 h-8 flex items-center justify-center border rounded-md"
                                                type="submit">
                                                <i class="fas fa-plus text-xs"></i>
                                            </button>
                                        </form>

                                        <!-- Remove Item -->
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="ml-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-400 hover:text-red-500">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <div class="col-span-3 text-right font-medium">
                                    Rs{{ number_format($itemTotal, 2) }}
                                </div>
                            </div>
                        @endforeach

                        {{--                        <!-- Special Instructions --> --}}
                        {{--                        <div class="p-4"> --}}
                        {{--                            <h3 class="text-sm font-medium mb-2">Order special instructions</h3> --}}
                        {{--                            <textarea rows="4" class="w-full border rounded-md p-2 text-sm" placeholder="Leave a note about your order..."></textarea> --}}
                        {{--                        </div> --}}
                    @else
                        <!-- Empty Cart Message -->
                        <div class="text-center p-20">
                            <div class="text-5xl mb-4"><i class="fas fa-shopping-cart text-gray-300"></i></div>
                            <h2 class="text-2xl font-medium mb-2">Your cart is empty</h2>
                            <p class="text-gray-500 mb-6">Looks like you haven't added anything yet.</p>
                            <a href="/"
                                class="inline-block bg-black text-white px-6 py-3 rounded-md font-medium">Continue
                                Shopping</a>
                        </div>
                    @endif

                </div>
            </div>

            <!-- Order Summary -->
            @if ($cartItems->count())
                <div class="lg:w-1/3">
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h2 class="text-lg font-medium mb-4">Order Summary</h2>

                        <div class="border-t pt-4 space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="font-medium">Rs{{ number_format($subtotal, 2) }} NPR</span>
                            </div>
                            <div class="text-sm text-gray-500">
                                Tax included and shipping calculated at checkout
                            </div>
                        </div>

                        <a href="{{ route('checkout.page') }}"
                            class="block w-full text-center bg-black text-white py-3 rounded-md font-medium mt-6 hover:bg-gray-800 transition-colors">
                            Proceed to Checkout
                        </a>


                        <div class="text-center mt-4">
                            <a href="{{ route('home') }}" class="text-sm text-gray-600 hover:text-gray-900">Continue
                                shopping</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

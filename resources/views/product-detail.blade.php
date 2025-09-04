@extends('layouts.app')

@section('content')
    <section class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Product Image Gallery -->
            <div class="grid grid-cols-5 gap-4">
                <div class="col-span-1 space-y-2">
                    @foreach ($product->images ?? [] as $image)
                        <div class="border rounded-md p-1 cursor-pointer hover:border-gray-400">
                            <img src="{{ asset('storage/' . $image->path ?? 'img.png') }}" alt="Thumbnail"
                                class="w-full h-auto">
                        </div>
                    @endforeach
                </div>
                <div class="col-span-4">
                    <img src="{{ asset('storage/' . $product->main_image ?? 'img.png') }}" alt="{{ $product->name }}"
                        class="w-full h-auto rounded-lg">
                </div>
            </div>

            <!-- Product Details -->
            <div>
                <h2 class="text-2xl font-bold mb-2">{{ $product->name }}</h2>

                <p class="text-2xl font-bold mb-6">Nrs: {{ number_format($product->price, 2) }}</p>

                <!-- Stock Availability -->
                <p class="text-green-600 font-medium mb-2">In Stock</p>

                <!-- Estimated Delivery -->
                <p class="text-gray-500 text-sm mb-6">Estimated Delivery: 3-5 Business Days</p>
                <form method="POST" action="{{ route('cart.add') }}" class="mt-6">
                    @csrf
                    <!-- Colors -->
                    @if ($product->colors->isNotEmpty())
                        <div class="mb-6">
                            <h3 class="font-medium mb-2">Color</h3>
                            <div class="flex gap-2">
                                @foreach ($product->colors as $key => $color)
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="color_id" id="color{{ $color->id }}"
                                            value="{{ $color->id }}" {{ $key == 0 ? 'checked' : '' }}>

                                        <label for="color{{ $color->id }}" class="rounded-circle d-inline-block"
                                            style="width: 32px; height: 32px; background-color: {{ $color->hex_value }}; cursor: pointer; border: 1px solid black; display: inline-block; border-radius: 50%;"
                                            title="{{ $color->name }}">
                                        </label>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    @endif

                    <!-- Sizes -->
                    @if ($product->sizes->isNotEmpty())
                        <div class="mb-6">
                            <h3 class="font-medium mb-2">Size</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($product->sizes as $key => $size)
                                    <div class="form-check" style="margin-right: 1rem">
                                        <input type="radio" name="size_id" id="size{{ $size->id }}"
                                            value="{{ $size->id }}" class="form-check-input"
                                            {{ $key == 0 ? 'checked' : '' }}>
                                        <label for="size{{ $size->id }}" class="form-check-label">
                                            {{ $size->name }}
                                        </label>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    @endif

                    <!-- Add to Cart -->

                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="bg-black text-white px-6 py-2 rounded-md hover:bg-gray-800">
                        Add to Cart
                    </button>
                </form>

                <!-- Description -->
                <div class="border-t pt-6 mt-8">
                    <h3 class="font-medium mb-2">Description</h3>
                    <p class="text-gray-600 text-sm mb-6">{!! $product->description !!}</p>

                    <h3 class="font-medium mb-2">Return Policy</h3>
                    <p class="text-gray-600 text-sm">
                        Free returns within 30 days of purchase. Items must be unworn with original tags attached.
                    </p>
                </div>
            </div>
        </div>

        <!-- ✅ Similar Products -->
        @if ($similarProducts->isNotEmpty())
            <section class="mt-20">
                <h2 class="text-2xl font-bold mb-6">You Might Also Like</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach ($similarProducts as $similar)
                        <a href="{{ route('product.detail', $similar->id) }}"
                            class="border rounded-md p-4 hover:shadow-lg transition">
                            <img src="{{ asset('storage/' . $similar->main_image ?? 'img.png') }}"
                                alt="{{ $similar->name }}" class="w-full h-48 object-cover mb-4 rounded">
                            <h3 class="font-medium text-lg mb-2">{{ $similar->name }}</h3>
                            <p class="text-gray-700 text-sm">Nrs: {{ number_format($similar->price, 2) }}</p>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
    </section>
@endsection

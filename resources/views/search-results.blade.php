@extends('layouts.app')

@section('content')

    <div class="container mx-auto px-4 pt-8">

        <!-- Search Title -->
        <h1 class="text-3xl font-bold mb-6 text-center">
            @if($query)
                Search Results for "{{ $query }}"
            @else
                Browse Products
            @endif
        </h1>

        <div class="flex flex-col md:flex-row gap-8">

            <!-- Filters Sidebar -->
            <aside class="md:w-1/4 w-full">
                <form method="GET" action="{{ route('search.products') }}" class="bg-gray-100 p-6 rounded-lg shadow-sm space-y-6">

                    <!-- Search Again -->
                    <div>
                        <input type="text" name="query" value="{{ request('query') }}" placeholder="Search..." class="w-full border-gray-300 rounded-md px-4 py-2">
                    </div>

                    <!-- Price Range -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Price Range (NRs)</label>
                        <div class="flex gap-2">
                            <input type="number" name="price_min" value="{{ request('price_min') }}" placeholder="Min" class="w-1/2 border-gray-300 px-3 py-2 rounded-md">
                            <input type="number" name="price_max" value="{{ request('price_max') }}" placeholder="Max" class="w-1/2 border-gray-300 px-3 py-2 rounded-md">
                        </div>
                    </div>

                    <!-- Colors -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Colors</label>
                        <div class="flex flex-wrap gap-2">
                            @foreach($availableColors as $color)
                                <label class="flex items-center space-x-1 text-sm text-gray-600">
                                    <input type="checkbox" name="colors[]" value="{{ $color->id }}"
                                           {{ in_array($color->id, request('colors', [])) ? 'checked' : '' }} class="rounded">
                                    <span>{{ $color->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Sizes -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Sizes</label>
                        <div class="flex flex-wrap gap-2">
                            @foreach($availableSizes as $size)
                                <label class="flex items-center space-x-1 text-sm text-gray-600">
                                    <input type="checkbox" name="sizes[]" value="{{ $size->id }}"
                                           {{ in_array($size->id, request('sizes', [])) ? 'checked' : '' }} class="rounded">
                                    <span>{{ $size->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="pt-4">
                        <button type="submit" class="w-full bg-black text-white px-6 py-2 rounded-md hover:bg-gray-800">
                            Apply Filters
                        </button>
                    </div>

                </form>
            </aside>

            <!-- Search Results -->
            <div class="md:w-3/4 w-full">
                @if($products->count() > 0)
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach($products as $product)
                            <a href="{{ route('product.detail', $product->id) }}" class="group">
                                <div class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition">
                                    <div class="relative">

                                        <img src="{{ asset('storage/'.$product->main_image ?? 'img.png') }}" alt="{{ $product->name }}" class="w-full h-64 object-cover">
                                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition"></div>
                                    </div>
                                    <div class="p-4">
                                        <h3 class="text-gray-800 font-semibold text-sm mb-1">{{ $product->name }}</h3>
                                        <p class="text-gray-600 text-sm">NRs {{ number_format($product->price, 2) }}</p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-10">
                        {{ $products->withQueryString()->links() }}
                    </div>
                @else
                    <div class="text-center py-20">
                        <h2 class="text-2xl font-bold text-gray-700 mb-4">No products found.</h2>
                        <p class="text-gray-500">Try searching with different filters.</p>
                    </div>
                @endif
            </div>

        </div>

    </div>

@endsection

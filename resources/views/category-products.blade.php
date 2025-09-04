@extends('layouts.app')

@section('content')
    <!-- Breadcrumb Navigation -->
    <div class="container mx-auto px-4 pt-8 pb-4">
        <nav class="text-gray-400 text-sm" aria-label="Breadcrumb">
            <ol class="list-none p-0 inline-flex items-center space-x-2">
                <li>
                    <a href="{{ route('home') }}" class="hover:underline">Home</a>
                </li>
                <li>
                    <svg class="w-3 h-3 text-gray-400" fill="currentColor" viewBox="0 0 320 512">
                        <path
                            d="M285.5 273l-194 194c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-34L184.5 256 34.1 105.6c-9.4-9.4-9.4-24.6 0-34l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l194 194c9.3 9.4 9.3 24.6-.1 34z" />
                    </svg>
                </li>
                <li>
                    <span class="text-gray-600">{{ $category->name }}</span>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Page Title -->
    <section class="container mx-auto px-4 py-6">
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-2">{{ $category->name }}</h1>
        <p class="text-center text-gray-500 mb-8 text-sm">Discover the best products in {{ strtolower($category->name) }}
            category</p>
    </section>

    <section class="container mx-auto px-4 flex flex-col md:flex-row gap-8">

        <!-- Sidebar Filters -->
        <aside class="md:w-1/4 w-full">
            <form method="GET" action="{{ route('category.products', $category->id) }}"
                class="space-y-6 bg-gray-100 p-6 rounded-lg shadow-sm">

                <!-- Sort By -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Sort By</label>
                    <select name="sort_by" class="w-full border-gray-300 rounded-md px-4 py-2">
                        <option value="">Default</option>
                        <option value="latest" {{ request('sort_by') == 'latest' ? 'selected' : '' }}>Latest</option>
                        <option value="price_low_high" {{ request('sort_by') == 'price_low_high' ? 'selected' : '' }}>Price:
                            Low to High</option>
                        <option value="price_high_low" {{ request('sort_by') == 'price_high_low' ? 'selected' : '' }}>Price:
                            High to Low</option>
                    </select>
                </div>

                <!-- Price Range -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Price Range (NRs)</label>
                    <div class="flex gap-2">
                        <input type="number" name="price_min" placeholder="Min" value="{{ request('price_min') }}"
                            class="w-1/2 border-gray-300 px-3 py-2 rounded-md">
                        <input type="number" name="price_max" placeholder="Max" value="{{ request('price_max') }}"
                            class="w-1/2 border-gray-300 px-3 py-2 rounded-md">
                    </div>
                </div>

                <!-- In Stock -->
                <div class="flex items-center">
                    <input type="checkbox" name="in_stock" value="1" {{ request('in_stock') ? 'checked' : '' }}
                        class="rounded mr-2">
                    <label class="text-gray-700 text-sm">In Stock Only</label>
                </div>

                <!-- Colors -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Colors</label>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($availableColors as $color)
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
                        @foreach ($availableSizes as $size)
                            <label class="flex items-center space-x-1 text-sm text-gray-600">
                                <input type="checkbox" name="sizes[]" value="{{ $size->id }}"
                                    {{ in_array($size->id, request('sizes', [])) ? 'checked' : '' }} class="rounded">
                                <span>{{ $size->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Filter Button -->
                <div class="pt-4">
                    <button type="submit" class="w-full bg-black text-white px-6 py-2 rounded-md hover:bg-gray-800">
                        Apply Filters
                    </button>
                </div>

            </form>
        </aside>

        <!-- Product Listing -->
        <div class="md:w-3/4 w-full">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($products as $product)
                    <a href="{{ route('product.detail', $product->id) }}" class="group">
                        <div class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition">
                            <div class="relative">
                                <img src="{{ asset(isset($product) && $product->main_image ? 'storage/' . $product->main_image : 'img.png') }}"
                                    alt="{{ $product->name }}" class="w-full h-64 object-cover">
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition">
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="text-gray-800 font-semibold text-sm mb-1">{{ $product->name }}</h3>
                                <p class="text-gray-600 text-sm">NRs {{ number_format($product->price, 2) }}</p>
                            </div>
                        </div>
                    </a>
                @empty
                    <p class="col-span-4 text-center text-gray-500">No products found under this category.</p>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-10">
                {{ $products->withQueryString()->links() }}
            </div>
        </div>

    </section>
@endsection

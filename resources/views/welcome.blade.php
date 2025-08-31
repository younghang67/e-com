@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="bg-green-50 hero-section rounded-lg p-4">
        <div class="hero-inner-wrapper">
            {{-- Text Content --}}
            <div class="hero-section-left">
                <div class="content">
                    <h4>
                        Discover Premium Quality Products
                    </h4>
                    <p>
                        Experience the perfect blend of style, comfort, and innovation.
                        Our curated collection brings you the finest products at unbeatable prices.
                    </p>
                </div>
            </div>
            {{-- Hero Image --}}
            <div class="hero-section-right">
                <div class="image-container">
                    <img src="{{ asset('images/bag.png') }}" alt="Premium product showcase">
                </div>
            </div>
        </div>
    </section>

    <!-- Service Features -->
    <section class="container mx-auto px-4 py-8 grid grid-cols-2 md:grid-cols-4 gap-4 border-b pb-8">
        <div class="flex items-center justify-center flex-col text-center">
            <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                <i class="fas fa-truck text-gray-600"></i>
            </div>
            <h3 class="text-sm font-medium">FREE SHIPPING</h3>
            <p class="text-xs text-gray-500">On all orders over Rs.2000</p>
        </div>
        <div class="flex items-center justify-center flex-col text-center">
            <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                <i class="fas fa-credit-card text-gray-600"></i>
            </div>
            <h3 class="text-sm font-medium">Easy PAYMENT</h3>
            <p class="text-xs text-gray-500">COD</p>
        </div>
        <div class="flex items-center justify-center flex-col text-center">
            <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                <i class="fas fa-undo text-gray-600"></i>
            </div>
            <h3 class="text-sm font-medium">FRIENDLY SUPPORT</h3>
            <p class="text-xs text-gray-500">Fast support</p>
        </div>
        <div class="flex items-center justify-center flex-col text-center">
            <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                <i class="fas fa-shield-alt text-gray-600"></i>
            </div>
            <h3 class="text-sm font-medium">MONEY GUARANTEE</h3>
            <p class="text-xs text-gray-500">30 days money back</p>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="container mx-auto px-4 py-12">
        <h2 class="text-2xl font-bold mb-8 text-center">Featured Products</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach ($featureProducts as $product)
                <a href="{{ route('product.detail', $product->id) }}">
                    <div class="group">
                        <div class="relative overflow-hidden rounded-lg mb-3">
                            <img src="{{ asset(optional($product)->main_image ? 'storage/' . optional($product)->main_image : 'img.png') }}"
                                alt="{{ optional($product)->name ?? 'Product Image' }}" class="w-full h-64 object-cover">
                            <div
                                class="absolute inset-0 bg-black bg-opacity-20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <form method="POST" action="{{ route('cart.add') }}" class="mt-6">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit"
                                        class="bg-white text-gray-800 rounded-full w-10 h-10 flex items-center justify-center mx-1">
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="flex items-center mb-1">
                            <div class="flex text-yellow-400">
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($i < round($product->rating ?? 4))
                                        <i class="fas fa-star text-xs"></i>
                                    @else
                                        <i class="far fa-star text-xs"></i>
                                    @endif
                                @endfor
                            </div>
                        </div>

                        <h3 class="text-sm font-medium">{{ $product->name }}</h3>
                        <p class="text-gray-800 font-medium">NRs:{{ number_format($product->price, 2) }}</p>
                    </div>
                </a>
            @endforeach

        </div>
    </section>


    <!-- Marquee Banner -->
    <div class="bg-gray-100 py-3 my-8 overflow-hidden">
        <div class="flex animate-marquee">
            <p class="text-sm font-medium mx-4 whitespace-nowrap">SHOP UP AND GET 10% OFF YOUR FIRST ORDER</p>
            <p class="text-sm font-medium mx-4 whitespace-nowrap">FREE DELIVERY FOR ORDERS OVER $100</p>
            <p class="text-sm font-medium mx-4 whitespace-nowrap">SHOP UP AND GET 10% OFF YOUR FIRST ORDER</p>
            <p class="text-sm font-medium mx-4 whitespace-nowrap">FREE DELIVERY FOR ORDERS OVER $100</p>
        </div>
    </div>

    <!-- New Arrivals -->
    <section class="container mx-auto px-4 py-12">
        <h2 class="text-2xl font-bold mb-2 text-center">New Arrivals</h2>
        <p class="text-gray-600 text-center mb-8">The latest additions to our collection</p>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach ($newArrivalProducts as $product)
                <a href="{{ route('product.detail', $product->id) }}">

                    <div class="group">
                        <div class="relative overflow-hidden rounded-lg mb-3">
                            <img src="{{ asset(isset($product) && $product->main_image ? 'storage/' . $product->main_image : 'img.png') }}"
                                alt="{{ isset($product) ? $product->name : 'Product Image' }}"
                                class="w-full h-64 object-cover">
                            <div
                                class="absolute inset-0 bg-black bg-opacity-20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <form method="POST" action="{{ route('cart.add') }}" class="mt-6">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit"
                                        class="bg-white text-gray-800 rounded-full w-10 h-10 flex items-center justify-center mx-1">
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="flex items-center mb-1">
                            <div class="flex text-yellow-400">
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($i < round($product->rating ?? 4))
                                        <i class="fas fa-star text-xs"></i>
                                    @else
                                        <i class="far fa-star text-xs"></i>
                                    @endif
                                @endfor
                            </div>
                        </div>

                        <h3 class="text-sm font-medium">{{ $product->name }}</h3>
                        <p class="text-gray-800 font-medium">NRs:{{ number_format($product->price, 2) }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>


    <!-- Browse Categories Section -->
    <section class="container mx-auto px-4 py-12">
        <h2 class="text-2xl font-bold mb-8 text-center">Browse Categories</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach ($categories as $category)
                <a href="{{ route('category.products', $category->id) }}">
                    <div
                        class="group p-6 border rounded-lg flex flex-col items-center text-center hover:shadow-lg transition">
                        <h3 class="text-lg font-semibold">{{ $category->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $category->description ?? 'Explore now' }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>





    <!-- Shop The Look -->
    <section class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <div>
                <img src="{{ asset(isset($bottomTwo) && $bottomTwo->image ? 'storage/' . $bottomTwo->image : 'img.png') }}"
                    alt="{{ isset($bottomTwo) && $bottomTwo->title ? $bottomTwo->title : 'Shop The Look' }}"
                    class="w-full h-auto rounded-lg">
            </div>
            <div>
                <h2 class="text-3xl font-bold mb-4">Shop the look</h2>
                <p class="text-gray-600 mb-6">
                    Get inspired by our curated collections and find your perfect style. Mix and match items to create your
                    unique fashion statement.
                </p>

            </div>
        </div>
    </section>




    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        // Add any custom JavaScript here
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu toggle
            const mobileMenuButton = document.querySelector('.mobile-menu-button');
            const mobileMenu = document.querySelector('.mobile-menu');

            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }

            // Product image gallery
            const thumbnails = document.querySelectorAll('.product-thumbnail');
            const mainImage = document.querySelector('.product-main-image');

            if (thumbnails.length > 0 && mainImage) {
                thumbnails.forEach(thumbnail => {
                    thumbnail.addEventListener('click', function() {
                        mainImage.src = this.dataset.fullImage;
                    });
                });
            }

            // Quantity selector
            const quantityMinus = document.querySelector('.quantity-minus');
            const quantityPlus = document.querySelector('.quantity-plus');
            const quantityInput = document.querySelector('.quantity-input');

            if (quantityMinus && quantityPlus && quantityInput) {
                quantityMinus.addEventListener('click', function() {
                    const currentValue = parseInt(quantityInput.value);
                    if (currentValue > 1) {
                        quantityInput.value = currentValue - 1;
                    }
                });

                quantityPlus.addEventListener('click', function() {
                    const currentValue = parseInt(quantityInput.value);
                    quantityInput.value = currentValue + 1;
                });
            }
        });
    </script>
@endsection

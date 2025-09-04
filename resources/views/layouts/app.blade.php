<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <title>@yield('title', 'Fashion E-commerce')</title>

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    @yield('styles')
</head>

<body class="font-sans bg-white text-gray-800">

    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <a href="/" class="text-2xl font-bold" style="display: flex; align-items: center; gap: 0.5rem;">
                    <img class="site-logo" src="{{ asset('images/mount-com.png') }}"
                        style="width: 90px;object-fit: contain;">
                    <span>Mount.com</span>
                </a>

                <div class="flex items-center space-x-4">
                    <!-- Search -->
                    <form method="GET" action="{{ route('search.products') }}" class="hidden md:block">
                        <input type="text" name="query" placeholder="Search products..."
                            value="{{ request('query') }}"
                            class="border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-black" />
                        <button type="submit" class="text-gray-600 hover:text-gray-900">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>

                    <!-- User Icon -->
                    @auth
                        <a href="{{ route('profile.edit') }}" class="text-gray-600 hover:text-gray-900">
                            <i class="fas fa-user"></i>
                        </a>
                    @endauth

                    <!-- Cart -->
                    <a href="{{ route('cart.view') }}" class="relative text-gray-600 hover:text-gray-900">
                        <i class="fas fa-shopping-cart"></i>
                        <span
                            class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center">
                            {{ $cartCount ?? '0' }}
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Content -->
    <main class="min-h-[80vh]">
        @yield('content')
    </main>

    <!-- Toasts -->
    @if (session()->has('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" x-transition
            class="fixed bottom-5 right-5 z-50 bg-green-600 text-white px-6 py-3 rounded shadow-lg flex items-center space-x-2">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
            <button @click="show = false" class="ml-4 text-white text-sm hover:opacity-80">&times;</button>
        </div>
    @endif

    @if ($errors->any())
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" x-transition
            class="fixed bottom-5 right-5 z-50 bg-red-600 text-white px-6 py-3 rounded shadow-lg flex items-center space-x-2">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ $errors->first() }}</span>
            <button @click="show = false" class="ml-4 text-white text-sm hover:opacity-80">&times;</button>
        </div>
    @endif

    <!-- Footer -->
    <footer class="bg-gray-100 pt-12 pb-6 mt-10">
        <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div>
                <h3 class="text-lg font-medium mb-4">Customer Care</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="text-gray-600 hover:text-gray-900">Contact Us</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-gray-900">FAQs</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-gray-900">Returns & Exchanges</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-gray-900">Shipping Info</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-gray-900">Gift Cards</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-lg font-medium mb-4">Our Store</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="text-gray-600 hover:text-gray-900">About Us</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-gray-900">Locations</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-gray-900">Careers</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-gray-900">Events</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-gray-900">Sustainability</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-lg font-medium mb-4">Quick Links</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="text-gray-600 hover:text-gray-900">Women's Collection</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-gray-900">Men's Collection</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-gray-900">New Arrivals</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-gray-900">Sale Items</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-gray-900">Blog</a></li>
                </ul>
            </div>

            <div>
                <a href="/" class="text-2xl font-bold"
                    style="display: flex; align-items: center; gap: 0.5rem; mix-blend-mode: darken;">
                    <img class="site-logo" src="{{ asset('images/mount-com.png') }}"
                        style="width: 90px;object-fit: contain;">
                    <span>Mount.com</span>
                </a>
                <div style="margin-top: 0.5rem">
                    <p style="">At Mount.com, we bring you fashion that blends trends with comfort—style
                        that fits perfectly into your lifestyle.</p>
                </div>
            </div>
        </div>
    </footer>

    @yield('scripts')
</body>

</html>

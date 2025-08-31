<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <title>@yield('title', 'Fashion E-commerce')</title>

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    @yield('styles')
</head>

<body class="font-sans bg-gray-50">
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



    <!-- Dashboard Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Sidebar -->
            <div class="md:w-1/4 lg:w-1/5">
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="p-4 border-b">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                                <i class="fas fa-user text-gray-500"></i>
                            </div>
                            <div>
                                <div class="font-medium">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                            </div>
                        </div>
                    </div>
                    <nav class="p-2">
                        <a href="{{ route('dashboard.orders.index') }}"
                            class="flex items-center px-4 py-2 rounded-md {{ request()->routeIs('dashboard.orders.*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50' }}">
                            <i class="fas fa-shopping-bag w-5 mr-3"></i>
                            <span>My Orders</span>
                        </a>
                        <a href="{{ route('dashboard.account.edit') }}"
                            class="flex items-center px-4 py-2 rounded-md {{ request()->routeIs('dashboard.account.*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50' }}">
                            <i class="fas fa-user-circle w-5 mr-3"></i>
                            <span>My Account</span>
                        </a>

                        <form action="{{ route('logout') }}" method="POST" class="mt-2 pt-2 border-t">
                            @csrf
                            <button type="submit"
                                class="flex items-center px-4 py-2 rounded-md text-gray-600 hover:bg-gray-50 w-full text-left">
                                <i class="fas fa-sign-out-alt w-5 mr-3"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="md:w-3/4 lg:w-4/5">
                @yield('content')
            </div>
        </div>
    </div>

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
                <h3 class="text-lg font-medium mb-4">Stay Updated</h3>
                <p class="text-sm text-gray-600 mb-4">Subscribe for offers & updates.</p>
                <form class="flex mb-4">
                    <input type="email" placeholder="Your email"
                        class="flex-grow px-4 py-2 border rounded-l-md focus:outline-none focus:ring-2 focus:ring-gray-200">
                    <button type="submit" class="bg-black text-white px-4 py-2 rounded-r-md">SIGN UP</button>
                </form>
                <div class="flex space-x-4 text-gray-600">
                    <a href="#" class="hover:text-gray-900"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="hover:text-gray-900"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="hover:text-gray-900"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="hover:text-gray-900"><i class="fab fa-pinterest-p"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>

</html>

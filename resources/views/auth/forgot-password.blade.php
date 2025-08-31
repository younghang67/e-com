<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center px-4" style="background-color: #cdcdcd;">
        <div class="max-w-md w-full bg-white p-8 rounded-xl shadow-md">

            <!-- Logo and Site Name -->
            <div class="text-center mb-6">
                <a href="/" class="text-2xl font-bold text-gray-800">E-commerce</a>
            </div>

            <!-- Heading -->
            <h2 class="text-2xl font-extrabold text-center text-gray-900 mb-4">
                Forgot your password?
            </h2>

            <!-- Description -->
            <div class="text-center text-sm text-gray-600 mb-6">
                {{ __('No problem. Just enter your email address and we will email you a password reset link.') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Form Start -->
            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input
                        id="email"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required autofocus
                        class="block mt-1 w-full border border-gray-300 focus:ring-2 focus:ring-black focus:border-transparent rounded-md shadow-sm px-4 py-3 text-base"
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Submit Button -->
                <div>
                    <x-primary-button class="w-full bg-black hover:bg-gray-800 text-white font-semibold py-2 rounded-md transition">
                        {{ __('Send Password Reset Link') }}
                    </x-primary-button>
                </div>
            </form>

            <!-- Back to Login -->
            <div class="mt-6 text-center">
                <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:underline">
                    {{ __('Back to Login') }}
                </a>
            </div>

        </div>
    </div>
</x-guest-layout>

<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center  px-4" style="background-color: #cdcdcd;">
        <div class="max-w-md w-full bg-white p-8 rounded-xl shadow-md">

            <!-- Logo and Site Name -->
            <div class="text-center mb-6">
                <a href="/" class="text-2xl font-bold text-gray-800">E-commerce</a>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Login Heading -->
            <h2 class="text-2xl font-extrabold text-center text-gray-900 mb-6">
                Log in to your account
            </h2>

            <!-- Form Start -->
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
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
                        autocomplete="username"
                        class="block mt-1 w-full border border-gray-300 focus:ring-2 focus:ring-black focus:border-transparent rounded-md shadow-sm"
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        class="block mt-1 w-full border border-gray-300 focus:ring-2 focus:ring-black focus:border-transparent rounded-md shadow-sm"
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me + Forgot Password -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="flex items-center text-sm text-gray-600">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-black shadow-sm focus:ring-black mr-2" name="remember">
                        {{ __('Remember me') }}
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-black font-medium hover:underline" href="{{ route('password.request') }}">
                            {{ __('Forgot password?') }}
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <div>
                    <x-primary-button class="w-full bg-black hover:bg-gray-800 text-white font-semibold py-2 rounded-md transition">
                        {{ __('LOG IN') }}
                    </x-primary-button>
                </div>
            </form>

            <!-- Sign Up Prompt -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-black font-semibold hover:underline">
                        {{ __('Sign Up') }}
                    </a>
                </p>
            </div>

        </div>
    </div>
</x-guest-layout>

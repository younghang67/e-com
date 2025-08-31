<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center px-4" style="background-color: #cdcdcd;">
        <div class="max-w-md w-full bg-white p-8 rounded-xl shadow-md">

            <!-- Logo and Site Name -->
            <div class="text-center mb-6">
                <a href="/" class="text-2xl font-bold text-gray-800">E-commerce</a>
            </div>

            <!-- Register Heading -->
            <h2 class="text-2xl font-extrabold text-center text-gray-900 mb-6">
                Create your account
            </h2>

            <!-- Form Start -->
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input
                        id="name"
                        class="block mt-1 w-full border border-gray-300 focus:ring-2 focus:ring-black focus:border-transparent rounded-md shadow-sm px-4 py-3 text-base"
                        type="text"
                        name="name"
                        :value="old('name')"
                        required autofocus
                        autocomplete="name"
                    />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input
                        id="email"
                        class="block mt-1 w-full border border-gray-300 focus:ring-2 focus:ring-black focus:border-transparent rounded-md shadow-sm px-4 py-3 text-base"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autocomplete="username"
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input
                        id="password"
                        class="block mt-1 w-full border border-gray-300 focus:ring-2 focus:ring-black focus:border-transparent rounded-md shadow-sm px-4 py-3 text-base"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input
                        id="password_confirmation"
                        class="block mt-1 w-full border border-gray-300 focus:ring-2 focus:ring-black focus:border-transparent rounded-md shadow-sm px-4 py-3 text-base"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                    />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Submit Button -->
                <div>
                    <x-primary-button class="w-full bg-black hover:bg-gray-800 text-white font-semibold py-2 rounded-md transition">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>

            <!-- Already Registered -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-black font-semibold hover:underline">
                        {{ __('Log In') }}
                    </a>
                </p>
            </div>

        </div>
    </div>
</x-guest-layout>

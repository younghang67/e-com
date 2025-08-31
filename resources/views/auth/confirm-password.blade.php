<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center px-4" style="background-color: #cdcdcd;">
        <div class="max-w-md w-full bg-white p-8 rounded-xl shadow-md">

            <!-- Logo and Site Name -->
            <div class="text-center mb-6">
                <a href="/" class="text-2xl font-bold text-gray-800">E-commerce</a>
            </div>

            <!-- Heading -->
            <h2 class="text-2xl font-extrabold text-center text-gray-900 mb-4">
                Confirm Your Password
            </h2>

            <!-- Description -->
            <div class="text-center text-sm text-gray-600 mb-6">
                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
            </div>

            <!-- Form Start -->
            <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
                @csrf

                <!-- Password Field -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        class="block mt-1 w-full border border-gray-300 focus:ring-2 focus:ring-black focus:border-transparent rounded-md shadow-sm px-4 py-3 text-base"
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Submit Button -->
                <div>
                    <x-primary-button class="w-full bg-black hover:bg-gray-800 text-white font-semibold py-2 rounded-md transition">
                        {{ __('Confirm') }}
                    </x-primary-button>
                </div>
            </form>

        </div>
    </div>
</x-guest-layout>

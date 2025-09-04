<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center px-4" style="background-color: #f1f1f1;">
        <div class="max-w-md w-full bg-white p-8 rounded-xl shadow-md">

            <!-- Logo and Site Name -->
            <div class="text-center mb-6">
                <a href="/" class="text-2xl font-bold text-gray-800">E-commerce</a>
            </div>

            <!-- Heading -->
            <h2 class="text-2xl font-extrabold text-center text-gray-900 mb-2">
                Verify Your Email
            </h2>

            <!-- Small Description -->
            <p class="text-center text-sm text-gray-600 mb-6">
                {{ __('Thanks for signing up! Please verify your email address by clicking the link we sent you. If you didn\'t receive the email, we can send another.') }}
            </p>

            <!-- Success Message (if link re-sent) -->
            @if (session('status') == 'verification-link-sent')
                <div class="mb-6 text-green-600 bg-green-100 p-3 rounded-md text-center text-sm font-medium">
                    {{ __('A new verification link has been sent to your email address.') }}
                </div>
            @endif

            <!-- Buttons -->
            <div class="flex flex-col space-y-4">
                <!-- Resend Verification Email -->
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <x-primary-button class="w-full bg-black hover:bg-gray-800 text-white font-semibold py-2 rounded-md transition">
                        {{ __('Resend Verification Email') }}
                    </x-primary-button>
                </form>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-2 rounded-md transition">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-guest-layout>

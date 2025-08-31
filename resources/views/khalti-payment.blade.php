@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-purple-50 via-white to-purple-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white shadow-xl rounded-lg p-8 space-y-6">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center w-16 h-16 bg-purple-100 rounded-full">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 8c1.657 0 3-1.567 3-3.5S13.657 1 12 1 9 2.567 9 4.5 10.343 8 12 8zm0 2c-2.21 0-4 1.79-4 4v2h8v-2c0-2.21-1.79-4-4-4z" />
                        <path d="M4 22v-2a4 4 0 014-4h8a4 4 0 014 4v2" />
                    </svg>
                </div>
                <h2 class="mt-4 text-2xl font-extrabold text-gray-900">Khalti Payment</h2>
                <p class="mt-2 text-sm text-gray-600">Secure online payment via Khalti for your order.</p>
            </div>

            <div class="flex justify-center">
                <button id="pay-button" class="inline-flex items-center justify-center px-6 py-3 bg-purple-600 text-white text-lg font-semibold rounded-md hover:bg-purple-700 transition">
                    Pay Rs{{ number_format($payment->amount, 2) }} with Khalti
                </button>
            </div>

            <div id="redirecting-message" class="text-center text-purple-700 font-medium mt-4 hidden">
                Redirecting to Khalti...
            </div>
        </div>
    </div>

    <script>
        document.getElementById("pay-button").addEventListener("click", function () {
            const button = this;
            button.disabled = true;
            button.innerText = "Please wait...";
            document.getElementById("redirecting-message").classList.remove('hidden');

            fetch("{{ route('khalti.purchase') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    order_id: {{ $order->id }}
                })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.khalti_url) {
                        window.location.href = data.khalti_url;
                    } else {
                        alert(data.error || "Something went wrong.");
                        button.disabled = false;
                        button.innerText = "Pay Rs{{ number_format($payment->amount, 2) }} with Khalti";
                        document.getElementById("redirecting-message").classList.add('hidden');
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert("Error initiating payment.");
                    button.disabled = false;
                    button.innerText = "Pay Rs{{ number_format($payment->amount, 2) }} with Khalti";
                    document.getElementById("redirecting-message").classList.add('hidden');
                });
        });
    </script>
@endsection

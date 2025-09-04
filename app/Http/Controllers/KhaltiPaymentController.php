<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class KhaltiPaymentController extends Controller
{
    public function initiate(Request $request)
    {
//        dd($request);
        $request->validate([
            'order_id' => 'required|exists:orders,id',
        ]);

        $user = auth()->user();
        $order = Order::findOrFail($request->order_id);

        if ($order->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized access to order.'], 403);
        }

        $payment = Payment::where('order_id', $order->id)->firstOrFail();
        $payment->update(['payment_status' => 'paid']);
        $response = Http::withoutVerifying()->withHeaders([
            'Authorization' => 'Key ' . env('KHALTI_SECRET_KEY'),
        ])->post('https://dev.khalti.com/api/v2/epayment/initiate/', [
            'return_url' => route('khalti.return'),
            'website_url' => config('app.url'),
            'amount' => $order->total_amount * 100, // in paisa
            'purchase_order_id' => $order->id,
            'purchase_order_name' => 'Order #' . $order->id,
            'customer_info' => [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone ?? '9800000000',
            ]
        ]);

        if ($response->successful() && isset($response['payment_url'])) {
            return response()->json(['khalti_url' => $response['payment_url']]);
        }

        return response()->json([
            'error' => $response->json()['detail'] ?? 'Failed to initiate Khalti payment.'
        ], 422);
    }

    public function success()
    {
        $userId = Auth::id();
        Cart::where('user_id', $userId)->delete();
        return redirect()->route('checkout.success');
    }
}

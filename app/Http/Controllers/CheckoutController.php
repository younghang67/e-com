<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\ShippingAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function showCheckoutPage()
    {
        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)->with('product')->get();

        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item->product->price * $item->quantity;
        }

        return view('checkout', compact('cartItems', 'subtotal'));
    }

    public function processCheckout(Request $request)
    {
        Log::info('Checkout initiated', $request->all());

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'payment_method' => 'required',
        ]);

        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)->with('product')->get();

        if ($cartItems->isEmpty()) {
            Log::warning('Cart is empty for user', ['user_id' => $userId]);
            return back()->with('error', 'Your cart is empty.');
        }

        DB::beginTransaction();

        try {
            $shipping = ShippingAddress::create([
                'user_id' => $userId,
                'full_name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address_line1' => $request->address,
                'city' => $request->city,
            ]);


            $order = Order::create([
                'user_id' => $userId,
                'shipping_address_id' => $shipping->id,
                'total_amount' => 0,
                'status' => 'pending',
            ]);

            $orderTotal = 0;

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                    'product_color_id' => $item->color_id,
                    'product_size_id' => $item->size_id,
                ]);

                $orderTotal += ($item->product->price * $item->quantity);
            }

            $order->update(['total_amount' => $orderTotal]);

            $payment = Payment::create([
                'user_id' => $userId,
                'order_id' => $order->id,
                'amount' => $orderTotal,
                'payment_method' => $request->payment_method,
                'payment_status' => $request->payment_method === 'cod' ? 'pending' : 'unpaid',
            ]);

            if ($request->payment_method === 'cod') {
                Cart::where('user_id', $userId)->delete();
                DB::commit();
                return redirect()->route('checkout.success')->with('success', 'Order placed successfully!');
            }

            if ($request->payment_method === 'khalti') {
                DB::commit();
                return view('khalti-payment', compact('order', 'payment'));
            }

            DB::commit();
            return back()->with('error', 'Unknown payment method');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Checkout error', ['message' => $e->getMessage()]);
            return back()->with('error', 'Checkout failed: ' . $e->getMessage());
        }
    }



    public function success()
    {
        return view('order-success');
    }
}

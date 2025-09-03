<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'orderItems.product', 'payment',])->latest()->simplePaginate(15);
        return view('admin.pages.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load([
            'user.shippingAddresses',
            'orderItems.product',
            'orderItems.productSize',
            'orderItems.productColor',
            'payment',
        ]);
        return view('admin.pages.orders.view', compact('order'));
    }

    // We disable other CRUD operations for admin (create/edit/delete)
    public function create()
    {
        abort(403);
    }
    public function store(Request $request)
    {
        abort(403);
    }
    public function edit(Order $order)
    {
        abort(403);
    }
    public function update(Request $request, Order $order)
    {
        abort(403);
    }
    public function destroy(Order $order)
    {
        abort(403);
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:pending,confirmed,shipped,delivered,completed,cancelled',
        ]);

        $order->status = $validated['status'];
        $order->save();

        if ($validated['status'] === 'completed') {
            if ($order->payment) {
                $order->payment->payment_status = 'paid';
                $order->payment->save();
            }
        }
        foreach ($order->orderItems as $item) {
            $product = $item->product;
            if ($product) {
                $product->stock = max(0, $product->stock - $item->quantity);
                $product->save();
            }
        }

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }

}

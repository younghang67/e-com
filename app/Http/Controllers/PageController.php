<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Order;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PageController extends Controller
{
    public function productDetail($id)
    {
        $product = Product::with(['images', 'colors', 'sizes'])->findOrFail($id);

        // Get similar products by category (or just random)
        $similarProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('product-detail', compact('product', 'similarProducts'));
    }

    public function showCategoryProducts($id, Request $request)
    {
        $category = Category::findOrFail($id);
        $productsQuery = Product::where('category_id', $id);

        // Filters
        if ($request->filled('price_min')) {
            $productsQuery->where('price', '>=', $request->price_min);
        }

        if ($request->filled('price_max')) {
            $productsQuery->where('price', '<=', $request->price_max);
        }

        if ($request->filled('in_stock')) {
            $productsQuery->where('stock', '>', 0);
        }

        if ($request->filled('colors')) {
            $productsQuery->whereHas('colors', function ($q) use ($request) {
                $q->whereIn('colors.id', $request->colors);
            });
        }

        if ($request->filled('sizes')) {
            $productsQuery->whereHas('sizes', function ($q) use ($request) {
                $q->whereIn('sizes.id', $request->sizes);
            });
        }

        // Sorting
        if ($request->sort_by == 'latest') {
            $productsQuery->latest();
        } elseif ($request->sort_by == 'price_low_high') {
            $productsQuery->orderBy('price', 'asc');
        } elseif ($request->sort_by == 'price_high_low') {
            $productsQuery->orderBy('price', 'desc');
        }

        $products = $productsQuery->paginate(12);

        // Load filter options
        $availableColors = Color::all();
        $availableSizes = Size::all();

        return view('category-products', compact('category', 'products', 'availableColors', 'availableSizes'));
    }


    public function search(Request $request)
    {
        $query = $request->input('query');

        $productsQuery = Product::query();

        if ($query) {
            $productsQuery->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%");
            });
        }

        // Filter: Color
        if ($request->filled('colors')) {
            $productsQuery->whereHas('colors', function ($q) use ($request) {
                $q->whereIn('colors.id', $request->colors);
            });
        }

        // Filter: Size
        if ($request->filled('sizes')) {
            $productsQuery->whereHas('sizes', function ($q) use ($request) {
                $q->whereIn('sizes.id', $request->sizes);
            });
        }

        // Filter: Price Range
        if ($request->filled('price_min')) {
            $productsQuery->where('price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $productsQuery->where('price', '<=', $request->price_max);
        }

        $products = $productsQuery->paginate(12);

        // Get available filters (for sidebar)
        $availableColors = Color::all();
        $availableSizes = Size::all();

        return view('search-results', compact('products', 'query', 'availableColors', 'availableSizes'));
    }

    /**
     * Display a listing of the user's orders.
     */
    public function index(Request $request)
    {
        $orders = Order::where('user_id', auth()->id())
            ->latest()
            ->simplePaginate(5);

        return view('dashboard.orders.index', compact('orders'));
    }

    /**
     * Display the details of a single order.
     */
    public function show(Order $order)
    {
        // Ensure the order belongs to the authenticated user
        abort_if($order->user_id !== auth()->id(), 403);

        return view('dashboard.orders.show', compact('order'));
    }

    /**
     * Cancel a processing order.
     */
    public function cancel(Order $order)
    {
        // Ensure the order belongs to the authenticated user
        abort_if($order->user_id !== auth()->id(), 403);

        // Only allow cancelling if status is 'processing'
        if ($order->status === 'processing') {
            $order->status = 'cancelled';
            $order->save();

            return redirect()->route('dashboard.orders.index')->with('success', 'Order cancelled successfully.');
        }

        return redirect()->route('dashboard.orders.index')->with('error', 'Order cannot be cancelled.');
    }

    /**
     * Show tracking info of a shipped order.
     */
    public function track(Order $order)
    {
        // Ensure the order belongs to the authenticated user
        abort_if($order->user_id !== auth()->id(), 403);

        return view('dashboard.orders.track', compact('order'));
    }

    public function editAccount()
    {
        $user = Auth::user();
        return view('dashboard.account.edit', compact('user'));
    }

    public function updateAccount(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if ($validated['password']) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('dashboard.account.edit')->with('success', 'Account updated successfully.');
    }

}

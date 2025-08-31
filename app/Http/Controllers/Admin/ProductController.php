<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $colors = Color::all();
        $sizes = Size::all();
        $products = Product::with('category')->latest()->simplepaginate(15);;
        return view('admin.pages.products.index', compact('products', 'categories', 'colors', 'sizes'));;
    }

    public function create()
    {
        $categories = Category::all();
        $colors = Color::all();
        $sizes = Size::all();
        return view('admin.products.create', compact('categories', 'colors', 'sizes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'main_image' => 'required|image|max:2048',
            'images.*' => 'nullable|image|max:2048',
            'colors' => 'required|array',
            'colors.*' => 'exists:colors,id',
            'sizes' => 'required|array',
            'sizes.*' => 'exists:sizes,id',
        ]);

        // Save main image
        $mainImagePath = $request->file('main_image')->store('products', 'public');
        $validated['main_image'] = $mainImagePath;

        $product = Product::create($validated);

        // Attach sizes and colors
        $product->sizes()->sync($request->input('sizes'));
        $product->colors()->sync($request->input('colors'));

        // Save additional images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('admin.product.index')->with('success', 'Product created.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $colors = Color::all();
        $sizes = Size::all();
        $product->load(['colors', 'sizes']);

        return view('admin.pages.products.edit', compact('product', 'categories', 'colors', 'sizes'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'main_image' => 'nullable|image|max:2048',
            'images.*' => 'nullable|image|max:2048',
            'colors' => 'required|array',
            'colors.*' => 'exists:colors,id',
            'sizes' => 'required|array',
            'sizes.*' => 'exists:sizes,id',
        ]);

        // If new main image uploaded, replace old one
        if ($request->hasFile('main_image')) {
            Storage::disk('public')->delete($product->main_image);
            $validated['main_image'] = $request->file('main_image')->store('products', 'public');
        }

        $product->update($validated);

        // Sync updated sizes and colors
        $product->sizes()->sync($request->input('sizes'));
        $product->colors()->sync($request->input('colors'));

        // Add new additional images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('admin.product.index')->with('success', 'Product updated.');
    }

    public function delete(Product $product)
    {
        Storage::disk('public')->delete($product->main_image);

        foreach ($product->images as $img) {
            Storage::disk('public')->delete($img->image_path);
            $img->delete();
        }

        $product->colors()->detach();
        $product->sizes()->detach();

        $product->delete();

        return redirect()->route('admin.product.index')->with('success', 'Product deleted.');
    }
}

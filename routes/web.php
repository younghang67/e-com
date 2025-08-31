<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\KhaltiPaymentController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');
;


Route::get('/product/{id}', [PageController::class, 'productDetail'])->name('product.detail');
;
Route::get('/category/{id}/products', [PageController::class, 'showCategoryProducts'])->name('category.products');
Route::get('/search', [PageController::class, 'search'])->name('search.products');

// Route::post('/khalti/verify', [KhaltiPaymentController::class, 'initiate'])->name('khalti.purchase');
// Route::get('/payment-success/', [KhaltiPaymentController::class, 'success'])->name('khalti.return');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
    Route::delete('/cart/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::patch('/cart/{id}/{action}', [CartController::class, 'updateQuantity'])->name('cart.update');


    Route::get('/checkout', [CheckoutController::class, 'showCheckoutPage'])->name('checkout.page');
    Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
    Route::get('/checkout-success', [CheckoutController::class, 'success'])->name('checkout.success');
});

Route::prefix('dashboard/orders')->middleware(['auth'])->group(function () {
    Route::get('/', [PageController::class, 'index'])->name('dashboard.orders.index');
    Route::get('/{order}', [PageController::class, 'show'])->name('dashboard.orders.show');
    Route::get('/{order}/cancel', [PageController::class, 'cancel'])->name('dashboard.orders.cancel');
    Route::get('/{order}/track', [PageController::class, 'track'])->name('dashboard.orders.track');
});

Route::prefix('dashboard')->middleware(['auth'])->group(function () {
    Route::get('/account/edit', [PageController::class, 'editAccount'])->name('dashboard.account.edit');
    Route::post('/account/update', [PageController::class, 'updateAccount'])->name('dashboard.account.update');
});



Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminPanelController::class, 'dashboard'])->name('dashboard');

    //category
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    //    Route::get('/category/add', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/show/{category}', [CategoryController::class, 'show'])->name('category.show');
    Route::get('/category/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/update/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::post('/category/delete/{category}', [CategoryController::class, 'delete'])->name('category.destroy');

    //Size
    Route::get('/size', [SizeController::class, 'index'])->name('size.index');
    //    Route::get('/size/add', [SizeController::class, 'create'])->name('size.create');
    Route::post('/size/store', [SizeController::class, 'store'])->name('size.store');
    Route::get('/size/show/{size}', [SizeController::class, 'show'])->name('size.show');
    Route::get('/size/edit/{size}', [SizeController::class, 'edit'])->name('size.edit');
    Route::post('/size/update/{size}', [SizeController::class, 'update'])->name('size.update');
    Route::post('/size/delete/{size}', [SizeController::class, 'delete'])->name('size.destroy');

    //color
    Route::get('/color', [ColorController::class, 'index'])->name('color.index');
    //    Route::get('/color/add', [ColorController::class, 'create'])->name('color.create');
    Route::post('/color/store', [ColorController::class, 'store'])->name('color.store');
    Route::get('/color/show/{color}', [ColorController::class, 'show'])->name('color.show');
    Route::get('/color/edit/{color}', [ColorController::class, 'edit'])->name('color.edit');
    Route::post('/color/update/{color}', [ColorController::class, 'update'])->name('color.update');
    Route::post('/color/delete/{color}', [ColorController::class, 'delete'])->name('color.destroy');

    //product
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    //    Route::get('/product/add', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/show/{product}', [ProductController::class, 'show'])->name('product.show');
    Route::get('/product/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/update/{product}', [ProductController::class, 'update'])->name('product.update');
    Route::post('/product/delete/{product}', [ProductController::class, 'delete'])->name('product.destroy');

    //order
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::get('/order/show/{order}', [OrderController::class, 'show'])->name('order.show');
    Route::patch('/admin/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');


    Route::post('ckeditor/upload', [AdminPanelController::class, 'upload'])->name('ckeditor.upload');
});
require __DIR__ . '/auth.php';

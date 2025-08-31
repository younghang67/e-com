<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.app', function ($view) {
            $cartCount = Cart::where('user_id', auth()->id())->count();

            $view->with([
                'cartCount' => $cartCount,
            ]);
        });

        View::composer('welcome', function ($view) {
            $featureProducts = Product::with(['colors', 'sizes'])->inRandomOrder()->limit(8)->get();
            $newArrivalProducts = Product::with(['colors', 'sizes'])->inRandomOrder()->limit(4)->orderBy('created_at')->get();
            $categories = Category::all();
            $view->with([
                'featureProducts' => $featureProducts,
                'newArrivalProducts' => $newArrivalProducts,
                'categories' => $categories,
            ]);
        });


    }
}
